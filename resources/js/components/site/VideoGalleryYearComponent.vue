<template>
    <div>
        <section class="sections main-section gallery">
            <div class="container">
               <div class="page-nav">
                   <router-link :to="{ name: 'gallery-video'}" class="prev-page"><i class="fa fa-angle-left"></i>всі роки</router-link>
                   <h3 class="title"> Відео-галерея {{ this.$route.params.id }} рiк</h3>
               </div>
                <div class="gallery-content">
                    <div class="row mt-5 mb-5">                
                        <div class="col-4 mt-4"  v-for="item in paginatedData" :key="item.video_id">
                            <iframe height="300px" width="100%" :src="'https://www.youtube.com/embed/'+item.url.slice(item.url.length - 11, item.url.length)" frameborder="0" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
                 <ul class="pagination d-flex justify-content-center">
                    <li class="controls active" v-if="pagination.pageNumber !== 0" @click="prevPage"><i class="fa fa-long-arrow-left" aria-hidden="true" v-if="pagination.pageNumber !== 0"></i></li>
                    <li>{{ pagination.pageNumber + 1 }} : {{ pageCount }}</li>
                    <li class="controls active" v-if="pagination.pageNumber <= pageCount -2" @click="nextPage"><i class="fa fa-long-arrow-right" aria-hidden="true" v-if="pagination.pageNumber <= pageCount -2"></i></li>
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