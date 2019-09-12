<template>
    <div>
        <section class="sections main-section jury-member juries">
            <div class="container">
                <div class="page-nav">
                   <div class="prev-page"><router-link :to="{ name: 'juries'}"><i class="fa fa-angle-left"></i>всі журі</router-link></div>
                </div>
                <div class="member-jury-card">
                    <div class="picture">
                       <img src="/img/list_jury/Intersection_3.png" alt="">
                    </div>
                    <div class="description">
                        <h3 class="title-description">NAME SURNAME</h3>
                        <div class="text-description">Duis aute irure:  ipsum dolor sit amet<br>
                           Duis aute irure:  ipsum dolor sit amet
                        </div>
                        <div class="text-description">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </div>
                   </div>
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
            document.title = "Представник журі"; 

        },
        computed: {
            
        },
        methods: {


        },

    }
</script>