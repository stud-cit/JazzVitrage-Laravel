<template>
    <div>
        <form enctype="multipart/form-data">
            <div class="row">
                <div class="col-5">
                    <label for="name" class="brtop">Прізвище</label>
                    <input type="text" v-model="name" class="form-control" id="name">

                    <label for="surname" class="brtop">Ім'я</label>
                    <input type="text" v-model="surname" class="form-control" id="surname">
                </div>
                <div class="col-2"></div>
                <div class="col-5">
                    <label for="email" class="brtop">Електронна адреса</label>
                    <input type="email" v-model="email" class="form-control" id="email">

                    <button type="button" class="btn btn-outline-secondary float-right mt-4 px-5" @click="postAdmin">Додати</button>
                </div>
            </div>
        </form>
        <br>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th width="7%">№</th>
                <th width="27%">Прізвище</th>
                <th width="27%">Ім’я</th>
                <th width="27%">Електронна адеса</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody v-for="(item, index) in admin" :key="index">
            <tr>
                <td data-toggle="collapse" :data-target="'#collapse'+(index+1)">{{ index + 1 }}</td>
                <td data-toggle="collapse" :data-target="'#collapse'+(index+1)">{{ item.surname }}</td>
                <td data-toggle="collapse" :data-target="'#collapse'+(index+1)">{{ item.name }}</td>
                <td data-toggle="collapse" :data-target="'#collapse'+(index+1)">{{ item.email }}</td>
                <td><i class="fa fa-2x fa-pencil-square btn btn-default p-0"></i></td>
                <td><i class="fa fa-2x fa-times-circle btn btn-default p-0" @click="deleteAdminOrgCommittee(item.user_id, index)"></i></td>
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
				form: new FormData
			};
		},
		created () {
			this.getFullAdminOrgCommitteeList();
		},
		methods: {
			getFullAdminOrgCommitteeList() {
				axios.get('/get-all-admin-org')
                    .then((response) => {
	                    this.admin.push(...response.data)
                    })
            },
			postAdmin(){
				this.form.append('name', this.name);
				this.form.append('surname', this.surname);
				this.form.append('email', this.email);
				axios.post('/post-all-admin', this.form)
					.then((response) => {
                        this.admin = [];
                        this.getFullAdminOrgCommitteeList();
					})
            },
			deleteAdminOrgCommittee(id, index){
				axios.post('/delete-user/'+id)
					.then((response) => {
						if(response.status == 200) {
							this.admin.splice(index, 1);
						}
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
		}
	}
</script>