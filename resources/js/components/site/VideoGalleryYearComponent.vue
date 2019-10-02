<template>
    <div>
        <section class="sections main-section gallery video-gallery">
            <div class="container">
               <div class="page-nav">
                   <router-link :to="{ name: 'gallery-video'}" class="prev-page"><i class="fa fa-angle-left"></i>всі роки</router-link>

<!--<<<<<<< HEAD-->
                   <!--<h3 class="title"> Відео-галерея 2019 рiк</h3>-->
               <!--</div>-->
                <!--<div class="gallery-content">-->
                    <!--<div class="row">                -->
                        <!--<div class="col-xl-4 d-flex align-items-end">-->
                            <!--<video  class="video" controls poster="/img/video-bg.png">-->
                                <!--<source src="/video/mult1.mp4" type="video/mp4">-->
                            <!--</video>-->
                        <!--</div>-->
                        <!--<div class="col-xl-4 d-flex align-items-end">-->
                            <!--<video  class="video" controls poster="/img/video-bg.png">-->
                                <!--<source src="/video/mult1.mp4" type="video/mp4">-->
                            <!--</video>-->
                        <!--</div>-->
                        <!--<div class="col-xl-4 d-flex align-items-end">-->
                            <!--<video  class="video" controls poster="/img/video-bg.png">-->
                                <!--<source src="/video/mult1.mp4" type="video/mp4">-->
                            <!--</video>-->
                        <!--</div>-->
                            <!--<div class="col-xl-4 d-flex align-items-end">-->
                            <!--<video  class="video" controls poster="/img/video-bg.png">-->
                                <!--<source src="/video/mult1.mp4" type="video/mp4">-->
                            <!--</video>-->
                        <!--</div>-->
                        <!--<div class="col-xl-4 d-flex align-items-end">-->
                            <!--<video  class="video" controls poster="/img/video-bg.png">-->
                                <!--<source src="/video/mult1.mp4" type="video/mp4">-->
                            <!--</video>-->
                        <!--</div>-->
                        <!--<div class="col-xl-4 d-flex align-items-end">-->
                            <!--<video  class="video" controls poster="/img/video-bg.png">-->
                                <!--<source src="/video/mult1.mp4" type="video/mp4">-->
                            <!--</video>-->
<!--=======-->

                   <h3 class="title"> Відео-галерея {{ this.$route.params.id }} рiк</h3>
               </div>
                <div class="gallery-content">
                    <div class="row">                
                        <div class="col-xl-4 d-flex align-items-end my-2"  v-for="item in paginatedData" :key="item.video_id">
                            <iframe width="100%" :src="'https://www.youtube.com/embed/'+item.url.slice(item.url.length - 11, item.url.length)" frameborder="0" allowfullscreen></iframe>

<!--&gt;>>>>>> 9c211dde839e94472b3d17073e368320b8c2ab77-->


                        </div>
                    </div>
                </div>
                 <ul class="pagination d-flex justify-content-center">

<!--<<<<<<< HEAD-->
                    <!--<li class="controls"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></li>-->
                    <!--<li>1 : 16</li>-->
                    <!--<li class="controls active"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></li>-->
<!--=======-->
                    <li class="controls"><i class="fa fa-long-arrow-left" aria-hidden="true" v-if="pagination.pageNumber !== 0" @click="prevPage"></i></li>
                    <li>{{ pagination.pageNumber + 1 }} : {{ pageCount }}</li>
                    <li class="controls active"><i class="fa fa-long-arrow-right" aria-hidden="true" v-if="pagination.pageNumber <= pageCount -2" @click="nextPage"></i></li>
<!--&gt;>>>>>> 9c211dde839e94472b3d17073e368320b8c2ab77-->


                </ul>
            </div>
        </section>
    </div>
</template>

<script>
    export default {
        data() {
            return {


                pagination : {
                    pageNumber: 0,
                    size: 6
                },
                video: []
            };
        },
        computed: {
            paginatedData(){
                const start = this.pagination.pageNumber * this.pagination.size;
                const end = start + this.pagination.size;
                return this.video.slice(start, end);
            },
            pageCount(){
                return Math.ceil(this.video.length / this.pagination.size);
            },
        },
        created () {
            this.getVideo();
        },
        methods: {
            nextPage(){
                this.pagination.pageNumber++;
            },
            prevPage(){
                this.pagination.pageNumber--;
            },
            getVideo() {
                axios.get('/get-video/'+this.$route.params.id)
                .then((response) => {
                    this.video = response.data;
                })
            },

        },

    }
</script>