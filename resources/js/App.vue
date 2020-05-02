<template>
    <div>
        <app v-if="$route.meta.plainLayout == 1"/>
        <dashboard v-if="$route.meta.plainLayout == 2"/>
    </div>
</template>

<script>
    import app from "./components/layouts/app";
    import dashboard from "./components/layouts/dashboard";

    export default {
        name: "App",
        components: {
            app,
            dashboard
        }
    }
</script>

<style scoped>

</style>
