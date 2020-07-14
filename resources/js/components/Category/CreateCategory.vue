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
                }
            }
        },
        methods: {
            create() {
                axios.post('/api/category', this.form)
                    .then(res => console.log(res.data.data))
                    .catch(error => console.log(error.response.data));
            }
        }
    }
</script>

<style scoped>

</style>
