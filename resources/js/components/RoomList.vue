<template>
<div class="flex items-center justify-center w-screen min-h-screen p-10">
	<!-- Resice the preview panel to check the responsiveness -->

	<!-- Component Start -->
	<div class="grid xl:grid-cols-4 md:grid-cols-3 grid-cols-1 gap-2 max-w">
		<!-- Tile 1 -->
		<div v-for="room in rooms" :key="room.id" class="flex flex-col bg-gray-200 rounded-lg p-4 m-2
            hover:bg-blue-500 hover:text-gray-100 focus:border-4 focus:border-blue-300 cursor-pointer">
			<div class="flex flex-col items-start mt-4">
				<h1 class="text-xl font-bold">{{ room.title }}</h1>
				<p class="text-sm">
                    방 참여
                </p>
			</div>
		</div>
		
	</div>
	<!-- Component End  -->

</div>  
</template>

<script>
export default {
    props:{
        rooms:{
            type:Array,
            required:true
        }
    },
    data() {
    
    },
    // created(){
    //     console.log(this.rooms);
    //     this.getRoomList();
    // },
    // computed: {
    //     updateRoomList() {
    //         this.getRoomList();
    //     }
    // },
    // methods:{ //오또케 진짜 ㅡ.ㅡ((퍽))
    //     getRoomList(){
    //         axios.get('/room/index').then(res => {
    //                 this.rooms = res.data;
    //          }).catch(error => {
    //                 console.log(error);
    //     });
    // }
    // }
        
}
</script>

<style>

</style>