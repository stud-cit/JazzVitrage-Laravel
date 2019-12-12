<template>

    <header class="header">

        <nav class="navbar navbar-expand-lg navbar-light ">
            <div class="container">
                <a class ="navbar-brand" href="/"><img :src="info.logo" alt=""></a>


                <div class="d-xl-flex navbar-order">
                    <router-link :to="{name: 'applications'}" v-if="isRegistration" class="d-none add-application d-sm-inline">ПОДАТИ ЗАЯВУ</router-link>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav-menu" >
                        <span class="navbar-toggler-icon"></span>
                    </button>

                </div>
                <div class="collapse navbar-collapse nav-menu" id="nav-menu">
                    <ul class="navbar-nav">
                        <li class="dropdown">
                            <a class="nav-item nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" >КОНКУРС</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/members">СПИСОК УЧАСНИКІВ</a>
                                <a class="dropdown-item" href="/gymn">ГІМН ФЕСТИВАЛЮ</a>
                                <a class="dropdown-item" href="/applications">ЗАЯВА ДЖАЗ-ВІТРАЖ</a>
                            </div>
                        </li>



                        <li class="dropdown">
                            <a class="nav-item nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" >ГАЛЕРЕЯ</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/gallery-video">ВІДЕО-ГАЛЕРЕЯ</a>
                                <a class="dropdown-item" href="/gallery">ФЕСТИВАЛЬ</a>
                            </div>
                        </li>
                        <li><a class="nav-item nav-link" :href="info.file">ПОЛОЖЕННЯ</a></li>

                        <li class="dropdown">
                            <a class="nav-item nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" >КОНТАКТИ</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/juries">ЖУРІ</a>
                                <a class="dropdown-item" href="/organization-committee">ОРГАНІЗАЦІЙНИЙ КОМІТЕТ</a>
                            </div>
                        </li>
                        <li class="d-inline  d-sm-none" v-if="isRegistration">
                            <a href="/applications"  class="nav-item nav-link">ЗАПОВНИТИ ЗАЯВКУ</a>
                        </li>
                        <!--<li><a class="nav-item nav-link" href="#">Конфр</a></li>-->
                        <li class="dropdown">
                            <a class="nav-item nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" >
                                <img v-if="!translate" src="images/lang/lang__uk.png">
                                <img v-else src="images/lang/lang__en.png" ></a>
                                <div class="dropdown-menu language">
                                    <img src="images/lang/lang__uk.png" alt="uk" data-google-lang="uk" class="dropdown-item language__img">
                                    <img src="images/lang/lang__en.png" alt="en" data-google-lang="en" class="dropdown-item language__img">

                                </div>


                        </li>

                    </ul>

                </div>
            </div>
        </nav>

        <div class="ticker" >
            <span>
            {{ info.ticker }}
            </span>
        </div>
    </header>

</template>

<script>
    export default {
        data() {
            return {
                translate: false,
                info: {
                    logo: '',
                    ticker: '',

                },
                isRegistration: false,
            };
        },

        created () {
            this.getInfo();
            this.isOpenedRegistration();
            if(this.getCookie('googtrans') =='/uk/en'){

                this.translate = true;
            }

        },
        computed: {

        },
        methods: {
            getInfo() {
                axios.get('/get-all-info')
                    .then((response) => {
                        response.data.info.map(item => {
                            Object.assign(this.info, item);
                        })
                    })
            },
            isOpenedRegistration() {
                axios
                    .get('/is-opened-registration')
                    .then( ( response ) => {
                        this.isRegistration = response.data;
                    })
                    .catch( ( error ) => console.error(error) )
            },
            getCookie(name) {
                var matches = document.cookie.match(new RegExp(
                    "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
                ));
                return matches[1] ? decodeURIComponent(matches[1]) : undefined;
            }
        },

    }
</script>
<style>
    /*.translate*/

</style>
