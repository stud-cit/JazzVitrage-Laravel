<template>
    <div>
        <section class="sections main-section gallery">
            <div class="container">
                <h2 class="title-section">Відео-галерея</h2>
                <div class="row">
                    <router-link :to="{ name: 'gallery-video-year', params:{ id: 1}}" class="col-xl-4 video-gallery-item">
                        <img src="img/video-bg.png" alt="" class="gallery-img">
                        <div class="dark-bg"><p class="caption">2019</p></div>
                    </router-link>
                    <router-link :to="{ name: 'gallery-video-year', params:{ id: 2}}" class="col-xl-4 video-gallery-item">
                        <img src="img/video-bg.png" alt="" class="gallery-img">
                        <div class="dark-bg"><p class="caption">2018</p></div>
                    </router-link>
                    <router-link :to="{ name: 'gallery-video-year', params: { id: 3}}" class="col-xl-4 video-gallery-item">
                        <img src="img/video-bg.png" alt="" class="gallery-img">
                        <div class="dark-bg"><p class="caption">2017</p></div>
                    </router-link>
                    <router-link :to="{ name: 'gallery-video-year', params: { id: 1}}" class="col-xl-4 video-gallery-item">
                        <img src="img/video-bg.png" alt="" class="gallery-img">
                        <div class="dark-bg"><p class="caption">2016</p></div>
                    </router-link>
                    <router-link :to="{ name: 'gallery-video-year', params: { id: 2}}" class="col-xl-4 video-gallery-item">
                        <img src="img/video-bg.png" alt="" class="gallery-img">
                        <div class="dark-bg"><p class="caption">2015</p></div>
                    </router-link>
                    <router-link :to="{ name: 'gallery-video-year', params: { id: 3}}" class="col-xl-4 video-gallery-item">
                        <img src="img/video-bg.png" alt="" class="gallery-img">
                        <div class="dark-bg"><p class="caption">2014</p></div>
                    </router-link>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    export default {
        data() {
            return {

            };
        },

        created () {


        },
        computed: {

        },
        methods: {


        },

    }
</script>