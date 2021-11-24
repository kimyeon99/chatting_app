<template>
        <div class="flex h-full">
            <chat-component></chat-component>
        <!-- <room-user-list></room-user-list>

        <div class="w-4/5 flex flex-col" style="height: 600px;">
            <room-chat-area></room-chat-area>
            <div class="flex-initial">
                <input 
                    class="border-r-2 border-solid rounded border-gray-600 w-full p-3" 
                    type="text"
                />
            </div>
        </div>
        <button class="text-gray-700 "
         @click="leaveRoom(room.id)">버튼</button> -->
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
            messages: [],
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
    },

    created() {
        //만약에 axios.get이 느려진다면 loading 화면이 필요함 
        // 서버에 2번 room의 정보를 요청
        // 자신의 params 읽어서 그 params를 이용해 axios를 날린다  params란 방 번호
        // axios.get('/room/{2})
        // .then((res) => room = res.data)

            this.channel = window.Echo.join(`chat.${this.room.id}`)
                
            this.channel
            .here((users) => {
                users.forEach(user => {
                    console.log(user);
                });
            })
            .joining((user) => {
                console.log(`${user.name} 님이 참가`)
            }).leaving((user) => {
                        console.log(`${user.name} 님이 나감`)
            })



            // this.channel.listen('room.message',e =>{
            //     // 보내는 사람과 받는 사람이 일치할 경우에만 메세지 push
            //     if(e.message.to === this.currentUser && e.message.from === this.chatWith )
            //     this.messages.push(e.message);
            // });
    },

    mounted(){
            // this.channel
            // .here((users) => (this.users = users))
            // .joining((user) => console.log(`${user.id} 님이 참가`))
            // .leaving((user) => {
            //     console.log(`${user.id} 님이 나감`)
            // })


    }

        
}
</script>

<style>

</style>