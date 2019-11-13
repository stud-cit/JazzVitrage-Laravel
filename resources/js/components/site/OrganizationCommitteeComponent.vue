<template>
    <div>
        <section class="sections main-section juries">
            <div class="container">
                <h2 class="title-section">Організаційний комітет</h2>
                <!--
                <div class="sortiration-block">
                     сортувати:
        
                        <select name="">
                            <option value="" selected="selected" >Інструментальний жанр</option>
                            <option value="1">Вокальний жанр</option>
                            <option value="2">Композиція</option>
                        </select>

                </div>
                возможная сортировка членов орг комитета
                -->
                <div class="member-committee-card" v-for="(item, index) in paginatedData" :key="index">
                    <div class="picture" :data-target="'#collapse'+(index+1)">
                       <img v-bind:src="item.photo" alt="">
                    </div>
                    <div class="description" :data-target="'#collapse'+(index+1)">
                        <h3 class="title-description">{{ `${item.name} ${item.surname}` }}</h3>
                        <div class="text-description">
                            {{ item.informations }}
                        </div>
                    </div>
                </div>

                <ul class="pagination">
                    <li class="controls active" v-if="pageNumber !== 0" @click="prevPage"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></li>
                    <li>{{ pageNumber + 1 }} : {{ pageCount }}</li>
                    <li class="controls active" v-if="pageNumber <= pageCount -2" @click="nextPage"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></li>
                </ul>
            </div>
        </section>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                pageNumber: 0,
	            committees: [],
            };
        },
        props:{
            size:{
                type:Number,
                required:false,
                default: 4
            }
        },
        created () {
            document.title = "Організаційний комітет";
            this.getOrgCommitteeList();
        },
        computed: {
            paginatedData(){
                const start = this.pageNumber * this.size,
                    end = start + this.size;
                return this.committees.slice(start, end);
            },
            pageCount(){
                let l = this.committees.length,
                    s = this.size;

                return Math.ceil(l/s);
            },
        },
        methods: {
	        getOrgCommitteeList() {
		        axios.get('/get-org-view')
			        .then((response) => {
				        this.committees.push(...response.data)
			        })
	        },
            /* возможна сортировка
	        getOrgCommitteeList() {
		        axios.get('/get-org-view')
			        .then((response) => {
				        const instrumentals = [...new Set(response.data.map(inst => inst.nominations))]
				        instrumentals.map(instrumental => {
					        this.committees.push({instrumental, ...response.data.filter(inst => instrumental == inst.nominations)[0]})
				        })
			        })
	        },
	        */
            nextPage(){
                this.pageNumber++;
            },
            prevPage(){
                this.pageNumber--;
            },
        },

    }
</script>