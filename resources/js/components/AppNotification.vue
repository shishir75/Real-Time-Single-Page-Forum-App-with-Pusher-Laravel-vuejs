<template>
    <div class="text-center">
        <v-menu offset-y>
            <template v-slot:activator="{ on, attrs }">
                <v-btn icon small class="mr-6" v-bind="attrs" v-on="on" dark>
                    <v-icon :color="color">fas fa-bell</v-icon>
                    <v-badge color="green" :content="unreadCount" v-if="unreadCount > 0"></v-badge>
                </v-btn>
            </template>
            <v-list>
                <v-list-item v-for="item in unread" :key="item.id">
                    <router-link :to="item.path">
                        <v-list-item-title @click="readNoti(item)">
                            {{ item.replyBy }} replied on {{ item.question }}
                        </v-list-item-title>
                    </router-link>

                </v-list-item>

                <v-divider></v-divider>

                <v-list-item v-for="item in read" :key="item.id">
                    <v-list-item-title class="grey--text">{{ item.replyBy }} replied on {{ item.question }}</v-list-item-title>
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

            Echo.private('App.User.' + User.id())
                .notification((notification) => {
                    this.unread.unshift(notification);
                    this.unreadCount++;
                });

        },
        computed: {
            color() {
                return this.unreadCount > 0 ? 'red' : 'red lighten-4';
            }
        },
        methods: {
            getNotifications() {
                axios.post('/api/notifications')
                    .then(res => {
                        this.read = res.data.read;
                        this.unread = res.data.unread;
                        this.unreadCount = res.data.unread.length;
                    })
                    .catch(error => Exception.handle(error));
            },

            readNoti(notification) {
                axios.post('/api/markAsRead', { id: notification.id})
                    .then(res => {
                        this.unread.splice(notification, 1);
                        this.read.push(notification);
                        this.unreadCount--;
                    })
            }
        }
    }
</script>

<style scoped>

</style>
