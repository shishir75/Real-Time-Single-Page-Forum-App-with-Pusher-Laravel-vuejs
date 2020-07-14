<template>
    <v-container>
        <v-form @submit.prevent="submit">
            <v-text-field
                v-model="form.name"
                label="Category Name"
                type="text"
                required
            ></v-text-field>

            <v-btn type="submit" color="green" v-if="editSlug">Update</v-btn>
            <v-btn type="submit" color="teal" v-else>Create</v-btn>

            <v-card class="mt-3">
                <v-toolbar color="indigo" dark>
                    <v-toolbar-title>Categories</v-toolbar-title>
                </v-toolbar>

                <v-list dense>
                    <div v-for="(category, index) in categories" :key="category.id">
                        <v-list-item>
                            <v-list-item-content>
                                <v-list-item-title>{{ category.name }}</v-list-item-title>
                            </v-list-item-content>
                            <v-btn icon small @click="edit(index)" class="mr-5">
                                <v-icon color="orange">fas fa-edit</v-icon>
                            </v-btn>
                            <v-btn icon small @click="destroy(category.slug,index)">
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
                editSlug: null,
            }
        },
        methods: {
            submit() {
                this.editSlug ? this.update() : this.create();
            },

            create() {
                axios.post('/api/category', this.form)
                    .then(res => {
                        this.categories.unshift(res.data);
                        this.form.name = null;
                    })
                    .catch(error => console.log(error.response.data));
            },

            update() {
                axios.patch(`/api/category/${this.editSlug}`, this.form)
                    .then(res => {
                        this.categories.unshift(res.data);
                        this.form.name = null;
                    })
                    .catch(error => console.log(error.response.data));
            },
            edit(index) {
                this.form.name = this.categories[index].name;
                this.editSlug = this.categories[index].slug;
                this.categories.splice(index, 1);
            },
            destroy(slug, index) {
                axios.delete(`/api/category/${slug}`)
                    .then(res => this.categories.splice(index, 1));
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
