<template>
    <div>
        <section class="sections main-section gallery">
            <div class="container">
                <h2 class="title-section">ФЕСТИВАЛЬ ДЖАЗ-ВIтраж</h2>
                <div class="row">
                    <router-link 
                        class="col-xl-4 gallery-item" 
                        :to="{ name: 'gallery-year', params: { id: item.year } }" 
                        v-for="item in foto" :key="item.foto_id"
                    >
                        <img :src="'img/uploads/'+item.file.file" class="gallery-img">
                        <div class="dark-bg">
                            <p class="caption">{{ item.year }}</p>
                        </div>
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
                foto: []
            };
        },
        created () {
            this.getFoto();
        },
        methods: {
            getFoto() {
                axios.get('/get-foto')
                .then((response) => {
                    const years = [...new Set(response.data.map(item => item.year))];
                    years.map(year => {
                        this.foto.push({
                            year, 
                            file: response.data.filter(item => year == item.year)[0]})
                    })
                })
            },
        },
    }
</script>