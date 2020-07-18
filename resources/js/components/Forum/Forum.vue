<template>
    <v-container fluid grid-list-md>
        <v-layout row wrap>
            <v-flex xs8>
                <question v-for="question in questions" :key="question.path" :data="question"></question>
                <div class="text-center mt-2">
                    <v-pagination
                        v-model="meta.current_page"
                        :length="totalPage"
                        @input="changePage"
                    ></v-pagination>
                </div>
            </v-flex>
            <v-flex xs4>
                <app-sidebar></app-sidebar>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    import Question from "./Question";
    import AppSidebar from "./AppSidebar";
    export default {
        name: "Forum",
        data() {
          return {
              questions: {},
              meta: {},
          }
        },
        components: {
            Question, AppSidebar,
        },
        computed: {
            totalPage() {
                return Math.ceil(this.meta.total / this.meta.per_page);
            }
        },
        created() {
            this.fetchQuestion();
        },
        methods: {
            fetchQuestion(page) {
                let url = page ? `/api/question?page=${page}` : '/api/question';

                axios.get(url)
                    .then(res => {
                        this.questions = res.data.data;
                        this.meta = res.data.meta;
                    })
                    .catch(error => console.log(error.response.data));
            },

            changePage(page) {
                this.fetchQuestion(page)
            }
        }
    }
</script>

<style scoped>

</style>
