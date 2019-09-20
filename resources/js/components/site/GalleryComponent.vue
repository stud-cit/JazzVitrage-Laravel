<template>
    <div>


        <section class="sections main-section gallery">
            <div class="container">
                <h2 class="title-section">ФЕСТИВАЛЬ ДЖАЗ-ВIтраж</h2>
                <div class="row">
                    <router-link :to="{ name: 'gallery-year', params:{ id: 2}}" class="col-xl-4 gallery-item" v-for="item in foto" :key="item.foto_id">
                        <img :src="'img/uploads/'+item.file" alt="" class="gallery-img">
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
                foto: [],
            };
        },

        created () {
            this.getFoto();
        },
        methods: {
            getFoto() {
                axios.get('/get-foto')
                .then((response) => {
                    this.foto = response.data.filter(item => {
                        return item.year
                        // this.foto.filter((o, item) => {
                        //     item.year != o.year
                        // })
                    })
                    // response.data.map(item => {
                    //     if (!this.foto.includes(item.year)) {
                    //         this.foto.push({year: item.year, file: item.file})
                    //     }
                    // })
                })
                .then(() => {
                    console.log(this.foto)
                })
            },
        },

    }
</script>