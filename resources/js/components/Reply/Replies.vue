<template>
    <v-container>
        <reply v-for="reply in replies" :key="reply.id" :data="reply" v-if="replies"></reply>
    </v-container>
</template>

<script>
    import Reply from "./Reply";
    export default {
        name: "Replies",
        props: ['replies'],
        components: { Reply, },
    }
</script>

<style scoped>

</style>
