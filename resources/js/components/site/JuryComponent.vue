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
                <div class="jury-list">
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
                </div>
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
             document.title = "Наше журі";
    
        },
        computed: {

        },
        methods: {


        },

    }
</script>