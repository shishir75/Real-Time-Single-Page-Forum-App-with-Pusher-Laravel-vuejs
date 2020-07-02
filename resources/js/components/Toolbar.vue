<template>
    <v-card color="grey lighten-4" flat tile>
        <v-toolbar dense>

            <v-toolbar-title>Title</v-toolbar-title>

            <v-spacer></v-spacer>

            <v-toolbar-items class="hidden-sm-and-down">
                <v-btn text>Forum</v-btn>
                <v-btn text>Ask a Question</v-btn>
                <v-btn text>Category</v-btn>
                <v-btn text>Login</v-btn>
            </v-toolbar-items>


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
