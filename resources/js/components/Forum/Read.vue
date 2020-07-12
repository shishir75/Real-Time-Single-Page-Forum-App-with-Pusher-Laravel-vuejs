<template>
    <show-question :data="question"></show-question>
</template>

<script>
    import ShowQuestion from "./ShowQuestion";
    export default {
        name: "Read",
        data() {
            return  {
                question: {},
            }
        },
        components: {
            ShowQuestion,
        },
        created() {
            axios.get(`/api/question/${this.$route.params.slug}`)
                .then(res => this.question = res.data.data)
                .catch(error => console.log(error.response.data))
        }
    }
</script>

<style scoped>

</style>
