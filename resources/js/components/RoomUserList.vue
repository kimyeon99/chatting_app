<template>


<!-- component -->
<!-- component -->
<div class="flex-1 bg-gray-200 p-4 flex justify-center items-center">
<div class="bg-white w-full md:max-w-4xl rounded-lg shadow">
<div class="h-12 flex justify-between items-center border-b border-gray-200 m-4">
  <div >
   <div class="text-xl font-bold text-gray-700">{{room.title}}</div>
   <div class="text-sm font-base text-gray-500">Waiting for more players...</div>
  </div>
  <div>
    <div class="flex items-center justify-center w-full  shadow-md rounded-full">
      <label
          htmlFor="toogleA"
          class="flex items-center cursor-pointer"
      >
        <div class="flex items-center">
          <input id="toogleA" type="checkbox" class="hidden"/>
          <div
              class="toggle__line w-20 h-10 bg-gray-300 rounded-full shadow-inner"
          >
          </div>
          <div
              class="toggle__dot bg-red-400 absolute w-10 h-10 bg-white rounded-full shadow flex items-center justify-center"
          >
            <svg class="text-white w-6 h-6 " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z" />
            </svg>
          </div>
        </div>
      </label>
    </div>
  </div>
</div>


<!--프로필-->
<div class="px-6">
  <div v-for="roomUser in roomUsers" :key="roomUser.id"
  class="flex justify-between items-center h-16 p-4 my-6  rounded-lg border border-gray-100 shadow-md">
    <div class="flex items-center">
      <img class="rounded-full h-12 w-12" src="https://static-cdn.jtvnw.net/jtv_user_pictures/27fdad08-a2c2-4e0b-8983-448c39519643-profile_image-70x70.png" alt="Logo" />
    <div class="ml-2">
      <div class="text-sm font-semibold text-gray-600">{{roomUser.name}}</div>
      <div class="text-sm font-light text-gray-500" v-if="roomUser.id == 1">방장</div>
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
  
  

  <div class="flex bg-gray-200 justify-center items-center h-16 p-4 my-6  rounded-lg  shadow-inner">
    <div class="flex items-center border border-gray-400 p-2 border-dashed rounded cursor-pointer">
    
      <div class="ml-1 text-gray-500 font-medium"> Invite a friend</div>
    </div>
  </div>
</div>
  <div class="p-6 ">
    <button class="p-4 bg-green-400 hover:bg-green-500 w-full rounded-lg shadow text-xl font-medium uppercase text-white">Start the game</button>
  </div>
</div>
    </div>


        <!-- <div class="w-1/5 border-r-2 border-solid border-gray-600 " style="height: 600px;">
            
        <div
            v-for="user in usersWithoutSignedInUser"
            :key="user.id"
            class="p-2 border-b-2 border-gray-600 hover:bg-gray-300 cursor-pointer"
            :class="{'text-pink-500': chatWith === user.id}"
            @click="updateChatWith(user.id)"
        >
        </div> -->


    
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

         },
        // computed: {

        // },
        data() {
            return {
                users: []
            }
        },

        // methods: {

        // }
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