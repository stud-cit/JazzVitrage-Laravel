npm run build
<template>
    <div>
        <section class="sections main-section gallery">
            <div class="container">
                <h2 class="title-section">Відео-галерея</h2>
                <div class="row">




                    <router-link 
                        class="col-lg-4 video-gallery-item"
                        :to="{ name: 'gallery-video-year', params: { id: item.year } }" 
                        v-for="item in video" :key="item.video_id"
                    >
                        <img :src="'//img.youtube.com/vi/'+item.file.url.slice(item.file.url.length - 11, item.file.url.length)+'/sddefault.jpg'" class="gallery-img">
                        <div class="dark-bg"><p class="caption">{{ item.year }}</p></div>



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
        computed:{
            
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