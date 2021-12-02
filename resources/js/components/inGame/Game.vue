<template>
<div class="flex items-center justify-center w-screen p-10">
	<div class="grid xl:grid-cols-4 md:grid-cols-3 grid-cols-1 gap-2 max-w">
		<div class="flex flex-col bg-gray-200 rounded-lg p-4 m-2
            hover:bg-blue-500 hover:text-gray-100 focus:border-4 focus:border-blue-300 cursor-pointer">
            <p>제시된 단어</p>
			<div class="flex flex-col items-start mt-4">
				<h1 class="text-xl font-bold">{{randomWord}}</h1>
				<p class="text-sm">
                    {{ lastWord }}
                </p>
			</div>
		</div>
	</div>
</div>
</template>



<script>
export default {
    computed: {
        isGame(){
            return this.$store.state.isGame;
        },
        randomWord(){
            return this.$store.state.randomWord;
        },
        lastWord(){
            return this.$store.state.lastWord;
        },
        submitWord(){
            return this.$store.state.submitWord;
        },
        round(){
            return this.$store.state.round;
        },
        roomId(){
            return this.$store.state.roomId;
        }
    },
    data() {
        return {
            firstStart:true,
        }
    },
    methods:{
        gameEnd(){
            this.$store.commit('game_End');
        },
        getRandomWord(){
                this.$store.commit('getRandomWord');
            }
        
    },
    created(){
        this.getRandomWord();
    },
    // watch:{
    //     isGame:function(){
    //         console.log('a');
    //         this.getRandomWord();
    //     }
    // }
}
</script>

<style>

</style>