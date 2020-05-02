<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-6 ml-auto mr-auto mt-4" style="background-color: #f4f4f4; padding: 20px">
                <h4>Register</h4>
                <div class="alert alert-success" v-if="success">
                    <p>Registration completed. You can now
                        <router-link :to="{path:'/login'}">Sign In.</router-link>
                    </p>
                </div>
                <form @submit.prevent="register" method="post">
                    <div class="form-group">
                        <label>Name</label>
                        <input v-model="name" type="text" name="name"
                               placeholder="Full Name"
                               class="form-control">
                        <small style="color: red" v-if="error && errors.name">{{ errors.name[0] }}</small>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input v-model="email" type="email" name="email"
                               placeholder="Email"
                               class="form-control">
                        <small style="color: red" v-if="error && errors.email">{{ errors.email[0] }}</small>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input v-model="password" type="password" name="password"
                               placeholder="Password"
                               class="form-control">
                        <small style="color: red" v-if="error && errors.password">{{ errors.password[0] }}</small>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width: 100%">Register</button>
                </form>
            </div>
            <div class="vld-parent">
                <loading name="loader" :active.sync="isLoading"
                         :can-cancel="false"
                         :is-full-page="fullPage"></loading>
            </div>
        </div>
    </div>
</template>

<script>
    // Import component
    import Loading from 'vue-loading-overlay';
    // Import stylesheet
    import 'vue-loading-overlay/dist/vue-loading.css';
    export default {
        name: "Register",
        components:{
            Loading
        },
        data() {
            return {
                isLoading: false,
                fullPage: true,
                errors: {},
                error: false,
                success: false,
                name: '',
                email: '',
                password: ''
            }
        },
        methods: {
            register() {
                this.isLoading = true;
                this.$auth.register({
                    data: {
                        name: this.name,
                        email: this.email,
                        password: this.password
                    },
                    success: function () {
                        this.isLoading = false;
                        this.success = true;
                        this.name = "";
                        this.email = "";
                        this.password = "";
                    },
                    error: function (resp) {
                        this.error = true;
                        this.errors = resp.response.data.errors;
                        this.isLoading = false;
                    },
                    redirect: null
                });
            }
        }
    }
</script>

<style scoped>
</style>
