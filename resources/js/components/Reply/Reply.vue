<template>
    <div>
        <v-card class="mt-3">
            <v-card-title>
                <div class="headline">{{ data.user }}</div>
                <div class="ml-2">said {{ data.created_at }}</div>
            </v-card-title>
            <v-card-text v-html="data.reply"></v-card-text>
        </v-card>
    </div>
</template>

<script>
    export default {
        name: "Reply",
        props: ['data'],
        data() {
            return {

            }
        }
    }
</script>

<style scoped>

</style>
