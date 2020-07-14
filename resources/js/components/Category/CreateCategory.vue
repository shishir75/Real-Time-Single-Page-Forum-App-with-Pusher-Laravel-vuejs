<template>
    <v-container>
        <v-form @submit.prevent="create">
            <v-text-field
                v-model="form.name"
                label="Category Name"
                type="text"
                required
            ></v-text-field>

            <v-btn type="submit" color="teal">Create</v-btn>

            <v-card class="mt-3">
                <v-toolbar color="indigo" dark>
                    <v-toolbar-title>Categories</v-toolbar-title>
                </v-toolbar>

                <v-list dense>
                    <div v-for="category in categories" :key="category.id">
                        <v-list-item>
                            <v-list-item-content>
                                <v-list-item-title>{{ category.name }}</v-list-item-title>
                            </v-list-item-content>
                            <v-btn icon small @click="edit" class="mr-5">
                                <v-icon color="orange">fas fa-edit</v-icon>
                            </v-btn>
                            <v-btn icon small @click="destroy">
                                <v-icon color="red">fas fa-trash</v-icon>
                            </v-btn>
                        </v-list-item>
                        <v-divider></v-divider>
                    </div>


                </v-list>
            </v-card>

        </v-form>
    </v-container>
</template>

<script>
    export default {
        name: "CreateCategory",
        data() {
            return {
                form: {
                    name: null,
                },
                categories: {},
            }
        },
        methods: {
            create() {
                axios.post('/api/category', this.form)
                    .then(res => console.log(res.data.data))
                    .catch(error => console.log(error.response.data));
            },
            edit() {

            },
            destroy() {

            }
        },
        created() {
            axios.get('/api/category')
                .then(res => this.categories = res.data.data)
                .catch(error => console.log(error.response.data));
        }
    }
</script>

<style scoped>

</style>
