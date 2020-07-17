<template>
    <v-container v-if="question">

        <div v-if="editing">
            <v-form @submit.prevent="update">
                <v-text-field
                    v-model="form.title"
                    label="Title"
                    type="text"
                    required
                ></v-text-field>
                <span class="red--text" v-if="errors.title">{{ errors.title[0]}}</span>

                <v-autocomplete
                    :items="categories.data"
                    color="white"
                    item-text="name"
                    item-value="id"
                    label="Category"
                    v-model="form.category_id"
                ></v-autocomplete>
                <span class="red--text" v-if="errors.category_id">{{ errors.category_id[0]}}</span>

                <vue-simplemde v-model="form.body"/>
                <span class="red--text" v-if="errors.body">{{ errors.body[0]}}</span><br>


                <v-btn color="green" type="submit">Update</v-btn>
                <v-btn  type="button" @click="cancel">Cancel</v-btn>

            </v-form>
        </div>

        <div v-else>
            <v-card>
                <v-container fluid>
                    <v-card-title>
                        <div>
                            <div class="headline">
                                {{ question.title }}
                            </div>
                            <span class="grey--text">{{ question.user }} said {{ question.created_at }}</span>
                        </div>
                        <v-spacer></v-spacer>
                        <v-btn color="teal" dark>{{ this.reply_count }} Replies</v-btn>
                    </v-card-title>
                    <v-card-text v-html="body"></v-card-text>

                    <v-card-actions v-if="own">
                        <v-btn icon small @click="edit">
                            <v-icon color="orange">fas fa-edit</v-icon>
                        </v-btn>
                        <v-btn icon small @click="destroy">
                            <v-icon color="red">fas fa-trash</v-icon>
                        </v-btn>
                    </v-card-actions>
                </v-container>
            </v-card>
        </div>

        <div v-if="!editing">
            <replies :question="question"></replies>
            <new-reply v-if="loggedIn" :questionSlug="question.slug"></new-reply>
            <div v-else class="mt-5">
                <router-link to="/login">
                    Login to Reply
                </router-link>
            </div>
        </div>


    </v-container>
</template>

<script>
    import Replies from "../Reply/Replies";
    import NewReply from '../Reply/NewReply';

    export default {
        name: "Read",
        data() {
            return  {
                question: null,
                editing: false,

                form: {
                    title: null,
                    category_id: null,
                    body: null,
                },
                categories: {},
                errors: {},
                increment_reply: 0,

                beforeEditQuestionTitle: '',
                beforeEditQuestionBody: '',
                beforeEditQuestionCategory_id: '',
            }
        },
        components: {
            Replies, NewReply
        },

        created() {
            this.getQuestion();
            this.getCategory();
            this.listen();
        },

        computed: {
            loggedIn() {
                return User.loggedIn();
            },

            body() {
                return md.parse(this.question.body);
            },

            reply_count()  {
                return this.question.reply_count + this.increment_reply;
            },
            own() {
                return User.own(this.question.user_id)
            }
        },
        methods: {
            getQuestion() {
                axios.get(`/api/question/${this.$route.params.slug}`)
                    .then(res => this.question = res.data.data)
                    .catch(error => console.log(error.response.data));
            },

            getCategory() {
                axios.get('/api/category')
                    .then(res => this.categories = res.data);
            },

            listen() {
                EventBus.$on('newReply', () => {
                    this.increment_reply++;
                });

                EventBus.$on('deleteReply', () => {
                    this.increment_reply--;
                })

                Echo.private('App.User.' + User.id())
                    .notification((notification) => {
                        this.increment_reply++;
                    });

                Echo.channel('DeleteReplyChannel')
                    .listen('DeleteReplyEvent', (e) => {
                        this.increment_reply--;
                    })
            },

            destroy() {
                if(this.own === true) {
                    axios.delete(`/api/question/${this.question.slug}`)
                        .then(res => this.$router.push('/forum'))
                        .catch(error => console.log(error.response.data));
                }
            },

            edit() {
                this.form = this.question;
                this.editing = true;

                this.beforeEditQuestionTitle = this.form.title;
                this.beforeEditQuestionBody = this.form.body;
                this.beforeEditQuestionCategory_id = this.form.category_id;
            },

            cancel() {
                this.editing = false;

                if (this.question.title !== this.beforeEditQuestionTitle ) {
                    this.form.title = this.beforeEditQuestionTitle;
                    this.beforeEditQuestionTitle = '';
                }

                if (this.question.body !== this.beforeEditQuestionBody ) {
                    this.form.body = this.beforeEditQuestionBody;
                    this.beforeEditQuestionBody = '';
                }

                if (this.question.category_id !== this.beforeEditQuestionCategory_id ) {
                    this.form.category_id = this.beforeEditQuestionCategory_id;
                    this.beforeEditQuestionCategory_id = '';
                }

            },
            update() {
                axios.patch(`/api/question/${this.form.slug}`, this.form)
                    .then(res =>  this.editing = false)
                    .catch(error => console.log(error.response.data));
            }
        }
    }
</script>

<style scoped>

</style>
