<template>
    <div>
        <vue-simplemde v-model="reply.reply"/>
        <v-card-actions class="ml-5">
            <v-btn color="green" @click="update">Save</v-btn>
            <v-btn dark @click="cancel">Cancel</v-btn>
        </v-card-actions>
    </div>
</template>

<script>
    export default {
        name: "EditReply",
        props: ['reply'],
        methods: {
            update() {

            },
            cancel() {
                EventBus.$emit('cancelEditing');
            }
        }
    }
</script>

<style scoped>

</style>
