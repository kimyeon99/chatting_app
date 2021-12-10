<template>

<div class="px-6">

  <div v-for="roomUser in roomUsers" :key="roomUser.id"
  class="flex justify-between items-center h-16 p-4 my-6  rounded-lg border border-gray-100 shadow-md">
    <div class="flex items-center">
      <img class="rounded-full h-12 w-12" :src="getProfile(roomUser.image)" alt="Logo"/>
    <div class="ml-2">
      <div class="text-sm font-semibold text-gray-600">{{roomUser.name}}</div>
      <div class="text-sm font-light text-gray-500" v-if="roomUser.id == host">방장</div>
    </div>
    </div>
    <div>
      <button class="bg-red-400 hover:bg-red-500 p-2 rounded-full shadow-md flex justify-center items-center">
        <svg class="text-white toggle__lock w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>
  </div>



</div>

    
</template>

<script>
        export default {
         props: {
             roomUsers: {
                 type:Array,
                 required: true
             },
             room: {
                 type:Object,
                 required: true
             },
             host:{
                  type:Number,
                 required: true
             }
            //  Player1Score:{
            //      tpye:Number,
            //      required: true
            //  },
            // Player2Score:{
            //      tpye:Number,
            //      required: true
            //  },
            // Player3Score:{
            //      tpye:Number,
            //      required: true
            //  },
            // Player4Score:{
            //      tpye:Number,
            //      required: true
            //  },
         },
         computed: {

            
         },
        data() {
            return {
                users: [],
                profileUrlP1: '',
                profileUrlP2: '',
                profileUrlP3: '',
                profileUrlP4: '',
            }
        },
        methods:{
            getProfile(url){
                 if(url === null){
                    url =  '/' +'storage/images/profiles/' + 'no_profile_image.png';
                    console.log(url)
                    return url;
                }
              url =  '/' +'storage/images/profiles/' + url;
              console.log(url);
              return url;
          },
        }


    }
</script>

<style>
  .toggle__dot {
    transition: all 0.3s ease-in-out;
}

input:checked ~ .toggle__dot {
    transform: translateX(100%);
    background-color:#68D391
}
</style>