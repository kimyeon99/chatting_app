<template>
    <div class="border-r-2 border-solid border-gray-600 " style="height: 500px; width: 200px;">
            <h2 style="text-align: center;">접속자</h2>
        <div
            v-for="user in users"
            :key="user.id"
            class="p-2 border-b-2 border-gray-600 hover:bg-gray-300 cursor-pointer"
        >
            {{ user.name }}
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
                users: []
            }
        },
        created() {
            axios.get('/api/users').then(res => {
                this.users = res.data.users;
            }).catch(error => {
                console.log(error)
            });
        },
    }
</script>