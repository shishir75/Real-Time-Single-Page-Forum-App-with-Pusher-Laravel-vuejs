<template>
    <v-card class="mt-3">
        <v-toolbar color="indigo" dark>
            <v-toolbar-title>Categories</v-toolbar-title>
        </v-toolbar>

        <v-list dense>
            <v-list-item v-for="category in categories" :key="category.id">
                <v-list-item-content>
                    <v-list-item-title>{{ category.name }}</v-list-item-title>
                </v-list-item-content>
            </v-list-item>
        </v-list>

    </v-card>
</template>

<script>
    export default {
        name: "AppSidebar",
        data() {
            return {
                categories: {},
            }
        },
        created() {
            axios.get('/api/category')
                .then(res => this.categories = res.data.data);
        }
    }
</script>

<style scoped>

</style>
