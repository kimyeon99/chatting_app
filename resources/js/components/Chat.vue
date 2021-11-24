<template>
    <div class="flex h-full">
        <chat-user-list :current-user="currentUser"
            :chatWith="roomId"
        ></chat-user-list>

        <div class="w-4/5 flex flex-col" style="height: 600px;">
            <chat-area
                :chat-id="roomId"
                :messages="messages"
            ></chat-area>
            <div class="flex-initial">
                <input 
                    class="border-r-2 border-solid rounded border-gray-600 w-full p-3" 
                    type="text"
                    v-model="text"
                    @keyup.enter="submit"
                />
            </div>
        </div>
        <!-- <div v-else class="p-2">
            채팅 상대를 선택
        </div> -->

    </div>
</template>

<script>
   import ChatUserList from './ChatUserList';
    import ChatArea from './ChatArea';
    export default {
        props: {
            currentUser: {
                type: Number,
                required: true
            },
            room: {
                type: Object,
                required : false,
            },
            roomId:{
                type:Number,
                required : false
            }
        },

        components: {
            ChatUserList,
            ChatArea
        },

        data() {
            return {
                text: '',
                messages: []
            }
        },

        created(){
            // 귓말
            // window.Echo.private('chat').listen('MessageSent',e =>{
            //     // 보내는 사람과 받는 사람이 일치할 경우에만 메세지 push
            //     if(e.message.to === this.currentUser && e.message.from === this.chatWith 
            //          && e.message.InRoom == this.room)
            //     this.messages.push(e.message);
            // });
            

            this.getMessages();

            window.Echo.private('chat').listen('MessageSent',e =>{
                // 보내는 사람과 받는 사람이 일치할 경우에만 메세지 push
                if(e.message.to == this.chatWith){
                    this.messages.push(e.message);
                }
                
            });
            console.log(this.room);
            //console.log(this.room.id);
            console.log(this.roomId);

        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            getMessages() {
                axios.get('/api/messages', {
                    params: {
                        to: this.roomId,
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
                        to: this.roomId,
                        from: this.currentUser
                    }).then(res => {
                        //push: messages 끝에 추가
                        this.messages.push(res.data.message);
                    }).catch(error => {
                    console.log(error);
                });
                }
                this.text = '';
            }
        }
    }
</script>
