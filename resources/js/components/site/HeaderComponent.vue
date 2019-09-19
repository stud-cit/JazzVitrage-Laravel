<template>

    <header class="header">

        <nav class="navbar navbar-expand-lg navbar-light ">
            <div class="container">
                <a class ="navbar-brand" href="/"><img src="/img/logo.svg" alt=""></a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav-menu" >
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse nav-menu" id="nav-menu">
                    <div class="navbar-nav">
                        <li class="dropdown">
                            <a class="nav-item nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" >КОНКУРС</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/members">СПИСОК УЧАСНИКІВ</a>
                                <a class="dropdown-item" href="/gymn">ГІМН</a>
                                <a class="dropdown-item" href="#">ЗАЯВКА ДЖАЗ-ВІТРАЖ</a>
                            </div>
                        </li>


                        <li><a class="nav-item nav-link" href="/gallery">ГАЛЕРЕЯ</a></li>
                        <li><a class="nav-item nav-link" href="#">ПОЛОЖЕННЯ</a></li>
                        <li class="dropdown">
                            <a class="nav-item nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" >КОНТАКТИ</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/juries">ЖУРІ</a>
                                <a class="dropdown-item" href="/organization-committee">ОРГАНІЗАЦІЙНИЙ КОМІТЕТ</a>
                            </div>
                        </li>
                            
                        <li><a class="nav-item nav-link" href="#">Конфр</a></li>


                    </div>
                    <router-link :to="'/applications'" class="add-application">ЗАПОВНИТИ ЗАЯВКУ</router-link>
                </div>
            </div>
        </nav>

        <marquee class="ticker" scrollamount="10">
            Протягом березня-квітня 2016 року в місті Суми проходив Другий обласний дитячий фестиваль-конкурс
        </marquee>
    </header>

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