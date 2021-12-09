<template>
    <div class="flex-1 overflow-y-scroll" v-chat-scroll>
        <ChatMessage
        v-for="(message, index) in messages" 
        :key="index" :message="message"></ChatMessage>
        
    </div>
</template>

<script>
import ChatMessage from './ChatMessage';
export default {
    components: { 
        ChatMessage 
      },

    props: {
        chatId: {
            type: Number,
            required: true
        },
        messages: {
            type: Array,
            required: true
        }
    }
    ,
    created(){
        console.log('messages', this.messages);
    }
}
</script>
