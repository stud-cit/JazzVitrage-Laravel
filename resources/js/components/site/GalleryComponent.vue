<template>
    <div>


        <section class="sections main-section gallery">
            <div class="container">
                <h2 class="title-section">ФЕСТИВАЛЬ ДЖАЗ-ВIтраж</h2>
                <div class="row">
                    <router-link :to="{ name: 'gallery-year', params:{ id: 2}}" class="col-xl-4 gallery-item">
                        <img src="img/gallery-img.png" alt="" class="gallery-img">
                        <div class="dark-bg"><p class="caption">2015</p></div>
                    </router-link>
                    <router-link :to="{ name: 'gallery-year', params:{ id: 2}}" class="col-xl-4 gallery-item">
                        <img src="img/gallery-img.png" alt="" class="gallery-img">
                        <div class="dark-bg"><p class="caption">2015</p></div>
                    </router-link>
                    <router-link :to="{ name: 'gallery-year', params: { id: 3}}" class="col-xl-4 gallery-item">
                        <img src="img/gallery-img.png" alt="" class="gallery-img">
                        <div class="dark-bg"><p class="caption">2015</p></div>
                    </router-link>
                    <router-link :to="{ name: 'gallery-year', params: { id: 1}}" class="col-xl-4 gallery-item">
                        <img src="img/gallery-img.png" alt="" class="gallery-img">
                        <div class="dark-bg"><p class="caption">2015</p></div>
                    </router-link>
                    <router-link :to="{ name: 'gallery-year', params: { id: 1}}" class="col-xl-4 gallery-item">
                        <img src="img/gallery-img.png" alt="" class="gallery-img">
                        <div class="dark-bg"><p class="caption">2015</p></div>
                    </router-link>
                    <router-link :to="{ name: 'gallery-year', params: { id: 1}}" class="col-xl-4 gallery-item">
                        <img src="img/gallery-img.png" alt="" class="gallery-img">
                        <div class="dark-bg"><p class="caption">2015</p></div>
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