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
  },
  mutations: {
    get_RoomId (state, roomId)
    //state의 roomId 변수에 넘겨받은 roomId값을 입력함
     {
      state.roomId = roomId;
    },
    game_Start(){
      isGame = true;
    },
    game_End(){
      isGame = false;
    },
    
  }
})