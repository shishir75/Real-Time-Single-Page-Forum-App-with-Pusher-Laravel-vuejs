<template>
    <v-card color="grey lighten-4" flat tile>
        <v-toolbar dense>

            <v-toolbar-title>Title</v-toolbar-title>

            <v-spacer></v-spacer>

            <div class="hidden-sm-and-down">
                <router-link to="/forum">
                    <v-btn text>Forum</v-btn>
                </router-link>
                <v-btn text>Ask a Question</v-btn>
                <v-btn text>Category</v-btn>
                <router-link to="/login">
                    <v-btn text>Login</v-btn>
                </router-link>
            </div>


        </v-toolbar>
    </v-card>
</template>

<script>
    export default {
        name: "Toolbar",
    }
</script>

<style scoped>

</style>
