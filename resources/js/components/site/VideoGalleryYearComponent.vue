<template>
    <div>
        <section class="sections main-section gallery video-gallery">
            <div class="container">
               <div class="page-nav">
                   <router-link :to="{ name: 'gallery-video'}" class="prev-page"><i class="fa fa-angle-left"></i>всі роки</router-link>
                   <h3 class="title"> Відео-галерея 2019 рiк</h3>
               </div>
                <div class="gallery-content">
                    <div class="row">                
                        <div class="col-xl-4 d-flex align-items-end">
                            <video  class="video" controls poster="/img/video-bg.png">
                                <source src="/video/mult1.mp4" type="video/mp4">
                            </video>
                        </div>
                        <div class="col-xl-4 d-flex align-items-end">
                            <video  class="video" controls poster="/img/video-bg.png">
                                <source src="/video/mult1.mp4" type="video/mp4">
                            </video>
                        </div>
                        <div class="col-xl-4 d-flex align-items-end">
                            <video  class="video" controls poster="/img/video-bg.png">
                                <source src="/video/mult1.mp4" type="video/mp4">
                            </video>
                        </div>
                            <div class="col-xl-4 d-flex align-items-end">
                            <video  class="video" controls poster="/img/video-bg.png">
                                <source src="/video/mult1.mp4" type="video/mp4">
                            </video>
                        </div>
                        <div class="col-xl-4 d-flex align-items-end">
                            <video  class="video" controls poster="/img/video-bg.png">
                                <source src="/video/mult1.mp4" type="video/mp4">
                            </video>
                        </div>
                        <div class="col-xl-4 d-flex align-items-end">
                            <video  class="video" controls poster="/img/video-bg.png">
                                <source src="/video/mult1.mp4" type="video/mp4">
                            </video>
                        </div>
                    </div>
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