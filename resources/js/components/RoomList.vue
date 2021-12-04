<template>
<div class="flex items-center justify-center w-screen p-10">
	<!-- Resice the preview panel to check the responsiveness -->
	<!-- Component Start -->
        <chat-user-list :current-user="currentUser"
        ></chat-user-list>

            <button class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded"
            @click="refresh">    
                새로고침
            </button>

	<div class="grid xl:grid-cols-4 md:grid-cols-3 grid-cols-1 gap-2 max-w">
		<!-- Tile 1 -->
		<div v-for="room in rooms" :key="room.id" class="flex flex-col bg-gray-200 rounded-lg p-4 m-2
            hover:bg-blue-500 hover:text-gray-100 focus:border-4 focus:border-blue-300 cursor-pointer"
                @click="goRoom(room.id)"
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

    methods:{ //오또케 진짜 ㅡ.ㅡ((퍽))
        goRoom(roomId) {
            this.$store.commit('get_RoomId', roomId);
            //   axios.post('/room').then((res) => res.data) 룸 정보를 등록하고 
            // then에 도착하면 등록이 끝난건데 그때까지 loading해줘야함 
            // 서버에서는 등록하고 나서 response 를 번호는 줘야됨 무조건
            
            axios.get('/room/'+roomId).then(res => {
                            this.$router.push({name:'TheRoom',  params: {'roomId':roomId, room:res.data}});
                        }).catch(error => {
                console.log(error);
            });
        },

        refresh(){
                this.$router.go();
        }
    }
}
</script>

<style>

</style>