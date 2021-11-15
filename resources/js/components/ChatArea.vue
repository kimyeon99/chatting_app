<template>
    <div class="flex-1">Char Area
        <p>Chatting with user {{chatId}}</p>
        
        <chat-message></chat-message>
    </div>
</template>

<script>
import ChatMessage from './ChatMessage.vue'
export default {
  components: { ChatMessage },
    props: {
        chatId: {
            type: Number,
            require: true
        }
    }
}
</script>

<style>

</style>