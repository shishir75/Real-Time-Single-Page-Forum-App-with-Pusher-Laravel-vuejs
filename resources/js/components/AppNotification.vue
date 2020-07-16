<template>
    <div class="text-center">
        <v-menu offset-y>
            <template v-slot:activator="{ on, attrs }">
                <v-btn icon small class="mr-6" v-bind="attrs" v-on="on" dark>
                    <v-icon color="red">fas fa-bell</v-icon>
                    <v-badge color="green" :content="unreadCount"></v-badge>
                </v-btn>
            </template>
            <v-list>
                <v-list-item v-for="item in unread" :key="item.id">
                    <v-list-item-title>
                        {{ item.data.replyBy }} replied on {{ item.data.question }}
                    </v-list-item-title>
                </v-list-item>

                <v-divider></v-divider>

                <v-list-item v-for="item in read" :key="item.id">
                    <v-list-item-title class="grey--text">{{ item.data.replyBy }} replied on {{ item.data.question }}</v-list-item-title>
                </v-list-item>
            </v-list>
        </v-menu>
    </div>
</template>

<script>
    export default {
        name: "AppNotification",
        data() {
            return {
                read: {},
                unread: {},
                unreadCount: 0,
            }
        },
        created() {
            if(User.loggedIn()) {
                this.getNotifications();
            }
        },
        methods: {
            getNotifications() {
                axios.get('/api/notifications')
                    .then(res => {
                        this.read = res.data.read;
                        this.unread = res.data.unread;
                        this.unreadCount = res.data.unread.length;
                    });
            }
        }
    }
</script>

<style scoped>

</style>
