npm run build
<template>
    <div>
        <section class="sections main-section gallery">
            <div class="container">
                <h2 class="title-section">Відео-галерея</h2>
                <div class="row">

<!--<<<<<<< HEAD-->
                    <!--<router-link :to="{ name: 'gallery-video-year', params:{ id: 1}}" class="col-xl-4 video-gallery-item">-->
                        <!--<img src="img/video-bg.png" alt="" class="gallery-img">-->
                        <!--<div class="dark-bg"><p class="caption">2019</p></div>-->
                    <!--</router-link>-->
                    <!--<router-link :to="{ name: 'gallery-video-year', params:{ id: 2}}" class="col-xl-4 video-gallery-item">-->
                        <!--<img src="img/video-bg.png" alt="" class="gallery-img">-->
                        <!--<div class="dark-bg"><p class="caption">2018</p></div>-->
                    <!--</router-link>-->
                    <!--<router-link :to="{ name: 'gallery-video-year', params: { id: 3}}" class="col-xl-4 video-gallery-item">-->
                        <!--<img src="img/video-bg.png" alt="" class="gallery-img">-->
                        <!--<div class="dark-bg"><p class="caption">2017</p></div>-->
                    <!--</router-link>-->
                    <!--<router-link :to="{ name: 'gallery-video-year', params: { id: 1}}" class="col-xl-4 video-gallery-item">-->
                        <!--<img src="img/video-bg.png" alt="" class="gallery-img">-->
                        <!--<div class="dark-bg"><p class="caption">2016</p></div>-->
                    <!--</router-link>-->
                    <!--<router-link :to="{ name: 'gallery-video-year', params: { id: 2}}" class="col-xl-4 video-gallery-item">-->
                        <!--<img src="img/video-bg.png" alt="" class="gallery-img">-->
                        <!--<div class="dark-bg"><p class="caption">2015</p></div>-->
                    <!--</router-link>-->
                    <!--<router-link :to="{ name: 'gallery-video-year', params: { id: 3}}" class="col-xl-4 video-gallery-item">-->
                        <!--<img src="img/video-bg.png" alt="" class="gallery-img">-->
                        <!--<div class="dark-bg"><p class="caption">2014</p></div>-->
<!--=======-->


                    <router-link 
                        class="col-xl-4 video-gallery-item"
                        :to="{ name: 'gallery-video-year', params: { id: item.year } }" 
                        v-for="item in video" :key="item.video_id"
                    >
                        <img :src="'//img.youtube.com/vi/'+item.file.url.slice(item.file.url.length - 11, item.file.url.length)+'/sddefault.jpg'" class="gallery-img">
                        <div class="dark-bg"><p class="caption">{{ item.year }}</p></div>

<!--&gt;>>>>>> 9c211dde839e94472b3d17073e368320b8c2ab77-->

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

                video: []

            };
        },

        created () {



            this.getVideo();
        },
        methods: {
            getVideo() {
                axios.get('/get-video')
                .then((response) => {
                    const years = [...new Set(response.data.map(item => item.year))];
                    years.map(year => {
                        this.video.push({
                            year, 
                            file: response.data.filter(item => year == item.year)[0]})
                    })
                })
            },

        },

    }
</script>