<template>
    <v-card color="grey lighten-4" flat tile>
        <v-toolbar dense>

            <v-toolbar-title>Title</v-toolbar-title>

            <v-spacer></v-spacer>

            <div class="hidden-sm-and-down">
                <router-link v-for="item in items" :key="item.title" :to="item.to" v-if="item.show">
                    <v-btn text>{{ item.title }}</v-btn>
                </router-link>
            </div>

        </v-toolbar>
    </v-card>
</template>

<script>
    export default {
        name: "Toolbar",
        data() {
            return {
                items: [
                    { title: 'Forun', to: '/forum', show: true},
                    { title: 'Ask A Question', to: '/ask', show: User.loggedIn()},
                    { title: 'Category', to: '/category', show: User.admin()},
                    { title: 'Login', to: '/login', show: !User.loggedIn()},
                    { title: 'Logout', to: '/logout', show: User.loggedIn()},
                ]
            }
        },
        created() {
            EventBus.$on('logout', () => {
                User.logout();
            })
        }
    }
</script>

<style scoped>

</style>
