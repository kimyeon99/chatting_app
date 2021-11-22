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
        <button class="text-gray-700 "
         @click="leaveRoom(room.id)">버튼</button>
        </div>
</template>

<script>
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
        }
    },
    methods: {
            leaveRoom(roomId) {
                    console.log('leave')
                },
    },

    created() {
        //만약에 axios.get이 느려진다면 loading 화면이 필요함 
        // 서버에 2번 room의 정보를 요청
        // 자신의 params 읽어서 그 params를 이용해 axios를 날린다  params란 방 번호
        // axios.get('/room/{2})
        // .then((res) => room = res.data)





        
    },

    mounted(){
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
    }

        
}
</script>

<style>

</style>