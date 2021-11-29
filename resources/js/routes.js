import TheRoom from './components/Room.vue';
import RoomList from './components/RoomList.vue';
import TheChat from './components/Chat.vue';

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
