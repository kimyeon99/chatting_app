<template>
<div class="flex items-center justify-center w-screen p-10">
	<!-- Resice the preview panel to check the responsiveness -->
	<!-- Component Start -->
        <chat-user-list :current-user="currentUser"
        ></chat-user-list>

	<div class="grid xl:grid-cols-4 md:grid-cols-3 grid-cols-1 gap-2 max-w">
		<!-- Tile 1 -->
		<div v-for="room in rooms" :key="room.id" class="flex flex-col bg-gray-200 rounded-lg p-4 m-2
            hover:bg-blue-500 hover:text-gray-100 focus:border-4 focus:border-blue-300 cursor-pointer"
                @click="a(room)"
            >
			<div class="flex flex-col items-start mt-4">
				<h1 class="text-xl font-bold">{{ room.title }}</h1>
				<p class="text-sm">
                    {{ room.id }}번 방
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
        currentUser: {
                type: Number,
                required: true
        },
        rooms:{
            type:Array,
            required:true
        }
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
    methods:{ //오또케 진짜 ㅡ.ㅡ((퍽))
        a(room) {
        //   axios.post('/room').then((res) => res.data) 룸 정보를 등록하고 
        // then에 도착하면 등록이 끝난건데 그때까지 loading해줘야함 
        // 서버에서는 등록하고 나서 response 를 번호는 줘야됨 무조건 
          axios.get('/room/'+roomId).then(res => {
                        //push: 끝에 추가
                        //<router-view></router-view>
                        this.$router.push({name:'TheRoom',  params: {'id':room.id, room:room, currentUser:this.currentUser, roomId:room.id}});
                    }).catch(error => {
              console.log(error);
        });
      }
    }   
}
</script>

<style>

</style>