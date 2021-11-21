<template>
    <div>
        <div>
            <strong> {{ message.from.name }} {{ message.created_at }} </strong>
        </div>
        <div>
            {{ message.text }}
        </div>
    </div>
    
</template>

<script>
export default {
    props: {
        message: {
            type: Object,
            required: true
        },
        room: {
            type:Object,
            require: true
        }

    },
    created(){
            // bootstrap.js->echo
            window.Echo.private(`chat.${room}`).listen('RoomMessageSent',e =>{
                // 보내는 사람과 받는 사람이 일치할 경우에만 메세지 push
                if(e.message.to === this.currentUser && e.message.from === this.chatWith )
                this.messages.push(e.message);
            });
        },
}
</script>

<style>

</style>

