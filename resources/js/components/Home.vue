<template>
    <div class="container">
        <div class="row align-items-center" style="padding-top: 80px">

            <div class="col-lg-6">
                <h1>Job-app</h1>
                <p class="lead mt-5 mb-8">
                    Kick start your career by securing your dream job.
                </p>
                <p>
                    <router-link :to="{path: '/register'}">
                        <button type="button" class="btn btn-lg btn-info" style="border-radius: 50px">Get Started
                        </button>
                    </router-link>
                </p>
            </div>

            <div class="col-lg-5 ml-auto d-none d-lg-block">
                <img src="/img/job.png" alt="img" style="width: 310px">
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        name: "Home"
    }
</script>

<style scoped>

</style>
