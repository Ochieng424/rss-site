<template>
    <div class="container-fluid">
        <p class="text-right">
            <button type="button" class="btn btn-sm btn-primary" @click="newModal">Post Vacancy</button>
        </p>
        <div id="new-modal" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog"
             aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content p-4">
                    <h5>Post Vacancy</h5>
                    <form>
                        <div class="form-group">
                            <label class="float-left">Job Title</label>
                            <input v-model="form.title" type="text" class="form-control" placeholder="Title">
                            <small class="float-left" style="color: red" v-if="error && errors.title">{{ errors.title[0]
                                }}</small>
                        </div>
                        <div class="form-group">
                            <label class="float-left">Company</label>
                            <input v-model="form.company" type="text" class="form-control" placeholder="Company">
                            <small class="float-left" style="color: red" v-if="error && errors.company">{{
                                errors.company[0]
                                }}</small>
                        </div>
                        <div class="form-group">
                            <label class="float-left">Job Location</label>
                            <input v-model="form.location" type="text" class="form-control" placeholder="Location">
                            <small class="float-left" style="color: red" v-if="error && errors.location">{{
                                errors.location[0]
                                }}</small>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select v-model="form.status" class="form-control">
                                <option value="" selected="true" >--Status--</option>
                                <option value="open">Open</option>
                                <option value="closed">Closed</option>
                            </select>
                            <small class="float-left" style="color: red" v-if="error && errors.status">{{ errors.status[0]
                                }}</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Job description</label>
                            <textarea v-model="form.description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
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
                }
            }
        },
        methods: {
            newModal() {
                $('#new-modal').modal('show')
            }
        }
    }
</script>

<style scoped>

</style>
