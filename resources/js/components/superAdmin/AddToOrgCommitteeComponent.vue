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

                    <label for="email" class="brtop">Електронна адреса</label>
                    <input type="email" v-model="email" class="form-control" id="email">
                </div>
                <div class="col-2"></div>
                <div class="col-5">
                    <label for="jury-photo" class="brtop">Фото</label>
                    <input type="file" ref="file" class="form-control-file" id="jury-photo">

                    <label for="info" class="brtop">Біографія</label>
                    <textarea class="form-control" v-model="additionalInfo" id="info" rows="3"></textarea>
                    <button type="button" class="btn btn-outline-secondary float-right mt-4 px-5" @click="postAllOrg">Додати</button>
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
                <th width="27%">По-батькові</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody v-for="(item, index) in committees" :key="index">
            <tr>
                <td data-toggle="collapse" :data-target="'#collapse'+(index+1)">{{ index + 1 }}</td>
                <td data-toggle="collapse" :data-target="'#collapse'+(index+1)">{{ item.surname }}</td>
                <td data-toggle="collapse" :data-target="'#collapse'+(index+1)">{{ item.name }}</td>
                <td data-toggle="collapse" :data-target="'#collapse'+(index+1)">{{ item.patronymic }}</td>
                <td><i class="fa fa-2x fa-pencil-square btn btn-default p-0"></i></td>
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
				additionalInfo: '',
				form: new FormData
			};
		},
		created () {
			this.getFullOrgCommitteeList();
		},
		methods: {
			getFullOrgCommitteeList() {
				axios.get('/get-all-org')
                    .then((response) => {
                    	this.committees.push(...response.data)
                    })
            },
			postAllOrg(){
				this.form.append('name', this.name);
				this.form.append('surname', this.surname);
				this.form.append('patronymic', this.patronymic);
				this.form.append('email', this.email);
				this.form.append('photo', this.$refs.file.files[0]);
				this.form.append('informations', this.informations);
				axios.post('/post-all-org', this.form)
					.then((response) => {
                        this.committees = [];
                        this.getFullOrgCommitteeList();
					})
            },
			deleteOrgCommittee(id, index){
				axios.post('/delete-user/'+id)
                    .then((response) => {
                    	if(response.status == 200) {
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
		}
	}
</script>