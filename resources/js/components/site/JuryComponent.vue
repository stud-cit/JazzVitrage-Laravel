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
                <!-- <div class="jury-list">
                 
                    
                    
                </div> -->
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner jury-list">
    <div class="carousel-item jury-items active">
                            <img src="img/list_jury/Intersection_4.png" alt="">
                            <div class="items-title"></div>

    </div>
    <div class="carousel-item jury-items">
                            <img src="img/list_jury/Intersection_5.png" alt="">
                            <div class="items-title"></div>
    </div>
    <div class="carousel-item jury-items">
                                 <img src="img/list_jury/Intersection_6.png" alt="">
                            <div class="items-title"></div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
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