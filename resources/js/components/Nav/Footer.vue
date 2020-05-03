<template>
    <footer class="text-muted mt-4" style="background-color: rgb(244, 244, 244); padding: 20px;">
        <div class="container">
            <div>
                <button type="button" class="btn btn-outline-success" @click.prevent="feed">
                    <i class="fa fa-rss"></i>
                </button>
            </div>
            <p class="mt-3">© 2020</p>
        </div>
    </footer>
</template>

<script>
    export default {
        name: "Footer",
        methods: {
            feed() {
                let Url = window.location.origin;
                window.open(Url + "/api/v1/feed", "_blank");
                try {
                    axios.get('/feed').then((data) => {
                        this.feeds = data.data
                    })
                } catch (e) {
                    throw new Error(e);
                }
            },
        }
    }
</script>

<style scoped>

</style>
