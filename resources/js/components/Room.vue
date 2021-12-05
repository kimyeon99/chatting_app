<template>
<div v-if="RoomIsGame">
<div class="flex items-center justify-center w-screen p-10">
	<div class="grid grid-cols-1 gap-2 max-w">
		<div class="flex flex-col bg-gray-200 rounded-lg p-4 m-2
            hover:bg-blue-500 hover:text-gray-100 focus:border-4 focus:border-blue-300 cursor-pointer">
            <p>제시된 단어</p>
			<div class="flex flex-col mt-4">
				<h1 class="text-xl font-bold">{{RoomRandomWord.word}}</h1>
				<p class="text-sm">
                    {{ lastWord }}
                </p>
			</div>
		</div>
	</div>
</div>

<div class="grid xl:grid-cols-4 md:grid-cols-3 grid-cols-1 gap-2 max-w">
    <div class="flex flex-col bg-gray-200 rounded-lg p-4 m-2
                hover:bg-blue-500 hover:text-gray-100 focus:border-4 focus:border-blue-300 cursor-pointer"
                v-for="roomUser in roomUsers" :key="roomUser.id">
                <div class="flex flex-col items-start mt-4">
                    <h1 class="text-xl font-bold">{{roomUser.name}}</h1>
                </div>
            </div>
    </div>
</div>


<div v-else>
        <button class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded"
            @click="goBack">    
                뒤로가기
            </button>
            <div class="flex-1 bg-gray-200 p-4 flex justify-center items-center">
            <div class="bg-white w-full md:max-w-4xl rounded-lg shadow h-500">
            <div class="h-12 flex justify-between items-center border-b border-gray-200 m-4">
            <div>
            <div class="text-xl font-bold text-gray-700">{{room.title}}</div>
            <div class="text-sm font-base text-gray-500">Waiting for more players...</div>
            </div>
            <!-- X button -->
            <div>
                <div class="flex items-center justify-center w-full  shadow-md rounded-full">
                    
                </div>
            </div>
    </div>
    <!--프로필-->
        <room-user-list
            v-bind:room-users="roomUsers"
            :room="room"
        ></room-user-list>
    <!--프로필-->


            <div class="flex bg-gray-200 justify-center items-center h-16 p-4 my-6  rounded-lg  shadow-inner">
                <div class="flex items-center border border-gray-400 p-2 border-dashed rounded cursor-pointer">
                
                <div class="ml-1 text-gray-500 font-medium"> Invite a friend</div>
                </div>
            </div>
            </div>
            <div class="p-6 ">
                <button @click="gameStart" class="p-4 bg-green-400 hover:bg-green-500 w-full rounded-lg shadow text-xl font-medium uppercase text-white"
                >게임 시작</button>
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
            room_info:'',
            RoomIsGame:false,
            RoomRandomWord:'',
            RoomLastWord:'',
        }
    },
    computed: {
        randomId(){
            return this.$store.state.randomId;
        },


    },

    methods: {
            // leaveRoom(roomId) {
            //     // /room/{id}/leave
            //     console.log('1');
            //     axios.get('/room/leave').then(res => {
            //             this.channel.leaving((member) => {
            //                 console.log(member.id, member.info);
            //             remove_member(member.id, member.info);
            //             });
            //         }).catch(error => {
            //         console.log(error);
            //     });
            //     },

            getMessages() {
                axios.get('/api/messages', {
                    params: {
                        to: this.room.id,
                        from: this.currentUser
                    }
                }).then(res => {
                    this.messages = res.data.messages;
                });
            },

            goBack(){
                this.$router.go(-1);
            },

            gameStart(){
                axios.post('/room/' + this.room.id + '/gameStart',{
                    id: this.room.id,
                }).then(res => {
                    this.game_Start();
                    console.log('AAA', res);
                    console.log('1bb', this.RoomIsGame);
                    if(res.data.isGame){
                        this.RoomIsGame = true;
                    }
                    console.log('bb', this.RoomIsGame);
                    // this.channel.listen(('roomMessageSent', e => {
                    //     this.isGame = e.isGame;
                    // }))
            });
            },

            // adminMessage(){
            //     this.$store.commit('adminMessage');
            // },
             getRandomWord(){
                // axios get으로 db의 단어 중 랜덤하게 한 단어를 가져온다.
                // 그 단어로 게임을 시작한다.
                axios.get('/getRandomWord').then(res => {
                    this.RoomRandomWord = res.data;
                    console.log(this.RoomRandomWord);
            });


        },
    created() {
        //만약에 axios.get이 느려진다면 loading 화면이 필요함 
        // 서버에 2번 room의 정보를 요청
        // 자신의 params 읽어서 그 params를 이용해 axios를 날린다  params란 방 번호
        // axios.get('/room/{2})
        // .then((res) => room = res.data)

            // this.currentUser.isHost = true;

            this.getMessages();
 
            console.log('roomId:' + this.room.id);
            

            this.room_info = this.room;


            // if(this.room_info.isGame){
            //         this.isGame = true;
            //         axios.post('/room/' + this.room.id + '/gameStart',{
            //         id: this.room.id,
            //     }).then(res => {
            //         this.room = res.room;
            // });
            // }


            this.channel = window.Echo.join(`chat.${this.room.id}`);
                
            this.channel
            .here((users) => {
                 this.roomUsers = users;
                // users.forEach(user => {
                //     this.roomUsers += user.name;
                // });
                
            })
            .joining((user) => {
                console.log(`${user.name} 님이 참가`);
                this.roomUsers.push(user);
                this.adminMessage();
                //this.adminMessage(`${user.name} 님이 참가`);
            }).leaving((user) => {
                console.log(`${user.name} 님이 나감`);
                //this.adminMessage(`${user.name} 님이 나감`);
                for(let i = 0; i < this.roomUsers.length; i++) {
                        if(this.roomUsers[i] === user)  {
                            this.roomUsers.splice(i, 1);
                            break;
                        }
            }
            }).listen('RoomMessageSent', e => {
                if(e.isGame){
                    this.room_info = e.room;
                    this.RoomIsGame = true;
                    this.RoomRandomWord = e.randomWord;
                    this.setRandomWord(this.RoomRandomWord);
                    
                }
            });





            // window.Echo.
            // channel(`chat.${this.room.id}`).listen('RoomMessageSent', e => {
            //     if(e.isGame){
            //         this.room_info = e.room;
            //         this.isGame = true;
            //         this.getRandomWord();
            //     }
            // });

            


    },
    mounted(){
            
        
        
    }
}
}
</script>

<style>

</style>
