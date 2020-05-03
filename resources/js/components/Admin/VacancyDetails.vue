<template>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div :class="$auth.user().role == 'user'? 'col-sm-8' :'col-sm-10'">
                <p>
                    <button class="btn btn-primary btn-sm" @click="$router.go(-1)">
                        <i class="fa fa-arrow-left"></i>
                    </button>
                </p>
                <div class="card">
                    <div class="card-header bg-dark">
                        <h5 class="text-white">Vacancy Details</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless mb-0">
                            <tbody>
                            <tr>
                                <th>Number#</th>
                                <td>{{details.id}}</td>
                            </tr>
                            <tr>
                                <th>Title</th>
                                <td>{{details.title}}</td>
                            </tr>
                            <tr>
                                <th>Company</th>
                                <td>{{details.company}}</td>
                            </tr>
                            <tr>
                                <th>Location</th>
                                <td>{{details.location}}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>{{details.status}}</td>
                            </tr>
                            <tr>
                                <th>Description</th>
                                <td>{{details.description}}</td>
                            </tr>
                            <tr v-if="$auth.user().role == 'user'">
                                <th>Apply</th>
                                <td>
                                    <button type="button" class="btn btn-sm btn-success">Apply here</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "VacancyDetails",
        data(){
            return{
                vacancyId: this.$route.params.vacancyId,
                details: []
            }
        },
        methods:{
            getVacancyUser(){
                try {
                    axios.get('/vacancy/' + this.vacancyId).then((data)=>{
                        this.details = data.data
                    })
                }catch (e) {
                    throw new Error(e);
                }
            },
            getVacancyAdmin(){
                try {
                    axios.get('/admin/vacancy/' + this.vacancyId).then((data)=>{
                        this.details = data.data
                    })
                }catch (e) {
                    throw new Error(e);
                }
            }
        },
        mounted() {
            if (this.$auth.user().role == "admin") {
                this.getVacancyAdmin();
            }

            if (this.$auth.user().role == "user") {
                this.getVacancyUser();
            }
        }
    }
</script>

<style scoped>

</style>
