import TheRoom from './components/Room.vue';
import RoomList from './components/RoomList.vue';
import TheChat from './components/Chat.vue';
import TheGame from './components/inGame/Game.vue';

export default{
     mode : 'history',
 
    routes:[
        {
            path: '/', 
            name: 'RoomList', 
            component: RoomList,
        },
        {
            path: '/room/:roomId', 
            name: 'TheRoom', 
            component:TheRoom,
            props:true
        },
        // {
        //     path: '/room/:roomId/gameStart', 
        //     name: 'TheGame', 
        //     component:TheGame,
        //     props:true
        // },
    ] 
};
 
// const router = new VueRouter({
//     mode: 'history',
//     routes: [
//       {
//         path: '/room/:id', component: TheRoom
//       }
//    ]
//   });
