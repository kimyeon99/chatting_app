<template>
    <div class="flex h-full">
        <chat-user-list :current-user="currentUser"
            @updatedChatWith="updateChatWith"
        ></chat-user-list>

        <div v-if="chatWith" class="w-4/5 flex flex-col" style="height: 600px;">
            <chat-area
                :chat-id="chatWith"
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

        <div v-else class="p-2">
            채팅 상대를 선택
        </div>

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
            }
        },
        components: {
            ChatUserList,
            ChatArea
        },
        data() {
            return {
                chatWith: null,
                text: '',
                messages: []
            }
        },
        created(){
            // bootstrap.js->echo
            window.Echo.private('chat').listen('MessageSent',e =>{
                // 보내는 사람과 받는 사람이 일치할 경우에만 메세지 push
                if(e.message.to === this.currentUser && e.message.from === this.chatWith )
                this.messages.push(e.message);
            });
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            updateChatWith(value) {
                this.chatWith = value;
                this.getMessages();
            },

            getMessages() {
                axios.get('/api/messages', {
                    params: {
                        to: this.chatWith,
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
                        to: this.chatWith,
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
