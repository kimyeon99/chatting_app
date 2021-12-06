import axios from 'axios';
import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    roomId: 0,
    isGame: false,
    randomWord:'',
    lastWord:'',
    submitWord:'',
    round:5,
    isAdmin: false,
  },
  mutations: {
    get_RoomId (state, roomId)
    //state의 roomId 변수에 넘겨받은 roomId값을 입력함
     {
      state.roomId = roomId;
    },

    game_Start(state){
      state.isGame = true;
    },

    game_End(state){
      state.isGame = false;
    },

    success(state, {currentUser, submitWord}){
      state.round--;
      // if(state.round == 0){
      //   this.game_End();
      // }
      state.lastWord = submitWord;
      
    },

    getRandomWord(state){
      // axios get으로 db의 단어 중 랜덤하게 한 단어를 가져온다.
      // 그 단어로 게임을 시작한다.
      axios.get('/getRandomWord').then(res => {
            state.randomWord = res.data.word;
        });
    },

    adminMessage(state){
      state.isAdmin = true;
    },

    stopAdminMessage(state){
      state.isAdmin = false;
    },

    setRandomWord(state, randomWord){
      state.randomWord = randomWord;
    },

    setLastWord(state, lastWord){
      state.lastWord = lastWord;
    },

    setSubmitWord(state, submitWord){
      state.submitWord = submitWord;
    },
    
    changeLastWord(state, submitWord){
      state.lastWord = submitWord;
    }


    
    
  }
})