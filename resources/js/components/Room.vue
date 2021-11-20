<template>
    <div v-if="room">
        <!-- <h1>{{ room.title}}</h1>
        <div> {{ room.name}}</div> -->
    </div>
    <div v-else>
        Loading 중
    </div>
</template>

<script>
export default {
    created() {
        //만약에 axios.get이 느려진다면 loading 화면이 필요함 
        // 서버에 2번 room의 정보를 요청
        // 자신의 params 읽어서 그 params를 이용해 axios를 날린다  params란 방 번호
        // axios.get('/room/{2})
            // .then((res) => room = res.data)
    }
}
</script>

<style>

</style>