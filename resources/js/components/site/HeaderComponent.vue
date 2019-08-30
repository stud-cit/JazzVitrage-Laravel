<template>

    <header class="header">

        <nav class="navbar navbar-expand-lg navbar-light ">
            <div class="container">
                <a class ="navbar-brand" href="#"><img src="img/logo.svg" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav-menu" >
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse nav-menu" id="nav-menu">
                    <div class="navbar-nav">
                        <li class="dropdown">
                            <a class="nav-item nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" >КОНКУРС</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li>


                        <li><a class="nav-item nav-link" href="#">ГАЛЕРЕЯ</a></li>
                        <li><a class="nav-item nav-link" href="#">ПОЛОЖЕННЯ</a></li>
                        <li><a class="nav-item nav-link" href="#">КОНТАКТИ</a></li>
                        <li><a class="nav-item nav-link" href="#">Конфр</a></li>


                    </div>
                    <button class="add-application">ЗАПОВНИТИ ЗАЯВКУ</button>
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