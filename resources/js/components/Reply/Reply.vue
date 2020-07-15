<template>
    <div>
        <v-card class="mt-3">
            <v-card-title>
                <div class="headline">{{ data.user }}</div>
                <div class="ml-2">said {{ data.created_at }}</div>
                <v-spacer></v-spacer>
                <like></like>
            </v-card-title>

            <v-divider></v-divider>

            <edit-reply v-if="editing" :reply="data"></edit-reply>

            <v-card-text v-else v-html="reply"></v-card-text>

            <v-divider></v-divider>

            <v-card-actions class="ml-5" v-if="own && !editing">
                <v-btn icon small @click="edit">
                    <v-icon color="orange">fas fa-edit</v-icon>
                </v-btn>
                <v-btn icon small @click="destroy" class="ml-5">
                    <v-icon color="red">fas fa-trash</v-icon>
                </v-btn>
            </v-card-actions>
        </v-card>
    </div>
</template>

<script>
    import EditReply from "./EditReply";
    import Like from '../Like/Like';

    export default {
        name: "Reply",
        props: ['data', 'index'],
        data() {
            return {
                editing: false,
                beforeEditReplyBody: '',
            }
        },
        components: {
            EditReply, Like
        },
        computed: {
            own() {
                return User.own(this.data.user_id);
            },
            reply() {
                return md.parse(this.data.reply);
            }
        },
        methods: {
            edit() {
                this.editing = true;
                this.beforeEditReplyBody = this.data.reply;
            },
            destroy() {
                EventBus.$emit('deleteReply', this.index);
            },
            listen() {
                EventBus.$on('cancelEditing', (reply) => {
                    this.editing = false;
                    if (reply !== this.data.reply) {
                        this.data.reply = this.beforeEditReplyBody;
                        this.beforeEditReplyBody = '';
                    }

                })
            }
        },
        created() {
            this.listen();
        },

    }
</script>

<style scoped>

</style>
