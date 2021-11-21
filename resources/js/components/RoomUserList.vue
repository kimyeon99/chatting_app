<template>


<!-- component -->
<div>
<body class="bg-gray-100 text-gray-700  font-sans quicksand">

  <div class="p-16">
    <div class="grid md:grid-cols-2 sm:grid-cols-1 lg:grid-cols-3 m-5 mb-10">
            <div class="bg-white overflow-hidden hover:bg-green-100 border border-gray-200 p-3">
            <div class="m-2 text-justify text-sm">
            <p class="text-right text-xs">May 17, 2020</p>

            <h2 class="font-bold text-lg h-2 mb-8"> </h2>

        </div>

    </div>
          
    </div>
  </div>

</body>
</div>






    <!-- <div class="w-1/5 border-r-2 border-solid border-gray-600 " style="height: 600px;">
            
        <div
            v-for="user in usersWithoutSignedInUser"
            :key="user.id"
            class="p-2 border-b-2 border-gray-600 hover:bg-gray-300 cursor-pointer"
            :class="{'text-pink-500': chatWith === user.id}"
            @click="updateChatWith(user.id)"
        >
        </div>
    </div> -->
</template>

<script>
        export default {
        //  props: {

        //  },
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