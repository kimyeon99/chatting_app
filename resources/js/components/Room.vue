<template>
<div v-if="isGame">
<div class="flex items-center justify-center p-10" style="height: 350px;">
        <p>남은 라운드: {{round}}</p><br>

    <div style="border : black 2px solid; width: 20%; height: 45%;
        text-align: center;
      border-radius: 10px; 
      padding: 20px;">


        <div>
            <p>제시된 단어</p><br>
            <h1 class="text-xl font-bold">
                    {{ lastWord.word }}
            </h1>
        </div>
    </div>
</div>

<div class="grid xl:grid-cols-4 md:grid-cols-3 grid-cols-3 gap-2 max-w">
    <div class="flex flex-col bg-gray-200 rounded-lg p-4 
                hover:bg-blue-500 hover:text-gray-100 focus:border-4 focus:border-blue-300 cursor-pointer"
                style="margin: 0 0 20px 50px ;width: 250px;"
                v-for="roomUser in roomUsers" :key="roomUser.player">
                <div class="flex flex-col items-start mt-4"
                >
                    <img class="rounded-full h-20 w-20" :src="getProfile(roomUser.image)" alt="Logo"/>
                    <h1 class="text-xl font-bold">{{roomUser.name}}</h1>
                    <h1 class="text-xl font-bold">{{ roomUser.score }}</h1>
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
            :host="host"
        ></room-user-list>
    <!--프로필-->


            <div class="flex bg-gray-200 justify-center items-center h-16 p-4 my-6  rounded-lg  shadow-inner">
                <div class="flex items-center border border-gray-400 p-2 border-dashed rounded cursor-pointer">
                
                <div class="ml-1 text-gray-500 font-medium">Invite a friend</div>
                </div>
            </div>
            </div>
            <div class="p-6 " >
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
            currentUser:{
                type: Number,
                required: true
            }
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
            host:0,
            roomHost:0,
            result:false,
            resultPlayer1Score:0,
            resultPlayer2Score:0,
            resultPlayer3Score:0,
            resultPlayer4Score:0,
            max:0,

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
            getProfile(url){
                if(url === null){
                    url =  '/' +'storage/images/profiles/' + 'no_profile_image.png';
                    return url;
                }
              url =  '/' +'storage/images/profiles/' + url;
              console.log(url);
              return url;
          },
          setResultFalse(){
              this.result = false;
          },
          showAlert(winPlayer) {
            // Use sweetalert2
            this.$swal({
                title: `${winPlayer} is Win !`,
                width: 1000,
                padding: '3em',
                color: '#716add',
                background: '#fff',
                backdrop: `
                rgba(0,0,123,0.4)
                left top
                no-repeat`
            });
            },
        getScore(){
            
        },
        getPlayerList(){
            axios.get('/room/' + this.room.id + '/list',{
                    id: this.room.id,
                }).then(res => {
                    //this.roomUsers = res.data;
                    dd(res.data);
            });
        }
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
                // this.roomUsers = users;

                // this.player1 = users[0].id;
                // if(users[1]) this.player2 = users[1].id;
                // if(users[2]) this.player3 = users[2].id;
                // if(users[3]) this.player4 = users[3].id;

                // this.host = this.player1;
                //  console.log('!@#!1',this.roomUsers);
               this.getPlayerList();
                
                
                 
            })
            .joining((user) => {
                console.log(`${user.name} 님이 참가`);
                
                this.roomUsers.push(user);
                console.log('roomUsersLength...', this.roomUsers.length-1);
                
                this.roomUsers[this.roomUsers.length-1].player = this.roomUsers.length;
                //this.player[this.roomUsers.length] = user.id;

                // if(this.roomUsers.length == 2) this.player2 = user.id;
                // if(this.roomUsers.length == 3) this.player3 = user.id;
                // if(this.roomUsers.length == 4) this.player4 = user.id;

                //this.adminMessage();
                //this.adminMessage(`${user.name} 님이 참가`);
                console.log('roomUsers...', this.roomUsers);

            }).leaving((user) => {
                console.log(`${user.name} 님이 나감`);
                //this.adminMessage(`${user.name} 님이 나감`);
                for(let i = 0; i < this.roomUsers.length; i++) {
                        if(this.roomUsers[i].id === user.id)  {
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

                        for(let i = 1; i<= this.roomUsers.length; i++){
                            if(e.player == this.roomUsers[i].player) this.roomUsers[e.player-1].score += 50;
                        }
                        
                        
                    }
                }else{
                    // 결과창 생성
                    if(e.check == 2){
                        this.result = true;
                        this.max = Math.max(this.Player1Score, this.Player2Score, this.Player3Score, this.Player4Score);
                        if(this.Player1Score == this.max){
                            this.showAlert(this.roomUsers[0].name);
                        } else if(this.Player2Score == this.max){
                            this.showAlert(this.roomUsers[1].name);
                        } else if(this.Player3Score == this.max){
                            this.showAlert(this.roomUsers[2].name);
                        } else{
                            this.showAlert(this.roomUsers[3].name);
                        }
                        this.max = 0;
                        
                        //this.createModal();

                            this.isGameFalse();
                            this.setRound(5);

                            this.Player1Score = 0;
                            this.Player2Score = 0;
                            this.Player3Score = 0;
                            this.Player4Score = 0;
                    }
                    


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
            
        
        
    },
}
</script>

<style>

</style>
