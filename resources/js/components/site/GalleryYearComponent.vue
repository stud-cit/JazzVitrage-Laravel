<template>
    <div>
        <section class="sections main-section gallery">
            <div class="container">
               <div class="page-nav">
                   <router-link :to="{ name: 'gallery' }" class="prev-page"><i class="fa fa-angle-left"></i>всі роки</router-link>
                   <h3 class="title" v-if="foto.type == 'Джаз-Вітраж'"> ФЕСТИВАЛЬ ДЖАЗ-ВIтраж {{ this.$route.params.id }} рiк</h3>
                   <h3 class="title" v-else> МАЙСТЕР-КЛАС ДЖАЗ-ВIтраж {{ this.$route.params.id }} рiк</h3>
                </div>
                <div class="gallery-content">
                    <silentbox-group class="row align-content-stretch mt-4">
                        <silentbox-item class="col-12 col-md-6 col-xl-4 gallery-item"  v-for="item in paginatedData" :key="item.foto_id" :src="'/img/uploads/'+item.file">
                            <img :src="'/img/uploads/'+item.file" class="gallery-img">
                        </silentbox-item>

                    </silentbox-group>
                    <!--<div class="row align-content-stretch mt-4">-->
                        <!--<div class="col-12 col-md-6 col-xl-4 gallery-item" v-for="item in paginatedData" :key="item.foto_id">-->
                            <!--<img :src="'/img/uploads/'+item.file" class="gallery-img">-->
                        <!--</div>-->
                    <!--</div>-->
                </div>
                <ul v-if="foto.length >= pagination.size" class="pagination d-flex justify-content-center">
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
                foto: []
            };
        },
        created () {
            this.getFoto();
        },
        computed: {
            paginatedData(){
                const start = this.pagination.pageNumber * this.pagination.size;
                const end = start + this.pagination.size;
                return this.foto.slice(start, end);
            },
            pageCount(){
                return Math.ceil(this.foto.length / this.pagination.size);
            },
        },
        methods: {
            nextPage(){
                this.pagination.pageNumber++;
            },
            prevPage(){
                this.pagination.pageNumber--;
            },
            getFoto() {
                axios.get('/get-foto/'+this.$route.params.id)
                .then((response) => {
                    this.foto = response.data;
                })
            },
        },
    }
</script>
