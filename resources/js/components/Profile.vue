<template>
<div
                        class="bg-white my-12 pb-6 w-full justify-center items-center overflow-hidden md:max-w-sm rounded-lg shadow-sm mx-auto"
                        style="margin: 0 0 0 10px">
                        <div class="relative h-40">

                        </div>
                        
                        <div
                            class="relative shadow mx-auto h-24 w-24 -my-12 border-white rounded-full overflow-hidden border-4">
                            <img src="" class="object-cover w-full h-full">
                        </div>

                        <div class="mt-16">
                            <h1 class="text-lg text-center font-semibold">
                                {{ user.name }}
                            </h1>
                            
                            
                        </div>

                    </div>
  
</template>

<script>
export default {
        props: {
            currentUser: {
                type: Number,
                required: true
            }
        },
        data() {
            return {
                user: []
            }
        },
        created() {
            this.getProfile();
        },
        methods:{
            getProfile(){
                axios.get('/user')
                .then(res => {
                    this.user = res.data
                    console.log(this.user);
                }).catch(error => {
                    console.log(error);
                });
            }
        }
}
</script>

<style>

</style>