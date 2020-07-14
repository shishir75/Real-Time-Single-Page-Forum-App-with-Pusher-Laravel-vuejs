<template>
    <v-container>
        <form @submit.prevent="submit">
            <vue-simplemde v-model="form.body" value="form.body"/>
            <v-btn class="teal" type="submit" dark>Reply</v-btn>
        </form>

    </v-container>
</template>

<script>
    export default {
        name: "NewReply",
        props: ['questionSlug'],
        data() {
            return {
                form: {
                    body: null
                }
            }
        },
        methods: {
            submit() {
                axios.post(`/api/question/${this.questionSlug}/reply`, { body: this.form.body})
                    .then(res => {
                        this.form.body = null;
                        EventBus.$emit('newReply', res.data.reply);
                        window.scrollTo(0,0);
                    });
            }
        }
    }
</script>

<style scoped>

</style>
