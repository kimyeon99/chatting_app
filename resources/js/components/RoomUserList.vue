<template>

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