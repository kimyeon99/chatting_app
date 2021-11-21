<template>
        <div class="flex h-full">
        <room-user-list></room-user-list>

        <div class="w-4/5 flex flex-col" style="height: 600px;">
            <room-chat-area></room-chat-area>
            <div class="flex-initial">
                <input 
                    class="border-r-2 border-solid rounded border-gray-600 w-full p-3" 
                    type="text"
                />
            </div>
        </div>
        </div>
</template>

<script>
import RoomUserList from "./RoomUserList.vue"
import RoomChatMessage from "./RoomChatMessage.vue"
import RoomChatArea from './RoomChatArea.vue'


export default {
  components: { RoomUserList, RoomChatArea },
    props: {
            room: {
                type: Object,
                required: true
            },
    },
    data() {
        return {
            channel: null,
        }
    },
    created() {
        //만약에 axios.get이 느려진다면 loading 화면이 필요함 
        // 서버에 2번 room의 정보를 요청
        // 자신의 params 읽어서 그 params를 이용해 axios를 날린다  params란 방 번호
        // axios.get('/room/{2})
        // .then((res) => room = res.data)

        this.channel = window.Echo.join(`chat.${this.room.id}`)

        this.channel
            .here((members) => {
                members.forEach(member => {
                    console.log(member);
                });
            })
            .joining((user) => {
                console.log(`${user.id} 님이 참가`)
            })
            .leaving((user) => {
                console.log(`${user.id} 님이 나감`)
            })


        // window.Echo.join('chat.${room}').joining((user) => {
        //         consoel.log(user.name);
        // }),
        // window.Echo.join('chat.${room}').here((users) => {
        //     console.log(users);
        // })
        
    },
        // window.Echo.private('chat').listen('MessageSent',e =>{
        //         // 보내는 사람과 받는 사람이 일치할 경우에만 메세지 push
        //         if(e.message.to === this.currentUser && e.message.from === this.chatWith )
        //         this.messages.push(e.message);
        //     });
        
}
</script>

<style>

</style>