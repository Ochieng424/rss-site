<template>
    <div class="container-fluid" style="margin: 0; padding: 0">
        <Nav />
        <div class="col-sm-12">
            <router-view></router-view>
        </div>
        <Footer />
    </div>
</template>

<script>
    import Nav from "../Nav/Nav";
    import Footer from "../Nav/Footer";
    export default {
        name: "app",
        components:{
            Nav,
            Footer
        }
    }
</script>

<style scoped>

</style>
