<template>
    <div>
        <form enctype="multipart/form-data">
            <div class="row">
                <div class="col-5">
					<div>
						<label for="surname" class="brtop">Прізвище</label>
						<input type="text" name="surname" v-model="surname" class="form-control" id="surname"
						v-validate="{ required: true, regex: /^([a-zа-яіїє'-]+){2,}$/i }"
								data-vv-as="Прізвище">
						<span class="errors text-danger" v-if="errors.has('surname')">
								{{ errors.first('surname') }}
						</span>
					</div>
					<div>
						<label for="name" class="brtop">Ім'я</label>
						<input type="text" name="name" v-model="name" class="form-control" id="name"
							v-validate="{ required: true, regex: /^([a-zа-яіїє'-]+){2,}$/i }"
								data-vv-as="Ім'я">
						<span class="errors text-danger" v-if="errors.has('name')">
								{{ errors.first('name') }}
						</span>
					</div>
					<div>
						<label for="patronymic" class="brtop">По батькові</label>
						<input type="text" name="patronymic" v-model="patronymic" class="form-control" id="patronymic"
							v-validate="{ required: true, regex: /^([a-zа-яіїє'-]+){5,}$/i }"
								data-vv-as="По батькові">
						<span class="errors text-danger" v-if="errors.has('patronymic')">
								{{ errors.first('patronymic') }}
						</span>
					</div>
					<div>
						<label for="jury-photo" class="brtop">Фото</label>
						<input type="file" name="jury-photo" accept=".jpg, .jpeg, .png, .bmp" ref="juryfile" class="form-control-file" id="jury-photo"
							v-validate="{ 'ext':['jpg', 'jpeg', 'png', 'bmp'] }"
								data-vv-as="Фото">
						<span class="errors text-danger" v-if="errors.has('jury-photo')">
								Файл повинен бути зображенням
						</span>
					</div>
					<div>
						<label for="email" class="brtop">Електронна адреса</label>
						<input type="email" name="email" v-model="email" class="form-control" id="email"
							v-validate="{ required: true, regex: /^([a-zA-Z0-9_-]+\.)*[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)*\.[a-z]{2,6}$/ }"
								data-vv-as="Електронна адреса">
						<span class="errors text-danger" v-if="errors.has('email')">
								{{ errors.first('email') }}
						</span>
					</div>
					<div>
						<label for="rank" class="brtop">Звання члена журі</label>
						<input type="text" name="rank" v-model="rank" class="form-control" id="rank">
					</div>
                </div>
                <div class="col-2"></div>
                <div class="col-5">
                    <label class="brtop">Номінація</label>
                    <div v-for="(item, index) in items" :key="item.id" class="mb-2">
                        <select class="form-control" style="width: 80%">
                            <option v-for="option in nominations" :key="option.nomination_id">
                                {{ option.name }}
                            </option>
                        </select>
                        <i v-if="index == 0" v-show="items.length < 3" class="fa fa-plus-circle btn btn-default float-right button-position p-0" @click="addNomination"></i>
                        <i v-else class="fa fa-minus-circle btn btn-default float-right button-position p-0" @click="deleteNomination(index)"></i>
                    </div>
                    <div>
                        <label for="info" class="brtop">Додаткова інформація</label>
                        <textarea class="form-control" v-model="additionalInfo" id="info" rows="3"></textarea>
                    </div>
                    <div>
                        <label for="regalia" class="brtop">Регалії</label>
                        <input type="text" name="regalia" v-model="regalia" class="form-control" id="regalia" data-vv-as="Регалії">
                    </div>
                    <button type="button" class="btn btn-outline-secondary float-right mt-4 px-5" @click="postJury">Додати</button>
                </div>
            </div>
        </form>
        <br>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th width="10px" scope="col">№</th>
					<th width="150px" scope="col">Фото</th>
					<th scope="col">ПІБ</th>
					<th scope="col">Електронна пошта</th>
					<th scope="col">Звання</th>
					<th scope="col">Номінація</th>
					<th scope="col">Додаткова інформація</th>
                    <th scope="col">Регалії</th>
					<th scope="col"></th>
					<th scope="col"></th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="(item, index) in jurys" :key="item.user_id">
					<th scope="row">{{ index + 1 }}</th>
					<td>
						<img v-if="item.photo" id="item-image" :src="item.photo" class="preview_img figure-img img-fluid">
						<img v-else id="item-image" :src="'../img/user.png'" class="preview_img figure-img img-fluid">
					</td>
					<td>{{ `${item.surname} ${item.name} ${item.patronymic}` }}</td>
					<td>{{ item.email }}</td>
					<td>{{ item.rank }}</td>
					<td>{{ item.nominations}}</td>
					<td>{{ item.informations }}</td>
                    <td>{{ item.regalia }}</td>
					<td><a style="color:#000" :href="'/admin/profile/'+item.user_id"><i class="fa fa-2x fa-pencil-square btn btn-default p-0"></i></a></td>
					<td><i class="fa fa-2x fa-times-circle btn btn-default p-0" @click="deleteJury(item.user_id, index)"></i></td>
				</tr>
			</tbody>
		</table>
        <div v-if="preloader" class="preloader">
            <Spinner :status="preloader" :size="54"></Spinner>
        </div>
    </div>
</template>
<script>
	import Spinner from 'vue-spinner-component/src/Spinner.vue';
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
                regalia: '',
				nominations: [],
				items: [
					{ id: 1 }
				],
				form: new FormData,
				preloader: false
			};
		},
		components: {
			Spinner,
		},
		created () {
			this.getJury();
			this.getNomination();
		},
		methods: {

			// Номинации

			getNomination(){
				axios.get('/get-nominations')
					.then((response) => {
						this.nominations = response.data;
					})
			},
			addNomination(){
				this.items.push({ id: this.items[this.items.length - 1].id+1 });
			},
			deleteNomination(index) {
				this.items.splice(index, 1);
			},

			// Жури

			getJury() {
				axios.get('/get-all-jury')
					.then((response) => {
						this.jurys = response.data;
					})
			},
			postJury(){
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
				this.form.append('nominations', valOptions.join(';'));
                this.form.append('informations', this.additionalInfo);
                this.form.append('regalia', this.regalia);
				this.$validator.validateAll().then((result) => {
                    if (!result) {
						return;
					}
					else {
						this.preloader = !this.preloader;
						axios.post('/post-all-jury', this.form)
							.then((res) => {
								this.jurys.push(res.data);
								this.preloader = !this.preloader;
								swal("Користувача успішно зареєстровано", {
									icon: "success",
									timer: 1000,
									button: false
								});
							})
							.catch((error) => {
								this.preloader = !this.preloader;
								swal({
									icon: "error",
									title: 'Помилка',
									text: 'Користувач с даною поштою вже існує'
								});
							});
					}
				});
			},
			deleteJury(id, index) {
				swal({
					title: "Бажаєте видалити?",
					text: "Після видалення ви не зможете відновити даний запис",
					icon: "warning",
					buttons: true,
					dangerMode: true,
				})
					.then((willDelete) => {
						if (willDelete) {
							this.preloader = !this.preloader;
							axios.post('/delete-user/' + id)
								.then((response) => {
									if (response.status == 200) {
										this.preloader = !this.preloader;
										this.jurys.splice(index, 1);
									}
									swal("Журі був успішно видалений", {
										icon: "success",
									});
								})
								.catch((error) => {
									this.preloader = !this.preloader;
									swal({
										icon: "error",
										title: 'Помилка',
										text: 'Не вдалося'
									});
								});
						}
					})
			}
		}
	}
</script>
