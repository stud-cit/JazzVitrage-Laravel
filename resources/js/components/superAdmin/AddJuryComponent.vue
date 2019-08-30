<template>
    <div>
        <form enctype="multipart/form-data">
            <div class="row">
                <div class="col-5">
                    <label for="name" class="brtop">Прізвище</label>
                    <input type="text" v-model="name" class="form-control" id="name">

                    <label for="surname" class="brtop">Ім'я</label>
                    <input type="text" v-model="surname" class="form-control" id="surname">

                    <label for="patronymic" class="brtop">По батькові</label>
                    <input type="text" v-model="patronymic" class="form-control" id="patronymic">

                    <label for="jury-photo" class="brtop">Фото</label>
                    <input type="file" ref="juryfile" class="form-control-file" id="jury-photo">

                    <label for="email" class="brtop">Електронна адреса</label>
                    <input type="email" v-model="email" class="form-control" id="email">

                    <label for="rank" class="brtop">Звання члена журі</label>
                    <input type="text" v-model="rank" class="form-control" id="rank">
                </div>
                <div class="col-2"></div>
                <div class="col-5">
                    <label class="brtop">Номінація</label>
                    <div v-for="(item, index) in items" :key="item.id" class="mb-2">
                        <select class="form-control" style="width: 80%">
                            <option v-for="(option, index) in options" :key="index">
                                {{ option.value }}
                            </option>
                        </select>
                        <i v-if="index == 0" v-show="items.length < 3" class="fa fa-plus-circle btn btn-default float-right button-position p-0" @click="addNomination"></i>
                        <i v-else class="fa fa-minus-circle btn btn-default float-right button-position p-0" @click="deleteNomination(index)"></i>
                    </div>
                    <label for="info" class="brtop">Членство в спілках журі</label>
                    <textarea class="form-control" v-model="additionalInfo" id="info" rows="3"></textarea>
                    <button type="button" class="btn btn-outline-secondary float-right mt-4 px-5" @click="postAllJury">Додати</button>
                </div>
            </div>
        </form>
        <br>
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
            <tbody v-for="(item, index) in jurys" :key="index">
            <tr>
                <td data-toggle="collapse" :data-target="'#collapse'+(index+1)">{{ index + 1 }}</td>
                <td data-toggle="collapse" :data-target="'#collapse'+(index+1)">{{ `${item.name} ${item.surname} ${item.patronymic}` }}</td>
                <td data-toggle="collapse" :data-target="'#collapse'+(index+1)">{{ item.email }}</td>
                <td data-toggle="collapse" :data-target="'#collapse'+(index+1)">{{ item.rank }}</td>
                <td data-toggle="collapse" :data-target="'#collapse'+(index+1)">{{ item.nominations }}</td>
                <td><i class="fa fa-2x fa-pencil-square btn btn-default p-0"></i></td>
                <td><i class="fa fa-2x fa-times-circle btn btn-default p-0" @click="deleteJury(item.user_id, index)"></i></td>
            </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
	export default {
		data() {
			return {
                jurys: [],
				name: '',
                surname: '',
                patronymic: '',
				email: '',
				rank: '',
				additionalInfo: '',
                options: [
                    { value: 'Інструментальний жанр' },
                    { value: 'Вокальний жанр' },
                    { value: 'Композиція' }
                ],
                items: [
                    { id: 1 }
                ],
                form: new FormData
			};
		},
		created () {
			this.getFullJuryList();
        },
		methods: {
			addNomination(){
                this.items.push({
                    id: this.items[this.items.length - 1].id+1
                });
            },
			deleteNomination(index) {
                this.items.splice(index, 1);
			},
			getFullJuryList() {
				axios.get('/get-all-jury')
					.then((response) => {
                        this.jurys.push(...response.data)
					})
			},
			postAllJury(){
                const selects = document.querySelectorAll('select');
                const valOptions = [];
                for (let index = 0; index < selects.length; index++) {
                    valOptions.push(selects[index].value);
                }
                this.form.append('name', this.name);
                this.form.append('surname', this.surname);
                this.form.append('patronymic', this.patronymic);
                this.form.append('email', this.email);
				this.form.append('rank', this.rank);
                this.form.append('photo', this.$refs.juryfile.files[0]);
				this.form.append('nominations', valOptions);
                this.form.append('informations', this.additionalInfo);
            
				axios.post('/post-all-jury', this.form)
                    .then(() => {
                        this.jurys = [];
                    	this.getFullJuryList();
                    })
            },
			deleteJury(id, index){
				axios.post('/delete-user/'+id)
					.then((response) => {
						if(response.status == 200) {
							this.jurys.splice(index, 1);
						}
						swal("Журі був успішно видалений", {
							icon: "success",
						});
					})
					.catch((error) => {
						swal({
							icon: "error",
							title: 'Помилка',
							text: 'Не вдалося'
						});
					});
			}
        }
	}
</script>