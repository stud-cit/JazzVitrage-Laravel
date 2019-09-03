<template>
    <div>


        <section class="sections main-section gallery">
            <div class="container">
               <div class="page-nav">
                   <router-link :to="{ name: 'gallery'}" class="prev-page"><i class="fa fa-angle-left"></i>всі роки</router-link>
                   <h3 class="title"> ФЕСТИВАЛЬ ДЖАЗ-ВIтраж 2019 рiк</h3>
               </div>

                <div class="row mt-4">
                    <div class="col-xl-4 gallery-item"><img src="/img/gallery-img.png" alt="" class="gallery-img"></div>
                    <div class="col-xl-4 gallery-item"><img src="/img/gallery-img.png" alt="" class="gallery-img"></div>
                    <div class="col-xl-4 gallery-item"><img src="/img/gallery-img.png" alt="" class="gallery-img"></div>
                    <div class="col-xl-4 gallery-item"><img src="/img/gallery-img.png" alt="" class="gallery-img"></div>
                    <div class="col-xl-4 gallery-item"><img src="/img/gallery-img.png" alt="" class="gallery-img"></div>
                    <div class="col-xl-4 gallery-item"><img src="/img/gallery-img.png" alt="" class="gallery-img"></div>
                </div>
                <ul class="pagination d-flex justify-content-center">
                    <li class="controls"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></li>
                    <li>1 : 16</li>
                    <li class="controls active"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></li>
                </ul>

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