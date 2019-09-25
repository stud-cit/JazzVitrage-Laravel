<template>
    <div>
        <section class="sections main-section juries"> 
            <div class="container">
                <div class="title-juries">
                    <img src="img/ribbon.png" alt="">
                    <div class="text">
                        <h2 class="title">НАШЕ ЖУРІ</h2>
                        <p class="subtitle">У КОНКУРСІ</p>
                    </div>

                </div>
                <carousel   :dots="false"  :nav="false" class="jury-list">
                    <template slot="prev"><span class="prev"><i class="fa arrows fa-arrow-circle-left fa-3x" aria-hidden="true"></i></span></template>
                    <router-link class="jury-items" :to="{ name: 'jury-member', params:{ id: 1}}">
                        <img src="img/list_jury/Intersection_4.png" alt="">
                        <div class="items-title"></div>
                    </router-link>
                    <router-link class="jury-items" :to="{ name: 'jury-member', params:{ id: 2}}">
                        <img src="img/list_jury/Intersection_5.png" alt="">
                        <div class="items-title"></div>
                    </router-link>
                    <router-link class="jury-items" :to="{ name: 'jury-member', params:{ id: 3}}">
                        <img src="img/list_jury/Intersection_6.png" alt="">
                        <div class="items-title"></div>

                    </router-link>
                    <router-link class="jury-items" :to="{ name: 'jury-member', params:{ id: 1}}">
                        <img src="img/list_jury/Intersection_4.png" alt="">
                        <div class="items-title"></div>
                    </router-link>
                    <router-link class="jury-items" :to="{ name: 'jury-member', params:{ id: 2}}">
                        <img src="img/list_jury/Intersection_5.png" alt="">
                        <div class="items-title"></div>
                    </router-link>
                    <router-link class="jury-items" :to="{ name: 'jury-member', params:{ id: 3}}">
                        <img src="img/list_jury/Intersection_6.png" alt="">
                        <div class="items-title"></div>
                    </router-link>
                    <template slot="next" class="asdasd"><span class="next"><i class="fa arrows fa-arrow-circle-right fa-3x" aria-hidden="true"></i></span></template>

                </carousel>
                <!--<div class="jury-list">-->

                <!--</div>-->

            </div>
        </section>
    </div>
</template>

<script>
    import carousel from 'vue-owl-carousel';

    export default {
         data() {
            return {
                
            };
        },

        created () {
             document.title = "Наше журі";
    
        },
        computed: {

        },
        methods: {


        },
        components: { carousel },

    }
</script>