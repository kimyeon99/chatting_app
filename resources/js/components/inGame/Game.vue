<template>
  <div class="flex items-center justify-center w-screen p-10">
	<div class="grid xl:grid-cols-4 md:grid-cols-3 grid-cols-1 gap-2 max-w">

			<div class="flex flex-col items-start mt-4">
				<p class="text-sm" v-if="round==5">
                    {{ randomWord }}
                </p>
                <p class="text-sm" v-else>
                    {{ lastWord }}
                </p>
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
        }
    },
    data() {
        return {
            firstStart:true,
            round:5,
        }
    },
    methods:{
        gameEnd(){
            this.$store.commit('game_End');
        }
    },

}
</script>

<style>

</style>