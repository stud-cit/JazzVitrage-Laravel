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
                <div v-if="juryList.length > 0">
                <carousel :dots="false" :nav="false" class="jury-list">
                    <template slot="prev"><span class="prev"><i class="fa arrows fa-arrow-circle-left fa-3x" aria-hidden="true"></i></span></template>
                    <router-link class="jury-items" v-for="(item, index) in juryList" :key="index" :to="{ name: 'jury-member', params:{ id: item.user_id}}">
                        <img v-bind:src="'../img/user-photo/' + item.photo" alt="">
                        <div class="items-title">{{ `${item.name} ${item.surname}` }}</div>
                    </router-link>
                    <template slot="next" class="asdasd"><span class="next"><i class="fa arrows fa-arrow-circle-right fa-3x" aria-hidden="true"></i></span></template>

                </carousel>
                </div>
                <!--<div class="jury-list">-->

                <!--</div>-->

            </div>
        </section>
    </div>
</template>

<script>
	import carousel from 'vue-owl-carousel';

	export default {
		data() {
			return {
				juryList: [],
			};
		},

		created () {
			document.title = "Наше журі";
			this.getJuryList();
		},
		computed: {

		},
		methods: {
			getJuryList() {
				axios.get('/get-jurys-view')
					.then((response) => {
						this.juryList.push(...response.data)
					})
			},
		},
		components: { carousel },

	}
</script>
