<template>
    <h1>{{ question.title }}</h1>
</template>

<script>
    export default {
        name: "Read",
        data() {
            return  {
                question: {},
            }
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
