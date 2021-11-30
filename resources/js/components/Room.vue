<template>
        <div>

<div class="flex-1 bg-gray-200 p-4 flex justify-center items-center">
<div class="bg-white w-full md:max-w-4xl rounded-lg shadow h-500">
<div class="h-12 flex justify-between items-center border-b border-gray-200 m-4">
  <div >
   <div class="text-xl font-bold text-gray-700">{{room.title}}</div>
   <div class="text-sm font-base text-gray-500">Waiting for more players...</div>
  </div>
  <div>
    <div class="flex items-center justify-center w-full  shadow-md rounded-full">
      <label
          htmlFor="toogleA" class="flex items-center cursor-pointer"
      >
        <div class="flex items-center">
          <input id="toogleA" type="checkbox" class="hidden"/>
          <div
              class="toggle__line w-20 h-10 bg-gray-300 rounded-full shadow-inner"
          >
          </div>
          <div
              class="toggle__dot bg-red-400 absolute w-10 h-10 bg-white rounded-full shadow flex items-center justify-center"
          >
            <svg class="text-white w-6 h-6 " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z" />
            </svg>
          </div>
        </div>
      </label>
    </div>
  </div>
</div>


<!--프로필-->
        <room-user-list
            v-bind:room-users="roomUsers"
            :room="room"
        ></room-user-list>

  
  

  <div class="flex bg-gray-200 justify-center items-center h-16 p-4 my-6  rounded-lg  shadow-inner">
    <div class="flex items-center border border-gray-400 p-2 border-dashed rounded cursor-pointer">
    
      <div class="ml-1 text-gray-500 font-medium"> Invite a friend</div>
    </div>
  </div>
</div>
  <div class="p-6 ">
    <button class="p-4 bg-green-400 hover:bg-green-500 w-full rounded-lg shadow text-xl font-medium uppercase text-white">Start the game</button>
  </div>
</div>
    </div>

        </div>
</template>

<script>
import ChatComponent from "./Chat.vue"
import RoomUserList from "./RoomUserList.vue"
import RoomChatMessage from "./RoomChatMessage.vue"
import RoomChatArea from './RoomChatArea.vue'
import Button from '../../../vendor/laravel/breeze/stubs/inertia-vue/resources/js/Components/Button.vue'


export default {
  components: { RoomUserList, RoomChatArea, Button },
    props: {
            room: {
                type: Object,
                required: true
            },
    },
    data() {
        return {
            channel: null,
            text: '',
            messages: [],
            roomUsers: [],
        }
    },

    methods: {
            leaveRoom(roomId) {
                // /room/{id}/leave
                console.log('1');
                axios.get('/room/leave').then(res => {
                        this.channel.leaving((member) => {
                            console.log(member.id, member.info);
                        remove_member(member.id, member.info);
                        });
                    }).catch(error => {
                    console.log(error);
                });
                },

            getMessages() {
                axios.get('/api/messages', {
                    params: {
                        to: this.room.id,
                        from: this.currentUser
                    }
                }).then(res => {
                    console.log(res);
                    this.messages = res.data.messages;
                });
            },

            submit() {
                if (this.text) {
                    axios.post('/api/messages', {
                        text: this.text,
                        to: this.room.id,
                        from: this.currentUser
                    }).then(res => {
                        //push: messages 끝에 추가
                        this.messages.push(res.data.message);
                    }).catch(error => {
                    console.log(error);
                });
                }
                this.text = '';
            },

            // adminMessage(text){
            //     axios.post('/api/messages', {
            //             text: text,
            //             to: this.roomId,
            //             from: 0
            //         }).then(res => {
            //             //push: messages 끝에 추가
            //             this.messages.push(text);
            //         }).catch(error => {
            //         console.log(error);
            //     });
            // }
    },

    created() {
        //만약에 axios.get이 느려진다면 loading 화면이 필요함 
        // 서버에 2번 room의 정보를 요청
        // 자신의 params 읽어서 그 params를 이용해 axios를 날린다  params란 방 번호
        // axios.get('/room/{2})
        // .then((res) => room = res.data)

            // this.currentUser.isHost = true;

            this.getMessages();

            window.Echo.private('chat').listen('MessageSent',e =>{
                // 보내는 사람과 받는 사람이 일치할 경우에만 메세지 push
                if(e.message.to == this.room.id){
                    this.messages.push(e.message);
                }
            });
            console.log('roomId:' + this.room.id);

            this.channel = window.Echo.join(`chat.${this.room.id}`);
                
            this.channel
            .here((users) => {
                 this.roomUsers = users;
                // users.forEach(user => {
                //     this.roomUsers += user.name;
                // });
                console.log(this.roomUsers);
            })
            .joining((user) => {
                console.log(`${user.name} 님이 참가`);
                //this.adminMessage(`${user.name} 님이 참가`);
                this.roomUsers.push(user);
            }).leaving((user) => {
                console.log(`${user.name} 님이 참가`);
                //this.adminMessage(`${user.name} 님이 나감`);
                for(let i = 0; i < this.roomUsers.length; i++) {
                        if(this.roomUsers[i] === user)  {
                            this.roomUsers.splice(i, 1);
                            break;
                        }
                    }
            })




            // this.channel.listen('room.message',e =>{
            //     // 보내는 사람과 받는 사람이 일치할 경우에만 메세지 push
            //     if(e.message.to === this.currentUser && e.message.from === this.chatWith )
            //     this.messages.push(e.message);
            // });
    },
    mounted(){

    }
}
</script>

<style>

</style>
