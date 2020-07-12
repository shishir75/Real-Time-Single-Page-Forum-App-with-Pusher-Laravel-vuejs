<template>
    <v-container>
        <v-form @submit.prevent="create">
            <v-text-field
                v-model="form.title"
                label="Title"
                type="text"
                required
            ></v-text-field>

            <v-autocomplete
                :items="categories.data"
                color="white"
                item-text="name"
                item-value="id"
                label="Category"
                v-model="form.category_id"
            ></v-autocomplete>

            <vue-simplemde v-model="form.body"/>


            <v-btn color="green" type="submit">Create</v-btn>
        </v-form>
    </v-container>
</template>

<script>
    export default {
        name: "Create",
        data() {
            return {
                form: {
                    title: null,
                    category_id: null,
                    body: null
                },
                categories: {},
                errors: {}
            }
        },
        created() {
          axios.get('/api/category')
            .then(res => this.categories = res.data);
        },
        methods: {
            create() {
                axios.post('/api/question', this.form)
                    .then(res => console.log(res.data.data))
                    .catch(error => this.errors = error.response.data.error);
            }
        }
    }
</script>

<style scoped>

</style>
