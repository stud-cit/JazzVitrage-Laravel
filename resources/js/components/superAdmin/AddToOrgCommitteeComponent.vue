<template>
    <div>
        <form enctype="multipart/form-data">
            <div class="row">
                <div class="col-5">
                    <div>
						<label for="surname" class="brtop">Прізвище</label>
						<input type="text" name="surname" v-model="surname" class="form-control" id="surname"
						v-validate="{ required: true, regex: /^([a-zа-яіїє']+){2,}$/i }"
								data-vv-as="Прізвище">
						<span class="errors text-danger" v-if="errors.has('surname')">
								{{ errors.first('surname') }}
						</span>
					</div>
					<div>
						<label for="name" class="brtop">Ім'я</label>
						<input type="text" name="name" v-model="name" class="form-control" id="name"
							v-validate="{ required: true, regex: /^([a-zа-яіїє']+){2,}$/i }"
								data-vv-as="Ім'я">
						<span class="errors text-danger" v-if="errors.has('name')">
								{{ errors.first('name') }}
						</span>
					</div>
					<div>
						<label for="patronymic" class="brtop">По батькові</label>
						<input type="text" name="patronymic" v-model="patronymic" class="form-control" id="patronymic"
							v-validate="{ required: true, regex: /^([a-zа-яіїє']+){5,}$/i }"
								data-vv-as="По батькові">
						<span class="errors text-danger" v-if="errors.has('patronymic')">
								{{ errors.first('patronymic') }}
						</span>
					</div>
                    <div>
						<label for="email" class="brtop">Електронна адреса</label>
						<input type="email" name="email" v-model="email" class="form-control" id="email"
							v-validate="{ required: true, regex: /^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/ }"
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
						<input type="file" name="jury-photo" ref="file" class="form-control-file" id="jury-photo"
							v-validate="{ required: true}"
								data-vv-as="Фото">
						<span class="errors text-danger" v-if="errors.has('jury-photo')">
								{{ errors.first('jury-photo') }}
						</span>
					</div>
                    <div>
						<label for="info" class="brtop">Біографія</label>
						<textarea class="form-control" name="informations" v-model="informations" id="info" rows="3" 
							v-validate="{ required: true}"
								data-vv-as="Електронна адреса"></textarea>
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
                <th width="7%">№</th>
                <th width="20%">ПІБ комітету</th>
                <th width="20%">Електронна адреса</th>
                <th width="20%">Фото</th>
                <th width="20%">Біографія</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody v-for="(item, index) in committees" :key="index">
            <tr>
                <td data-toggle="collapse" :data-target="'#collapse'+(index+1)">{{ index + 1 }}</td>
                <td data-toggle="collapse" :data-target="'#collapse'+(index+1)">{{ `${item.surname} ${item.name} ${item.patronymic}` }}</td>
                <td data-toggle="collapse" :data-target="'#collapse'+(index+1)">{{ item.email }}</td>
                <td data-toggle="collapse" :data-target="'#collapse'+(index+1)" @change="getFileName($event)"><img id="item-image" v-bind:src="'../img/user-photo/' + item.photo" class="preview_img figure-img img-fluid"></td>
                <td data-toggle="collapse" :data-target="'#collapse'+(index+1)">{{ item.informations }}</td>
                <td id="edit-save-td">
                    <i v-if="editBtn !== item.user_id" class="fa fa-2x fa-pencil-square btn btn-default p-0" @click="edit(item.user_id, $event)"></i>
                    <i v-else class="fa fa-2x fa-check-circle btn btn-default p-0" @click="save(item.user_id, $event)"></i>
                </td>
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
				editBtn: 0,
				committees: [],
				name: '',
				surname: '',
				patronymic: '',
				email: '',
				informations: '',
				form: new FormData,
				table_form: new FormData
			};
		},
		created () {
			this.getFullOrgCommitteeList();
		},
		methods: {
			getFileName(event) {
				event.target.parentNode.querySelector('#file').innerHTML = event.target.files[0].name;
			},
			edit(id, event){
				this.editBtn = id;
				event.preventDefault();
				var pib_input = document.createElement('input');
				var email_input = document.createElement('input');
				var photo_input = document.createElement('div');
				var biography_input = document.createElement('textarea');

				var pib_td = event.target.parentNode.parentNode.querySelectorAll('td')[1];
				var email_td = event.target.parentNode.parentNode.querySelectorAll('td')[2];
				var photo_td = event.target.parentNode.parentNode.querySelectorAll('td')[3];
				var biography_td = event.target.parentNode.parentNode.querySelectorAll('td')[4];

				pib_input.setAttribute('value', pib_td.innerHTML);
				pib_input.setAttribute('type', 'text');
				pib_input.setAttribute('id', 'pib_data');
				pib_td.innerHTML = '';
				pib_td.append(pib_input);

				email_input.setAttribute('value', email_td.innerHTML);
				email_input.setAttribute('type', 'text');
				email_input.setAttribute('id', 'email_data');
				email_td.innerHTML = '';
				email_td.append(email_input);

				photo_input.setAttribute('class', 'edit-photo');
				photo_input.innerHTML = `<div class="form-group">
                <label class="label">
                    <i class="material-icons"><img src="../img/upload-img.png"></i>
                    <span class="title">Додати файл</span>
					<input type="file" ref="juryfile" class="form-control-file" id="jury-photo">
					<span id="file"></span>
				</label>
                </div>`;
				photo_td.innerHTML = '';
				photo_td.append(photo_input);

				biography_input.value += biography_td.innerHTML;
				biography_input.setAttribute('id', 'biography_data');
				biography_input.setAttribute('rows', '6');
				biography_input.setAttribute('class', 'text-area-width');
				biography_td.innerHTML = '';
				biography_td.append(biography_input);
			},

			save(id, event){
				this.editBtn = 0;
				event.preventDefault();
				var pib_td = event.target.parentNode.parentNode.querySelectorAll('td')[1].querySelector('input').value;
				var email_td = event.target.parentNode.parentNode.querySelectorAll('td')[2].querySelector('input').value;
				var photo_td = event.target.parentNode.parentNode.querySelectorAll('td')[3].querySelector('input');
				var biography_td = event.target.parentNode.parentNode.querySelectorAll('td')[4].querySelector('textarea').value;

				var parse_pib = pib_td.split(' ');
				var parse_email = email_td;
				var parse_photo = photo_td;
				var parse_biography = biography_td;


				this.table_form.append('name', parse_pib[0]);
				this.table_form.append('surname', parse_pib[1]);
				this.table_form.append('patronymic', parse_pib[2]);
				this.table_form.append('email', parse_email);
				this.table_form.append('photo', parse_photo.files[0]);
				this.table_form.append('informations', parse_biography);

				axios.post('/update-org/'+id, this.table_form)
					.then((response) => {
						this.committees = [];
						this.getFullOrgCommitteeList();
					})
			},
			getFullOrgCommitteeList() {
				axios.get('/get-all-org')
					.then((response) => {
						this.committees.push(...response.data)
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
								this.committees = [];
								this.getFullOrgCommitteeList();
							})
					}
				}).catch(() => {
                    console.log(2);

                });
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