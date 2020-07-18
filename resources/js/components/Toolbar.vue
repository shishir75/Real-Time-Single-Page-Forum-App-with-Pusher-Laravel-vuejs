<template>
    <v-card color="grey lighten-4" flat tile>
        <v-toolbar color="indigo" dark>

            <v-toolbar-title>
                <router-link to="/" class="white--text">
                    Single Page Real Time Forum
                </router-link>
            </v-toolbar-title>

            <v-spacer></v-spacer>

            <app-notification v-if="logged"></app-notification>

            <div class="hidden-sm-and-down">
                <router-link v-for="item in items" :key="item.title" :to="item.to" v-if="item.show">
                    <v-btn text>{{ item.title }}</v-btn>
                </router-link>
            </div>

        </v-toolbar>
    </v-card>
</template>

<script>
    import AppNotification from "./AppNotification";
    export default {
        name: "Toolbar",

        components: { AppNotification, },
        data() {
            return {
                logged: User.loggedIn(),
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
