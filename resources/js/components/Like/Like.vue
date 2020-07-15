<template>
    <div>
        <v-btn icon small @click="likeIt">
            <v-icon :color="this.liked ? 'red' : ''">fas fa-heart</v-icon>
            <span class="ml-2">{{ count }}</span>
        </v-btn>
    </div>
</template>

<script>
    export default {
        name: "Like",
        data() {
            return {
                liked: false,
                count: 0
            }
        },
        methods: {
            likeIt() {
                if(User.loggedIn()) {
                    this.liked ? this.increment() : this.decrement();
                    this.liked =  !this.liked;
                }
            },
            increment() {
                this.count++;
            },
            decrement() {
                this.count--;
            }
        }

    }
</script>

<style scoped>

</style>
