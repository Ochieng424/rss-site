<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-6 ml-auto mr-auto mt-4" style="background-color: #f4f4f4; padding: 20px">
                <h4>Login</h4>
                <div class="alert alert-danger" v-if="invalid">
                    <p>Wrong Email or Password</p>
                </div>
                <form method="post" @submit.prevent="login">
                    <div class="form-group">
                        <label>Email</label>
                        <input v-model="form.email" type="email" name="email"
                               placeholder="Email"
                               class="form-control">
                        <small style="color: red" v-if="error && errors.email">{{ errors.email[0] }}</small>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input v-model="form.password" type="password" name="password"
                               placeholder="Password"
                               class="form-control">
                        <small style="color: red" v-if="error && errors.password">{{ errors.password[0] }}</small>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
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
        name: "Login",
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
                invalid: false,
                form:{
                    email: '',
                    password: ''
                },
            }
        },
        methods: {
            login() {
                this.isLoading = true;
                this.$auth.login({
                    params: {
                        email: this.form.email,
                        password: this.form.password,
                    },
                    success: function () {
                        this.isLoading = false;
                    },
                    error: function (resp) {
                        this.isLoading = false;
                        if (resp.response.data.errors) {
                            this.error = true;
                            this.errors = resp.response.data.errors;
                        }

                        if (resp.response.data.error) {
                            this.invalid = true;
                            this.errors = resp.response.data.error;
                        }
                    },
                    rememberMe: true,
                    redirect: '/',
                    fetchUser: true,
                });
            }
        }
    }
</script>

<style scoped>
</style>
