<template>
<div>
<div class="tab_content" style="margin-top: 50px;">
    <input type="radio" name="tabmenu" id="ta01" checked>
    <label for="ta01" style="margin-left: 5%; background-color: red;">컨텐츠 탭 버튼1</label>
    <input type="radio" name="tabmenu" id="ta02" >
    <label for="ta02" style="background-color: orange;">컨텐츠 탭 버튼2</label>
    <input type="radio" name="tabmenu" id="ta03" >
    <label for="ta03" style="background-color: yellow;">컨텐츠 탭 버튼3</label>

    <div class="conbox con1" id="backbox">
        <!-- 이안에 바로내용쓰지말고 div 
        한개더만든다음 안에 쓰기 -->
        <router-view :rooms="rooms" :current-user="currentUser"></router-view>
    </div>
    <div class="conbox con2" id="backbox">컨텐츠 내용02</div>
    <div class="conbox con3" id="backbox">컨텐츠 내용03</div>


</div>    
</div>

</template>

<script>
    export default {
        props: {
           rooms:{
               type: Array,
                required: true
           },
           currentUser:{
               type: Number,
                required: true
           }
        },

    }
</script>
<style>
    /* 끄투배경 */
    input[type="radio"] {display:none;}
    input[type="radio"] + label {
        display: inline-block;
        width: 200px;
        height: 30px;
        line-height: 30px;
        border-radius: 10px  10px 0px 0px;
        text-align: center;
        padding: 20px;
        margin: 0;
        background-color: white; 
        color: black; 
        font-size: 20px;
        font-weight: bolder; 
        cursor: pointer;}
    input[type="radio"]:checked + label { color: black;}
    body{background-color: rgb(155, 119, 119);}
    .conbox{width: 500px;
        height: 600px; 
        background-color: 
        white;
        margin: 0 auto; 
        display: none;}
    input[id="ta01"]:checked ~ .con1 {display: block;}
    input[id="ta02"]:checked ~ .con2 {display: block;}
    input[id="ta03"]:checked ~ .con3 {display: block;} 
    #backbox{
        width: 80%;
        height: 600px;
        border-radius: 0px  20px 20px 20px;
    }
    /* 끄투배경 */
</style>