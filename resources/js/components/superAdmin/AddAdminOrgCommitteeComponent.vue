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
                    <label for="name" class="brtop">Ім'я</label>
                    <input type="text" name="name" v-model="name" class="form-control" id="name"
						v-validate="{ required: true, regex: /^([a-zа-яіїє'-]+){2,}$/i }"
                            data-vv-as="Ім'я">
					<span class="errors text-danger" v-if="errors.has('name')">
							{{ errors.first('name') }}
                    </span>
                </div>
				
                <div class="col-2"></div>
                <div class="col-5">
                    <label for="email" class="brtop">Електронна адреса</label>
                    <input type="email" name="email" v-model="email" class="form-control" id="email"
						v-validate="{ required: true, regex: /^([a-zA-Z0-9_-]+\.)*[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)*\.[a-z]{2,6}$/ }"
                            data-vv-as="Електронна адреса">
					<span class="errors text-danger" v-if="errors.has('email')">
							{{ errors.first('email') }}
                	</span>
                    <button type="button" class="btn btn-outline-secondary float-right mt-4 px-5" @click="postAdmin">Додати</button>
                </div>
				
            </div>
        </form>
        <br>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th width="10px" scope="col">№</th>
					<th scope="col">Прізвище</th>
					<th scope="col">Ім’я</th>
					<th scope="col">Електронна пошта</th>
					<th width="10px" scope="col"></th>
					<th width="10px" scope="col"></th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="(item, index) in admin" :key="item.user_id">
					<th scope="row">{{ index + 1 }}</th>
					<td>{{ item.surname }}</td>
					<td>{{ item.name }}</td>
					<td>{{ item.email }}</td>
					<td><a style="color:#000" :href="'/admin/profile/'+item.user_id"><i class="fa fa-2x fa-pencil-square btn btn-default p-0"></i></a></td>
					<td><i class="fa fa-2x fa-times-circle btn btn-default p-0" @click="deleteAdmin(item.user_id, index)"></i></td>
				</tr>
			</tbody>
		</table>
    </div>
</template>
<script>
	export default {
		data() {
			return {
				admin: [],
				name: '',
				surname: '',
				email: '',
				defaultPatronymic: 'default',
				form: new FormData
			};
		},
		created () {
			this.getAdmin();
		},
		methods: {
			getAdmin() {
				axios.get('/get-all-admin-org')
					.then((response) => {
						this.admin = response.data;
					})
			},
			postAdmin() {
				this.$validator.validateAll().then((result) => {
					if (!result) {
						return;
					} else {
						this.form.append('name', this.name);
						this.form.append('surname', this.surname);
						this.form.append('email', this.email);
						this.form.append('patronymic', this.defaultPatronymic);
						axios.post('/post-all-admin', this.form)
							.then((res) => {
								this.admin.push(res.data);
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
			deleteAdmin(id, index) {
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
									this.admin.splice(index, 1);
									swal("Адміністратор був успішно видалений", {
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
					})
			}
		}
	}
</script>