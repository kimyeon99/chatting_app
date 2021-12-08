<template>
<div v-if="isGame">
<div class="flex items-center justify-center p-10" style="height: 460px;">
    <p>남은 라운드:</p>
    <p>{{round}}</p>
	<div class="grid grid-cols-1 gap-2 max-w" >
		<div class="flex flex-col bg-white-200 rounded-lg p-4 m-2
            hover:bg-blue-500 hover:text-gray-100 focus:border-4 focus:border-blue-300 cursor-pointer">
            <p>제시된 단어</p><br>
			<div class="flex flex-col mt-4">
				<h1 class="text-xl font-bold">
                    {{ lastWord.word }}
                </h1>
			</div>
		</div>
	</div>
</div>

<div class="grid xl:grid-cols-4 md:grid-cols-3 grid-cols-1 gap-2 max-w">
    <div class="flex flex-col bg-gray-200 rounded-lg p-4 m-2
                hover:bg-blue-500 hover:text-gray-100 focus:border-4 focus:border-blue-300 cursor-pointer"
                v-for="roomUser in roomUsers" :key="roomUser.id"
                >
                <div class="flex flex-col items-start mt-4">
                    <h1 class="text-xl font-bold" v-if="roomUser.id == player1">{{ Player1Score }}</h1>
                    <h1 class="text-xl font-bold" v-if="roomUser.id == player2">{{ Player2Score }}</h1>
                    <h1 class="text-xl font-bold" v-if="roomUser.id == player3">{{ Player3Score }}</h1>
                    <h1 class="text-xl font-bold" v-if="roomUser.id == player4">{{ Player4Score }}</h1>
                    
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
            <div class="flex-1 bg-white-200 p-4 flex justify-center items-center"
            style="margin: 20px 0; height: 500px;">
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
                
                <div class="ml-1 text-gray-500 font-medium">Invite a friend</div>
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
            Player1Score:0,
            Player2Score:0,
            Player3Score:0,
            Player4Score:0,
            player1:0,
            player2:0,
            player3:0,
            player4:0,

        }
    },
    computed: {
        randomWord(){
            return this.$store.state.randomWord;
        },
        lastWord(){
            return this.$store.state.lastWord;
        },
        submitWord(){
            return this.$store.state.submitWord;
        },
        isGame(){
            return this.$store.state.isGame;
        },
        isAdmin(){
            return this.$store.state.isAdmin;
        },
        round(){
            return this.$store.state.round;
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

            getRandomWord(){
                this.$store.commit('getRandomWord');
            },

            goBack(){
                this.$router.go(-1);
            },

            gameStart(){
                axios.post('/room/' + this.room.id + '/gameStart',{
                    id: this.room.id,
                }).then(res => {

            });
            },

            adminMessage(){
                this.$store.commit('adminMessage');
            },
             getRandomWord(){
                // axios get으로 db의 단어 중 랜덤하게 한 단어를 가져온다.
                // 그 단어로 게임을 시작한다.
                axios.get('/getRandomWord').then(res => {
                    this.randomWord = res.data;
                    console.log(this.randomWord);
            });
            },
            setRandomWord(randomWord){
                this.$store.commit('setRandomWord', randomWord);
            },
            isGameTrue(){
                this.$store.commit('game_Start');
            },
            isGameFalse(){
                this.$store.commit('game_End');
            },
            setLastWord(lastWord){
                this.$store.commit('setLastWord', lastWord);
            },
            setRound(round){
                this.$store.commit('setRound', round);
            },



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
                this.player1 = users[0].id;
                this.player2 = users[1].id;
                this.player3 = users[2].id;
                this.player4 = users[3].id;
                console.log('!@#!1',this.roomUsers);
            })
            .joining((user) => {
                console.log(`${user.name} 님이 참가`);
                this.roomUsers.push(user);
                this.adminMessage();
                this.adminMessage(`${user.name} 님이 참가`);
            }).leaving((user) => {
                console.log(`${user.name} 님이 나감`);
                this.adminMessage(`${user.name} 님이 나감`);
                for(let i = 0; i < this.roomUsers.length; i++) {
                        if(this.roomUsers[i] === user)  {
                            this.roomUsers.splice(i, 1);
                            break;
                        }
            }
            }).listen('RoomMessageSent', e => {
                //게임 시작했을 경우
                if(e.isGame){
                    this.room_info = e.room;
                    this.isGameTrue();
                    this.setLastWord(e.randomWord);
                    
                    //정답일 경우
                    if(e.check == 1){
                        this.setRound(e.room.round);
                        console.log('eeee',e.player);
                        this.setLastWord(e.randomWord[0]);
                        if(e.player == this.player1) this.Player1Score += 100;
                        else if(e.player == this.player2) this.Player2Score += 100;
                        else if(e.player == this.player3) this.Player3Score += 100;
                        else if(e.player == this.player4) this.Player4Score += 100;
                    }
                }else{
                    this.isGameFalse();
                    this.setRound(5);
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
</script>

<style>

</style>
