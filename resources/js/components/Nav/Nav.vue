<template>
    <div class="container-fluid p-0 m-0">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <router-link to="/" class="navbar-brand">Job-app</router-link>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <router-link to="/" class="nav-link">Home</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/vacancies" class="nav-link">Vacancies</router-link>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown" v-if="$auth.check()">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{$auth.user().name}}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Profile</a>
                                <a class="dropdown-item" href="#">My Applications</a>
                                <router-link v-if="$auth.user().role == 'admin'" to="/dashboard" class="dropdown-item">Dashboard</router-link>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" @click.prevent="$auth.logout()">Logout</a>
                            </div>
                        </li>
                        <li class="nav-item" v-if="!$auth.check()">
                            <router-link to="/login" class="nav-link">Log in</router-link>
                        </li>
                        <li class="nav-item" v-if="!$auth.check()">
                            <router-link to="/register" class="nav-link">Register</router-link>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
    export default {
        name: "Nav",
        data() {
            return {}
        },
        methods: {}
    }
</script>

<style scoped>
</style>
