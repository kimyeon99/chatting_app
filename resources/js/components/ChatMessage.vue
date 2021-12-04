<template>
    <div>
        <div v-if="message.from.id!=1">
            <strong> {{ message.from.name }} {{ message.created_at }} </strong>
        </div>

        <div v-if="message.from.id==1">
            <strong>{{ message.text }}</strong>
        </div>

        <div v-else>
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

        }
    }
}
</script>

<style>

</style>