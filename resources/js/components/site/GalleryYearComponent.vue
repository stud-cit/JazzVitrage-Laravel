<template>
    <div>
        <section class="sections main-section gallery">
            <div class="container">
               <div class="page-nav">
                   <router-link :to="{ name: 'gallery' }" class="prev-page"><i class="fa fa-angle-left"></i>всі роки</router-link>
                   <h3 class="title"> ФЕСТИВАЛЬ ДЖАЗ-ВIтраж {{ this.$route.params.id }} рiк</h3>
               </div>
                <div class="row mt-4">
                    <div class="col-xl-4 gallery-item" v-for="item in foto" :key="item.foto_id">
                        <img :src="'/img/uploads/'+item.file" class="gallery-img">
                    </div>
                </div>
                <ul class="pagination d-flex justify-content-center">
                    <li class="controls"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></li>
                    <li>1 : {{ foto.length }}</li>
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
                foto: []
            };
        },
        created () {
            this.getFoto();
        },
        methods: {
            getFoto() {
                axios.get('/get-foto/'+this.$route.params.id)
                .then((response) => {
                    this.foto = response.data;
                })
            },
        },
    }
</script>