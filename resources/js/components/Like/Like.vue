<template>
    <div>
        <v-btn icon small @click="likeIt">
            <v-icon :color="color">fas fa-heart</v-icon>
            <span class="ml-2">{{ count }}</span>
        </v-btn>
    </div>
</template>

<script>
    export default {
        name: "Like",
        props: ['content'],
        data() {
            return {
                liked: this.content.user_liked,
                count: this.content.like_count,
            }
        },
        computed: {
            color() {
                return this.liked ? 'red' : 'red lighten-4';
            }
        },
        methods: {
            likeIt() {
                if(User.loggedIn()) {
                    this.liked ? this.decrement() : this.increment();
                    this.liked =  !this.liked;
                }
            },
            increment() {
                axios.post(`/api/like/${this.content.id}`)
                    .then(res => this.count++);
            },
            decrement() {
                axios.delete(`/api/like/${this.content.id}`)
                    .then(res => this.count--);
            }
        }

    }
</script>

<style scoped>

</style>
