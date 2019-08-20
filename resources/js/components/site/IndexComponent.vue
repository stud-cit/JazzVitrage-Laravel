<template>
    <div>

        <header class="header">

            <nav class="navbar navbar-expand-lg navbar-light ">
                <div class="container">
                    <a class ="navbar-brand" href="#"><img src="img/logo.svg" alt=""></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav-menu" >
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse nav-menu" id="nav-menu">
                        <div class="navbar-nav">
                            <a class="nav-item nav-link active" href="#">КОНКУРС</a>
                            <a class="nav-item nav-link" href="#">ГАЛЕРЕЯ</a>
                            <a class="nav-item nav-link" href="#">ПОЛОЖЕННЯ</a>
                            <a class="nav-item nav-link" href="#">КОНТАКТИ</a>
                            <a class="nav-item nav-link" href="#">Конфр</a>


                        </div>
                        <button class="add-application">ЗАПОВНИТИ ЗАЯВКУ</button>
                    </div>
                </div>
            </nav>

            <marquee class="ticker" scrollamount="10">
                Протягом березня-квітня 2016 року в місті Суми проходив Другий обласний дитячий фестиваль-конкурс
            </marquee>
        </header>
        <section class="main-section preview">
            <div class="top-layout">
                <div class="container">
                    <div class="row">
                        <div class="col-7">
                            <img src="img/preview-logo.svg" alt="" class="preview-logo">
                            <p class="preview-text">Протягом березня-квітня 2016 року в місті Суми
                                проходив Другий обласний дитячий фестиваль-
                                конкурс джазової музики «Джаз Вітраж». Головна
                                мета цього нового творчого проекту -
                                популяризація класичного та сучасного
                                джазового мистецтва серед дітей та молоді сумського краю</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="sections nominations">
            <div class="container">
                <div class="title-nominations">
                    <img src="img/ribbon.png" alt="">
                    <div class="text">
                        <h2 class="title">НОМІНАЦІЇ</h2>
                        <p class="subtitle">У КОНКУРСІ</p>
                    </div>


                </div>
                <div class="nominations-list">
                    <div class="nominations-items">

                            <img src="img/piano.png" alt="">
                            <div class="items-title">Вокальний жанр</div>

                    </div>
                    <div class="nominations-items">

                            <img src="img/microphone.png" alt="">
                            <div class="items-title">Вокальний жанр</div>

                    </div>
                    <div class="nominations-items">

                            <img src="img/nots.png" alt="">
                            <div class="items-title">Вокальний жанр</div>

                    </div>
                </div>
            </div>
        </section>

        <section class="sections"></section>
        <footer class="footer">
            <p class="text-block">music-concurs@email.com</p>
            <p class="text-block">+38 (050) 123 4568</p>
            <p class="text-block">Created by studCIT</p>
        </footer>
    </div>
</template>

<script>
    export default {
        data() {
            return {

            };
        },

        created () {


        },
        computed: {

        },
        methods: {


        },

    }
</script>