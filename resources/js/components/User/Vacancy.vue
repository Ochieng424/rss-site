<template>
    <div class="container">
        <h4 class="text-center m-2">Open Vacancies</h4>
        <div class="row pt-5">
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4" v-for="vacancy in vacancies" :key="vacancy.id">
                <div class="card">
                    <a href="#"><img class="card-img-top" src="/img/vacancy.jpg" alt=""></a>
                    <div class="card-body">
                        <h4 class="card-title">
                            {{vacancy.title}}
                        </h4>
                        <span>
                            <i class="fa fa-home"></i>
                            {{vacancy.company}}
                        </span>
                        <br>
                        <span class="mt-4">
                            <i class="fa fa-thumbtack"></i>
                            {{vacancy.location}}
                        </span>
                    </div>
                    <p class="text-center">
                        <router-link :to="{path: '/vacancies/' + vacancy.id}" type="button" class="btn btn-primary btn-sm" style="border-radius: 4px;">View Details</router-link>
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Vacancy",
        data(){
            return{
                vacancies: [],
                feeds: ''
            }
        },
        methods:{
            feed(){
                let Url = window.location.origin;
                window.open(Url + "/api/v1/feed", "_blank");
                try {
                    axios.get('/feed').then((data)=>{
                        this.feeds = data.data
                    })
                }catch (e) {
                    throw new Error(e);
                }
            },
            getOpenVacancies(){
                try {
                    axios.get('/vacancy').then((data)=>{
                        this.vacancies = data.data
                    })
                }catch (e) {
                    throw new Error(e);
                }
            }
        },
        mounted() {
            this.getOpenVacancies();
        }
    }
</script>

<style scoped>

</style>
