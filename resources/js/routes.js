import TheRoom from './components/Room.vue';
import RoomList from './components/RoomList.vue';


export default{
     mode : 'history',
 
    routes:[
        {
            path: '/', 
            name: 'RoomList', 
            component: RoomList,
        },
        {
            path: '/room/:id', 
            name: 'TheRoom', 
            component: TheRoom,
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
