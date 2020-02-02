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
						<label for="email" class="brtop">Електронна адреса</label>
						<input type="email" name="email" v-model="email" class="form-control" id="email"
							v-validate="{ required: true, regex: /^([a-zA-Z0-9_-]+\.)*[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)*\.[a-z]{2,6}$/ }"
								data-vv-as="Електронна адреса">
						<span class="errors text-danger" v-if="errors.has('email')">
								{{ errors.first('email') }}
						</span>
					</div>	
                </div>
                <div class="col-2"></div>
                <div class="col-5">
					<div>
						<label for="jury-photo" class="brtop">Фото</label>
						<input type="file" name="jury-photo" accept="image/*" ref="file" class="form-control-file" id="jury-photo"
							v-validate="'image'"
								data-vv-as="Фото">
						<span class="errors text-danger" v-if="errors.has('jury-photo')">
								Файл повинен бути зображенням
						</span>
					</div>
                    <div>
						<label for="info" class="brtop">Біографія</label>
						<textarea class="form-control" name="informations" v-model="informations" id="info" rows="3" 
							v-validate="{ required: true}"
								data-vv-as="Біографія"></textarea>
						<span class="errors text-danger" v-if="errors.has('informations')">
								{{ errors.first('informations') }}
						</span>
                    </div>
                    <button type="button" class="btn btn-outline-secondary float-right mt-4 px-5" @click="postAllOrg">Додати</button>
                </div>
            </div>
        </form>
        <br>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th width="10px" scope="col">№</th>
					<th width="150px" scope="col">Фото</th>
					<th width="150px" scope="col">ПІБ</th>
					<th width="180px" scope="col">Електронна пошта</th>
					<th scope="col">Біографія</th>
					<th scope="col"></th>
					<th scope="col"></th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="(item, index) in committees" :key="item.user_id">
					<th scope="row">{{ index + 1 }}</th>
					<td>
						<img v-if="item.photo" id="item-image" :src="item.photo" class="preview_img figure-img img-fluid">
						<img v-else id="item-image" :src="'../img/user.png'" class="preview_img figure-img img-fluid">
					</td>
					<td>{{ `${item.surname} ${item.name} ${item.patronymic}` }}</td>
					<td>{{ item.email }}</td>
					<td>{{ item.informations }}</td>
					<td><a style="color:#000" :href="'/admin/profile/'+item.user_id"><i class="fa fa-2x fa-pencil-square btn btn-default p-0"></i></a></td>
					<td><i class="fa fa-2x fa-times-circle btn btn-default p-0" @click="deleteOrgCommittee(item.user_id, index)"></i></td>
				</tr>
			</tbody>
		</table>
    </div>
</template>
<script>
	export default {
		data() {
			return {
				committees: [],
				name: '',
				surname: '',
				patronymic: '',
				email: '',
				informations: '',
				form: new FormData
			};
		},
		created () {
			this.getOrgCommittee();
		},
		methods: {
			getOrgCommittee() {
				axios.get('/get-all-org')
					.then((response) => {
						this.committees = response.data;
					})
			},
			postAllOrg(){
				this.$validator.validateAll().then((result) => {
                    if (!result) {	
						return;
					}
					else {
						this.form.append('name', this.name);
						this.form.append('surname', this.surname);
						this.form.append('patronymic', this.patronymic);
						this.form.append('email', this.email);
						this.form.append('photo', this.$refs.file.files[0]);
						this.form.append('informations', this.informations);
						axios.post('/post-all-org', this.form)
							.then((response) => {
								this.committees.push(response.data);
								swal("Користувача успішно зареєстровано", {
									icon: "success",
									timer: 1000,
									button: false
								});
							})
								.catch((error) => {
									swal({
										icon: "error",
										title: 'Помилка',
										text: 'Користувач с даною поштою вже існує'
									});
								});
					}
				})
			},
			deleteOrgCommittee(id, index) {
				swal({
					title: "Бажаєте видалити?",
					text: "Після видалення ви не зможете відновити даний запис",
					icon: "warning",
					buttons: true,
					dangerMode: true,
				})
					.then((willDelete) => {
						if (willDelete) {
							axios.post('/delete-user/' + id)
								.then((response) => {
									if (response.status == 200) {
										this.committees.splice(index, 1);
									}
									swal("Член орг. комітету був успішно видалений", {
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
					});
			}
		}
	}
</script>