<template>
<div>
<div class="tab_content" style="margin-top: 50px;" >
    <input type="radio" name="tabmenu" id="ta01" checked>
    <label for="ta01" style="margin-left: 150px; background-color: gray;">BTN</label>
    <input type="radio" name="tabmenu" id="ta02" >
<label for="ta02" style="background-color: gray;">BTN2</label>
    <!--<input type="radio" name="tabmenu" id="ta03" >
    <label for="ta03" style="background-color: gray;">BTN3</label>-->

    <div class="conbox con1" id="backbox" >
        <div>
        <router-view :rooms="rooms" :current-user="currentUser"></router-view>
        </div>
        <div class="flex-1" style="border: 3px solid gray; padding: 20px; margin-left: 50px; width: 930px;
          border-radius: 15px; "> 
            <!-- <the-profile :current-user="currentUser"></the-profile> -->
            <chat-component :current-user="currentUser"></chat-component>
        </div>
    </div>
    <div class="conbox con2" id="backbox">
        <the-post></the-post>
    </div>
    <div class="conbox con3" id="backbox">컨텐츠 내용03</div>




</div>

</div>

</template>

<script>
    import RoomList from './RoomList.vue';
    import Chat from './Chat.vue';

    export default {
        components: {
            RoomList,
            Chat
        },
        props: {
           rooms:{
               type: Array,
                required: true
           },
           currentUser:{
               type: Number,
                required: true
           },
        },
    }
</script>
<style>
    /* 끄투배경 */
    body{
        min-width: 1300px;
        max-width: 1300px;
        margin:0 auto;
    }
    input[type="radio"] {display:none;}
    input[type="radio"] + label {
        display: inline-block;
        width: 200px;
        height: 50px;
        line-height: 30px;
        border-radius: 10px  10px 0px 0px;
        text-align: center;
        padding: 20px;
        margin: 0;
        color: black; 
        font-size: 20px;
        font-weight: bolder; 
        cursor: pointer;}
    input[type="radio"]:checked + label { color: black;}
    body{background-color: rgb(29, 28, 28);}
    .conbox{
        width: 500px;
        height: 1500px; 
        background-color: 
        white;
        margin: 0 auto; 
        display: none;}
    input[id="ta01"]:checked ~ .con1 {display: block;}
    input[id="ta02"]:checked ~ .con2 {display: block;}
    input[id="ta03"]:checked ~ .con3 {display: block;} 
    #backbox{
        width: 80%;
        height: 900px;
        border-radius: 0px  20px 20px 20px;
    }
    /* 끄투배경 */
</style>