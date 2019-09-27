<template>
    <div>
        <section class="sections main-section jury-member juries">
            <div class="container">
                <div class="page-nav">
                   <router-link :to="{ name: 'juries'}" class="prev-page"><i class="fa fa-angle-left"></i>всі журі</router-link>
                </div>      
                <div class="member-jury-card" v-for="(item, index) in juryMember" :key="index">
                    <div class="picture">
                       <img v-bind:src="'../img/user-photo/' + item.photo" alt="">
                    </div>
                    <div class="description">
                        <h3 class="title-description">{{ `${item.name} ${item.surname}` }}</h3>
                        <div class="text-description">{{ item.rank }}<br>
                           {{ item.nominations }}
                        </div>
                        <div class="text-description">
                            {{ item.informations }}
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
                juryMember: [],
            };
        },

        created () {
            document.title = "Представник журі";
	        this.getJuryList();
        },
        computed: {
            
        },
	    methods: {
		    getJuryList() {
			    axios.get('/get-jury-view/'+this.$route.params.id)
				    .then((response) => {
					    this.juryMember.push(...response.data)
				    })
		    },
	    },

    }
</script>