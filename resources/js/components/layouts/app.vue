<template>
    <div class="container-fluid" style="margin: 0; padding: 0">
        <Nav />
        <div class="col-sm-12">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    import Nav from "../Nav/Nav";
    export default {
        name: "app",
        components:{
            Nav
        }
    }
</script>

<style scoped>

</style>
