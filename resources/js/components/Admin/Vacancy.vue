<template>
    <div class="container-fluid">
        <p class="text-right">
            <button type="button" class="btn btn-sm btn-primary" @click="newModal">Post Vacancy</button>
        </p>
        <div class="table-responsive">
            <vue-good-table
                :line-numbers="true"
                :columns="columns"
                :rows="rows"
                :pagination-options="{
          enabled: true,
          mode: 'pages',
          perPage: 10
          }"
                :search-options="{
                enabled: true,
                placeholder: 'Search this table',
                }"
            >
                <template slot="table-row" slot-scope="props">
                    <span v-if="props.column.field == 'action'">
                      <router-link :to="{path: '/dashboard/vacancies/' + props.row.id}" type="button" class="btn btn-sm btn-primary btn-circle">
                          more
                      </router-link>
                    </span>
                    <span v-else>
                      {{props.formattedRow[props.column.field]}}
                    </span>
                </template>

            </vue-good-table>

        </div>
        <div id="new-modal" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog"
             aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content p-4">
                    <h5>Post Vacancy</h5>
                    <form @submit.prevent="postVacancy">
                        <div class="form-group">
                            <label>Job Title</label>
                            <input v-model="form.title" type="text" class="form-control" placeholder="Title">
                            <small style="color: red" v-if="error && errors.title">{{ errors.title[0]
                                }}</small>
                        </div>
                        <div class="form-group">
                            <label>Company</label>
                            <input v-model="form.company" type="text" class="form-control" placeholder="Company">
                            <small style="color: red" v-if="error && errors.company">{{
                                errors.company[0]
                                }}</small>
                        </div>
                        <div class="form-group">
                            <label>Job Location</label>
                            <input v-model="form.location" type="text" class="form-control" placeholder="Location">
                            <small style="color: red" v-if="error && errors.location">{{
                                errors.location[0]
                                }}</small>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select v-model="form.status" class="form-control">
                                <option value="" selected="true">--Status--</option>
                                <option value="open">Open</option>
                                <option value="closed">Closed</option>
                            </select>
                            <small style="color: red" v-if="error && errors.status">{{
                                errors.status[0]
                                }}</small>
                        </div>
                        <div class="form-group">
                            <label>Job description</label>
                            <textarea v-model="form.description" class="form-control"
                                      rows="3" placeholder="Job description"></textarea>
                            <small style="color: red" v-if="error && errors.description">{{
                                errors.description[0]
                                }}</small>
                        </div>
                        <button type="submit" class="btn btn-primary">Post</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="vld-parent">
            <loading :active.sync="isLoading"
                     :can-cancel="true"
                     :is-full-page="fullPage"></loading>
        </div>
    </div>
</template>

<script>
    import Loading from 'vue-loading-overlay';
    // Import stylesheet
    import 'vue-loading-overlay/dist/vue-loading.css';

    export default {
        name: "Vacancy",
        components: {
            Loading
        },
        data() {
            return {
                errors: {},
                error: false,
                isLoading: false,
                fullPage: true,
                form: {
                    title: '',
                    company: '',
                    location: '',
                    description: ''
                },
                columns: [
                    {
                        label: 'Title',
                        field: 'title',
                    },
                    {
                        label: 'Company',
                        field: 'company',
                    },
                    {
                        label: 'Location',
                        field: 'location',
                    },
                    {
                        label: 'Status',
                        field: 'status',
                    },
                    {
                        label: 'Actions',
                        field: 'action',
                    },
                ],
                rows: [],

            }
        },
        methods: {
            getVacancies(){
                try {
                    axios.get('/admin/vacancy').then((data)=>{
                        this.rows = data.data
                    })
                }catch (e) {
                    throw new Error(e);
                }
            },
            postVacancy() {
                this.isLoading = true;
                axios.post('/admin/vacancy', this.form).then(() => {
                    this.isLoading = false;
                    this.getVacancies();
                    swal.fire(
                        'Posted!',
                        'Vacancy posted successfully!',
                        'success'
                    )
                    this.form = {
                        title: '',
                        company: '',
                        location: '',
                        description: ''
                    };
                    $('#new-modal').modal('hide');
                }).catch((resp) => {
                    this.isLoading = false;
                    this.error = true;
                    this.errors = resp.response.data.errors;
                })
            },
            newModal() {
                $('#new-modal').modal('show');
            }
        },
        mounted() {
            this.getVacancies();
        }
    }
</script>

<style scoped>

</style>
