<template>

    <section class="sections main-section">
        <div class="container">
            <div class="page-nav">
                <router-link  :to="{ name: 'index'}">
                    <i class="fa fa-angle-left mr-3"></i>
                    повернутися на головну
                </router-link>
            </div>
            <h2 class="title-section error mt-5"><p>404</p>
                сторінка не знайдена</h2>
        </div>
    </section>

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
<style>
    .page-nav{
        font-family: Montserrat;
        font-size: 18pt;
        font-weight: 600;
        color: #fff;
        text-transform: uppercase;
    }
    .page-nav a{
        font-family: Montserrat;
        color: #fff;
        font-weight: 600;
        text-decoration: none;
    }
    .sections .error{
        color: #f91a1a;
        font-weight: bold;
        /*margin-top: 20vh;*/

    }
    .error p{
        font-size: 300px;
    }
    @media (max-width: 991px) {
        /*.page-nav{*/
            /*font-size: 14pt;*/
            /*margin-top: 10px;*/
        /*}*/

        .sections .container .error{
            color: #f91a1a;
            font-size: 55px;
        }
        .error p{
            font-size: 120px;
        }
    }

    @media (max-width: 414px) {
        .page-nav{
            font-size: 14pt;
            margin-top: 10px;
        }

        .sections .container .error{
            color: #f91a1a;
            font-size: 40px;
        }
        .error p{
            font-size: 90px;
        }
    }

</style>