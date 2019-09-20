<template>
    <div>
        <section class="sections main-section juries">
            <div class="container">
                <h2 class="title-section">Організаційний комітет</h2>
                <div class="sortiration-block">
                     сортувати:
        
                        <select name="">
                            <option value="" selected="selected" >Інструментальний жанр</option>
                            <option value="1">Вокальний жанр</option>
                            <option value="2">Композиція</option>
                        </select>

                </div>
                
                <div class="member-committee-card" v-for="(item, index) in committees" :key="index">
                    <div class="picture" :data-target="'#collapse'+(index+1)">
                       <img v-bind:src="'../img/user-photo/' + item.photo" alt="">
                    </div>
                    <div class="description" :data-target="'#collapse'+(index+1)">
                        <h3 class="title-description">{{ `${item.name} ${item.surname}` }}</h3>
                        <div class="text-description">
                            {{ item.informations }}
                        </div>
                    </div>
                </div>

                <ul class="pagination">
                    <li class="controls"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></li>
                    <li>1 : 16</li>
                    <li class="controls active"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></li>
                </ul>
            </div>
        </section>



    </div>
</template>

<script>
    export default {
        data() {
            return {
	            committees: [],
            };
        },

        created () {
            document.title = "Організаційний комітет";
            this.getOrgCommitteeList();
        },
        computed: {

        },
        methods: {
	        getOrgCommitteeList() {
		        axios.get('/get-org-view')
			        .then((response) => {
				        this.committees.push(...response.data)
			        })
	        },
        },

    }
</script>