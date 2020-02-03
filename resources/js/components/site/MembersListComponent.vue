<template>
    <div>
        <!--<section class="sections main-section members">-->
            <!--<div class="container">-->
                <!--<h2 class="title-section">СПИСКИ УЧАСНИКІВ</h2>-->

                <!--<table class="table-members">-->
                    <!--<tr class="table-title">-->
                        <!--<th>№</th>-->
                        <!--<th>П.І.Б. /<br>-->
                            <!--НАЗВА КОЛЕКТИВУ </th>-->
                        <!--<th>АДРЕСА</th>-->
                        <!--<th>НАЗВА ЗАКЛАДУ</th>-->
                        <!--<th>ВИКЛАДАЧ</th>-->
                    <!--</tr>-->
                    <!--<tr v-for="item in paginatedData" :key="item.index">-->
                        <!--<td>{{ item.index+1 }}</td>-->
                        <!--<td>{{ item.name }}</td>-->
                        <!--<td>{{ item.school_address }}</td>-->
                        <!--<td>{{ item.school_name }}</td>-->
                        <!--<td>{{ item.teacher }}</td>-->
                    <!--</tr>-->
                <!--</table>-->
                <!--<div class="search-block">-->
                    <!--<input type="text" v-model="searchMember" placeholder="ПОШУК">-->
                    <!--<select v-model="searchNomination" class="nomination">-->
                        <!--<option value="" selected="selected">номінація</option>-->
                        <!--<option v-for="(value, index) in nominations" :value="value.name" :key="index">{{ value.name }}</option>-->
                    <!--</select>-->
                    <!--<select v-model="ageCategory"  class="category">-->
                        <!--<option value="" selected="selected" >вік.категорія</option>-->
                        <!--<option value="8-10">Від 8 до 10 років</option>-->
                        <!--<option value="11-13">Від 11 до 13 років</option>-->
                        <!--<option value="14-17">Від 14 до 17 років</option>-->
                    <!--</select>-->
                    <!--<button class="clean" @click="clean">Очистити</button>-->
                <!--</div>-->
                <!--<ul class="pagination">-->
                    <!--<li class="controls active" v-if="pagination.pageNumber !== 0" @click="prevPage"><i class="fa fa-long-arrow-left" aria-hidden="true" v-if="pagination.pageNumber !== 0"></i></li>-->
                    <!--<li>{{ pagination.pageNumber + 1 }} : {{ pageCount }}</li>-->
                    <!--<li class="controls active" v-if="pagination.pageNumber <= pageCount -2" @click="nextPage"><i class="fa fa-long-arrow-right" aria-hidden="true" v-if="pagination.pageNumber <= pageCount -2"></i></li>-->
                <!--</ul>-->
            <!--</div>-->
        <!--</section>-->
        <section class="sections main-section members">
            <div class="container">
                <h2 class="title-section">СПИСКИ УЧАСНИКІВ</h2>

                <table class="table-members">
                    <tr class="table-title">
                        <th>№</th>
                        <th>П.І.Б. /<br>
                            НАЗВА КОЛЕКТИВУ </th>
                        <th>АДРЕСА</th>
                        <th>НАЗВА ЗАКЛАДУ</th>
                        <th>ВИКЛАДАЧ</th>
                    </tr>
                    <tr v-for="item in paginatedData" :key="item.index">
                        <td>{{ item.index+1 }}</td>
                        <td>{{ item.name }}</td>
                        <td>{{ item.school_address }}</td>
                        <td>{{ item.school_name }}</td>
                        <td>{{ item.teacher }}</td>
                    </tr>
                    <tr class="search">
                        <td colspan="5">
                            <div class="search-block">
                                <input type="text" v-model="searchMember" placeholder="ПОШУК">
                                <select v-model="searchNomination" class="nomination">
                                    <option value="" selected="selected">номінація</option>
                                    <option v-for="(value, index) in nominations" :value="value.name" :key="index">{{ value.name }}</option>
                                </select>
                                <select v-model="ageCategory" class="category">
                                    <option value="" selected="selected" >вік.категорія</option>
                                    <option value="8-10">Від 8 до 10 років</option>
                                    <option value="11-13">Від 11 до 13 років</option>
                                    <option value="14-17">Від 14 до 17 років</option>
                                </select>
                                <button class="clean" @click="clean">Очистити</button>

                            </div>
                            <ul class="pagination">
                                <li class="controls active" v-if="pagination.pageNumber !== 0" @click="prevPage"><i class="fa fa-long-arrow-left" aria-hidden="true" v-if="pagination.pageNumber !== 0"></i></li>
                                <li>{{ pagination.pageNumber + 1 }} : {{ pageCount }}</li>
                                <li class="controls active" v-if="pagination.pageNumber <= pageCount -2" @click="nextPage"><i class="fa fa-long-arrow-right" aria-hidden="true" v-if="pagination.pageNumber <= pageCount -2"></i></li>
                            </ul>
                        </td>
                    </tr>
                </table>



            </div>

        </section>
    </div>
</template>

<script>
	export default {
		data() {
			return {
				pagination : {
					pageNumber: 0,
					size: 4
				},
				members: [],
				ageCategory: '',
				nominations: [],
				searchMember: '',
				searchNomination: '',
				name: '',
			};
		},
		created () {
			this.getNominations();
			this.getMembers();
		},
		computed: {
			filteredList() {
				return this.members.filter(members => {
					return (
						(this.ageCategory == '' || members.age >= this.ageCategory.split('-')[0] && members.age <= this.ageCategory.split('-')[1]) &&
						(members.name.toLowerCase().includes(this.searchMember.toLowerCase()) ||
							members.school_address.toLowerCase().includes(this.searchMember.toLowerCase()) ||
							members.school_name.toLowerCase().includes(this.searchMember.toLowerCase())) &&
						members.nomination.includes(this.searchNomination))
				})
			},
			paginatedData(){
				const start = this.pagination.pageNumber * this.pagination.size;
				const end = start + this.pagination.size;
				return this.filteredList.slice(start, end);
			},
			pageCount(){
				return Math.ceil(this.filteredList.length / this.pagination.size);
			},
		},
		methods: {
			nextPage(){
				this.pagination.pageNumber++;
			},
			prevPage(){
				this.pagination.pageNumber--;
			},
			getNominations() {
				axios.get('/get-nominations')
					.then((response) => {
						this.nominations = response.data;
					})
			},
			getMembers() {
				axios.get('/get-approved-members')
					.then((response) => {
						response.data.forEach((member, index) => {
							if(member.solo_duet.length == 0) {
								this.members.push({
									index,
									age: member.group.average_age,
									name: member.group.name,
									school_address: member.preparation.school_address,
									school_name: member.preparation.school_name,
									teacher: `${member.preparation.teacher_surname} ${member.preparation.teacher_name} ${member.preparation.teacher_patronymic}`,
									nomination: member.nomination.name
								})
							}
							else if(member.solo_duet.length == 1) {
								this.members.push({
									index,
									age: this.getAge(member.solo_duet[0].data_birthday),
									name: `${member.solo_duet[0].surname} ${member.solo_duet[0].name} ${member.solo_duet[0].patronymic}`,
									school_address: member.preparation.school_address,
									school_name: member.preparation.school_name,
									teacher: `${member.preparation.teacher_surname} ${member.preparation.teacher_name} ${member.preparation.teacher_patronymic}`,
									nomination: member.nomination.name
								})
							}
							else if(member.solo_duet.length == 2) {
								this.members.push({
									index,
									age: (this.getAge(member.solo_duet[0].data_birthday) + this.getAge(member.solo_duet[1].data_birthday)) / 2,
									name: `${member.solo_duet[0].surname} ${member.solo_duet[0].name} ${member.solo_duet[0].patronymic}, ${member.solo_duet[1].surname} ${member.solo_duet[1].name} ${member.solo_duet[1].patronymic}`,
									school_address: member.preparation.school_address,
									school_name: member.preparation.school_name,
									teacher: `${member.preparation.teacher_surname} ${member.preparation.teacher_name} ${member.preparation.teacher_patronymic}`,
									nomination: member.nomination.name
								});
							}
						});
					});
			},
			getAge(dateString) {
				var today = new Date();
				var birthDate = new Date(dateString);
				var age = today.getFullYear() - birthDate.getFullYear();
				var m = today.getMonth() - birthDate.getMonth();
				if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
					age--;
				}
				return age;
			},
			clean() {
				this.searchMember = '',
				this.searchNomination = ''
			},
		},
	}
</script>
