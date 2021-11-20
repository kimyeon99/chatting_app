import TheRoom from './components/Room';

export default{
    mode : 'history',
 
    routes:[
        {
            path: '/room', component: TheRoom
        }
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