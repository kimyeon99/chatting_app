<template>
  <div class="flex items-center justify-center w-screen p-10">
	<div class="grid xl:grid-cols-4 md:grid-cols-3 grid-cols-1 gap-2 max-w">

			<div class="flex flex-col items-start mt-4">
				<h1 class="text-xl font-bold">{{ room.title }}</h1>
				<p class="text-sm">
                    {{ room.id }}번 방
                </p>
			</div>

	</div>
</div> 
</template>

<script>
export default {
    methods:{
        getRandomWord(){
            // axios get으로 db의 단어 중 랜덤하게 한 단어를 가져온다.
            // 그 단어로 게임을 시작한다.
            axios.get
        },
        confirmWord(){
            // 유저가 제시한 단어가 정답인지
            // 확인한다.
        }
        
    }
}
</script>

<style>

</style>