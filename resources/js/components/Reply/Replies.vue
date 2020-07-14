<template>
    <v-container>
        <reply v-for="reply in replies" :key="reply.id" :data="reply"></reply>
    </v-container>
</template>

<script>
    import Reply from "./Reply";
    export default {
        name: "Replies",
        props: ['replies'],
        components: { Reply, },
        data() {
            return {

            }
        },
        methods: {

        }
    }
</script>

<style scoped>

</style>
