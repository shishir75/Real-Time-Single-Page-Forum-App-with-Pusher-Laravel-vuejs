<template>
    <div>
        <v-card class="mt-3">
            <v-card-title>
                <div class="headline">{{ data.user }}</div>
                <div class="ml-2">said {{ data.created_at }}</div>
            </v-card-title>

            <v-divider></v-divider>

            <v-card-text v-html="data.reply"></v-card-text>

            <v-divider></v-divider>

            <v-card-actions class="ml-5" v-if="own">
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
    export default {
        name: "Reply",
        props: ['data'],
        computed: {
            own() {
                return User.own(this.data.user_id);
            }
        },
        methods: {
            edit() {

            },
            destroy() {

            }
        }
    }
</script>

<style scoped>

</style>
