<template>
    <div>
        <div class="border border-secondary position-relative mb-4">
            <div class="d-flex">
            <div class="col-md-5">
            <div class="form-group">
                <label for="pib-jury" class="brtop">ПІП журі</label>
                <input type="text" class="form-control" id="pib-jury" placeholder="">
            </div>
            <div class="form-group">
                <label for="jury-photo" class="brtop">Фото</label>
                <input type="file" class="form-control-file" id="jury-photo">
            </div>
            <div class="form-group">
                <label for="email" class="brtop">Електронна адреса</label>
                <input type="email" class="form-control" id="email" placeholder="">
            </div>
            <div class="form-group">
                <label for="jury-rank" class="brtop">Звання члена журі</label>
                <input type="text" class="form-control" id="jury-rank" placeholder="">
            </div>
            </div>

            <div class="col-md-5 col-md-offset-2">
            <div class="col-sm inline">
                <label for="nomination" class="brtop">Номінація</label>
                <select class="form-control nomination-width" id="nomination">
                    <option>Інструментальний жанр</option>
                    <option>Вокальний жанр</option>
                    <option>Композиція</option>
                </select>
                <i class="fa fa-plus-circle btn btn-default float-right button-position p-0" @click="addNomination"></i>
                <div v-for="(item, index) in items" :key="item.id">
                    <select v-model="item.value" class="form-control nomination-width" id="nomination">  <!--v-model="item.tags"-->
                        <option>Інструментальний жанр</option>
                        <option>Вокальний жанр</option>
                        <option>Композиція</option>
                    </select> {{ item.tags }}
                    <i class="fa fa-minus-circle btn btn-default float-right button-position p-0" @click="deleteNomination(index)"></i>
                </div>
            </div>
            <div class="additional-position">
                <label for="additional-info" class="brtop">Додаткова інформація</label>
                <textarea class="form-control" id="additional-info" rows="4"></textarea>
            </div>
            <div class="float-right">
                <div class="row justify-content-right add-button">
                    <button type="button" class="btn btn-outline-secondary btn-width">Додати</button>
                </div>
            </div>
            </div>
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th width="7%">№</th>
                <th width="18%">ПІП журі</th>
                <th width="21%">Електронна адеса</th>
                <th width="21%">Звання члена журі</th>
                <th width="21%">Номінація</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <!--<tbody v-for="(item, index) in getFullJuryList">
            <tr>
                <td>{{ index + 1 }}</td>
                <td>{{ item.solo_duet ? item.solo_duet.name + ' ' + item.solo_duet.surname + ' ' + item.solo_duet.patronomic : item.group.name }}</td>
                <td>{{ item.app_type.name }}</td>
                <td><i class="fa fa-2x fa-times-circle btn btn-default p-0"></i></td>
                <td><i class="fa fa-2x fa-times-circle btn btn-default p-0" :data-value="item.application_id" @click="deleteJury"></i></td>
            </tr>
            </tbody>-->
        </table>
    </div>
</template>
<script>
	export default {
		data() {
			return {
				keywords: null,
				results: [],
				members: [],
				search: '',
				items: []
			};
		},

		/*created () {
			this.getFullJuryList();
		},*/

		methods: {
			addNomination(){
				this.items.push({tags: ''})
            },
			deleteNomination(index) {
				this.items.splice(index, 1);
			}

			/*getFullJuryList(){
				axios.get('/get-all-jury')
					.then((response) => {

						this.members = response.data;
						// console.log(this.members);

					})
					.catch((error) => {
						// swal({
						//     icon: "error",
						//     title: 'Помилка',
						//     text: error.response.status + " " + error.responsestatusText
						// });
					});
			},
			archiveMember(event){

				const id =  event.target.getAttribute('data-value');
				// console.log(id);
				axios.post('/archive-members/'+id)
					.then((response) => {
						if(response.status == 200 ) {
							this.getFullJuryList();
						}

					})
					.catch((error) => {
						// swal({
						//     icon: "error",
						//     title: 'Помилка',
						//     text: error.response.status + " " + error.responsestatusText
						// });
					});
			}*/
		}
	}
</script>