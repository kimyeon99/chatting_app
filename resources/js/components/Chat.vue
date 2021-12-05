<template>
    <div class="flex h-full">


        <div class="w-3/5 flex flex-col" style="height: 400px;">
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
import { mapMutations, mapState } from 'vuex'

    import RoomList from './RoomList.vue';
   import ChatUserList from './ChatUserList';
    import ChatArea from './ChatArea';
    export default {
        props: {
            currentUser: {
                type: Number,
                required: true
            },
        },

        computed: {
            roomId(){
                return this.$store.state.randomId;
            }
        },

        components: {
            ChatUserList,
            ChatArea
        },

        data() {
            return {
                text: '',
                messages: [],
            }
        },

        created(){
            console.log('roomid!!!!', this.roomId);
            this.getMessages();

            window.Echo.private('chat').listen('MessageSent',e =>{
                // 보내는 사람과 받는 사람이 일치할 경우에만 메세지 push
                
                if(e.message.to == this.roomId){
                    this.messages.push(e.message);
                }

                console.log('메세지' , e.message);
                console.log('this 메세지' , this.messages);
                
            });

            
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
                                from: this.currentUser,

                            }).then(res => {
                                //push: messages 끝에 추가
                                this.messages.push(res.data.message);
                            }).catch(error => {
                            console.log(error);
                        })
                    }
                this.text = '';
                },


            stopAdminMessage(){
                this.$store.commit('stopAdminMessage');
            },





        },
        watch:{
            isAdmin:function(){
                if(this.isAdmin == true){
                    axios.post('/api/messages', {
                                text: '~~님이 들어오셨습니다 메시지',
                                to: this.roomId,
                                from: 1
                            }).then(res => {
                                this.messages.push(res.data.message);
                            }).catch(error => {
                            console.log(error);
                        })
                }
                this.stopAdminMessage();
            }
        }
    }
</script>
