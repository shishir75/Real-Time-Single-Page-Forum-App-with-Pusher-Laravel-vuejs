<template>
    <v-container>
        <v-form @submit.prevent="update">
            <v-text-field
                v-model="form.title"
                label="Title"
                type="text"
                required
            ></v-text-field>
            <span class="red--text" v-if="errors.title">{{ errors.title[0]}}</span>

            <v-autocomplete
                :items="categories.data"
                color="white"
                item-text="name"
                item-value="id"
                label="Category"
                v-model="form.category_id"
            ></v-autocomplete>
            <span class="red--text" v-if="errors.category_id">{{ errors.category_id[0]}}</span>

            <vue-simplemde v-model="form.body"/>
            <span class="red--text" v-if="errors.body">{{ errors.body[0]}}</span><br>


            <v-btn color="green" type="submit">Update</v-btn>
            <v-btn  type="button">Cancel</v-btn>
        </v-form>
    </v-container>
</template>

<script>
    export default {
        name: "EditQuestion",
        data() {
            return {
                form: {
                    title: null,
                    category_id: null,
                    body: null,
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
            update() {

            }
        }
    }
</script>

<style scoped>

</style>
