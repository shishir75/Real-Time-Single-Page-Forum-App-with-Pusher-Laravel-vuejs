<template>
    <div v-if="question">
        <edit-question v-if="editing" :data="question"></edit-question>
        <show-question v-else :data="question"></show-question>
        <replies :question="question"></replies>
        <new-reply :questionSlug="question.slug"></new-reply>

    </div>
</template>

<script>
    import ShowQuestion from "./ShowQuestion";
    import EditQuestion from "./EditQuestion";
    import Replies from "../Reply/Replies";
    import NewReply from '../Reply/NewReply';

    export default {
        name: "Read",
        data() {
            return  {
                question: null,
                editing: false,
            }
        },
        components: {
            ShowQuestion, EditQuestion, Replies, NewReply
        },
        created() {
            this.listen();
            this.getQuestion();
        },
        methods: {
            listen() {
                EventBus.$on('startEditing', () => {
                    this.editing = true;
                });

                EventBus.$on('cancelEditing', () => {
                    this.editing = false;
                })
            },
            getQuestion() {
                axios.get(`/api/question/${this.$route.params.slug}`)
                    .then(res => this.question = res.data.data)
                    .catch(error => console.log(error.response.data));
            },
        }
    }
</script>

<style scoped>

</style>
