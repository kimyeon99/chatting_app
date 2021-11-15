<template>
    <div class="flex h-full">
        <chat-user-list :current-user="currentUser"
            @updatedChatWith="updateChatWith"
        ></chat-user-list>

        <div v-if="chatWith" class="w-4/5 flex flex-col" style="height: 600px;">
            <chat-area
                :chat-id="chatWith"
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
    import ChatUserList from './ChatUserList.vue'
    import ChatArea from './ChatArea.vue'
    export default {
        props: {
            currentUser: {
                type: Number,
                require: true,
            }
        },
        components:{
            ChatUserList, ChatArea
        },
        
        data() {
            return {
                chatWith: null,
                text: ''
            }
        },

        mounted() {
            console.log('Component mounted.')
        },

        methods: {
            updateChatWith(value){
                this.chatWith = value;
                this.getMessage();
            },

            getMessage(){
                axios.get('/api/message', {
                    params: {
                        to: this.chatWith,
                        from: this.currentUser
                    }
                }).then(res => {
                    console.log(res);
                }).catch()
            },

            submit(){
                if(this.text){
                    axios.post('/api/messages', {
                     text: this.text,
                     to: this.chatWith,
                     from: this.currentUser
                 });
                }   
            }
        }
    }
</script>
