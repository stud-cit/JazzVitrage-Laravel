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
                <th width="15%">ПІБ журі</th>
                <th width="15%">Фото</th>
                <th width="15%">Електронна адреса</th>
                <th width="15%">Звання члена журі</th>
                <th width="15%">Номінація</th>
                <th width="15%">Членство в спілках журі</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody id="juryTableID" v-for="(item, index) in jurys" :key="index">
            <tr>
                <td data-toggle="collapse" :data-target="'#collapse'+(index+1)">{{ index + 1 }}</td>
                <td class="editing-td" data-toggle="collapse" :data-target="'#collapse'+(index+1)">{{ `${item.name} ${item.surname} ${item.patronymic}` }}</td>

                <td class="editing-td" data-toggle="collapse" :data-target="'#collapse'+(index+1)" @change="getFileName($event, index)">
					<img id="item-image" v-bind:src="'../img/user-photo/' + item.photo" class="preview_img figure-img img-fluid">
				</td>

                <td class="editing-td" data-toggle="collapse" :data-target="'#collapse'+(index+1)">{{ item.email }}</td>
                <td class="editing-td" data-toggle="collapse" :data-target="'#collapse'+(index+1)">{{ item.rank }}</td>
                <td class="editing-td" data-toggle="collapse" :data-target="'#collapse'+(index+1)">{{ item.nominations }}</td>
                <td class="editing-td" data-toggle="collapse" :data-target="'#collapse'+(index+1)">{{ item.informations }}</td>

                <td class="editing-td text-center" data-toggle="collapse" :data-target="'#collapse'+(index+1)" id="edit-save-td">
                    <i v-if="editBtn !== item.user_id" class="fa fa-2x fa-pencil-square btn btn-default p-0" @click="edit(item.user_id, $event)"></i>
                    <i v-else class="fa fa-2x fa-check-circle btn btn-default p-0" @click="save(item.user_id, $event)"></i>
                </td>
                <td class="editing-td text-center" data-toggle="collapse" :data-target="'#collapse'+(index+1)" id="del-td"><i class="fa fa-2x fa-times-circle btn btn-default p-0" @click="deleteJury(item.user_id, index)"></i></td>

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
				form: new FormData,
				table_form: new FormData
			};
		},
		created () {
			this.getFullJuryList();
		},
		methods: {

			getFileName(evt, index) {
				var tr = document.querySelectorAll('tr')[index + 1]
				var file = evt.target.files;
				var reader = new FileReader();
				reader.onload = (function(theFile) {
					return function(e) {
						tr.querySelector('#photo_value_jury').setAttribute('src', e.target.result);
					};
				})(file[0]);
				reader.readAsDataURL(file[0]);

				evt.target.parentNode.querySelector('#span_id').innerHTML = `<br>`;
				evt.target.parentNode.querySelector('#up_icon').innerHTML = `<br>`;

			},
			edit(id, event){
				this.editBtn = id;
				event.preventDefault();
				var pib_input = document.createElement('input');
				var photo_input = document.createElement('div');
				var email_input = document.createElement('input');
				var rank_input = document.createElement('input');
				var nomination_select = document.createElement('select');

				var information_input = document.createElement('textarea');
				var pib_td = event.target.parentNode.parentNode.querySelectorAll('td')[1];
				let photo_td = event.target.parentNode.parentNode.querySelectorAll('td')[2];
				var email_td = event.target.parentNode.parentNode.querySelectorAll('td')[3];
				var rank_td = event.target.parentNode.parentNode.querySelectorAll('td')[4];
				var nomination_td = event.target.parentNode.parentNode.querySelectorAll('td')[5];
				var information_td = event.target.parentNode.parentNode.querySelectorAll('td')[6];
				pib_input.setAttribute('value', pib_td.innerHTML);
				pib_input.setAttribute('type', 'text');
				pib_input.setAttribute('id', 'pib_data');
				pib_input.setAttribute('class','input-edit-correct');
				pib_td.innerHTML = '';
				pib_td.append(pib_input);


				photo_input.setAttribute('class', 'edit-jury-photo');
				photo_input.innerHTML = `<div class="form-group">
                <label class="label" id="label">

                    <i class="material-icons" id="up_icon"><img src="../img/upload-img.png"></i>
                    <span class="title" id="span_id">Додати файл</span>

					<input type="file" ref="juryfile" class="form-control-file" id="jury-photo">
				</label>
                </div>`;

				var photo_label = photo_td.querySelector('img');

				photo_label.setAttribute('id', 'photo_value_jury');
				photo_label.removeAttribute('class');
				document.getElementById('photo_value_jury').style.opacity = "0.5";

				photo_input.prepend(photo_label);

				photo_td.append(photo_input);

				email_input.setAttribute('value', email_td.innerHTML);
				email_input.setAttribute('type', 'text');
				email_input.setAttribute('id', 'email_data');
				email_input.setAttribute('class','input-edit-correct');
				email_td.innerHTML = '';
				email_td.append(email_input);

				rank_input.setAttribute('value', rank_td.innerHTML);
				rank_input.setAttribute('type', 'text');
				rank_input.setAttribute('id', 'rank_data');
				rank_input.setAttribute('class','input-edit-correct');
				rank_td.innerHTML = '';
				rank_td.append(rank_input);

				nomination_select.setAttribute('id', 'parse_table_select');
				nomination_select.setAttribute('class','input-edit-correct');
				nomination_td.innerHTML = '';
				nomination_td.append(nomination_select);
				var sel = document.getElementById('parse_table_select');
				var opt1 = document.createElement('option');
				var opt2 = document.createElement('option');
				var opt3 = document.createElement('option');
				opt1.appendChild( document.createTextNode('Інструментальний жанр') );
				opt2.appendChild( document.createTextNode('Вокальний жанр') );
				opt3.appendChild( document.createTextNode('Композиція') );
				sel.appendChild(opt1);
				sel.appendChild(opt2);
				sel.appendChild(opt3);


				information_input.value += information_td.innerHTML;
				information_input.setAttribute('id', 'information_data');
				information_input.setAttribute('rows', '6');
				information_input.setAttribute('class', 'text-area-width');
				information_td.innerHTML = '';
				information_td.append(information_input);
			},
			save(id, event){
				this.editBtn = 0;
				event.preventDefault();
				var pib_td = event.target.parentNode.parentNode.querySelectorAll('td')[1].querySelector('input').value;
				var photo_td = event.target.parentNode.parentNode.querySelectorAll('td')[2].querySelector('input');
				var email_td = event.target.parentNode.parentNode.querySelectorAll('td')[3].querySelector('input').value;
				var rank_td = event.target.parentNode.parentNode.querySelectorAll('td')[4].querySelector('input').value;
				var nomination_td = event.target.parentNode.parentNode.querySelectorAll('td')[5].querySelector('select').value;
				var information_td = event.target.parentNode.parentNode.querySelectorAll('td')[6].querySelector('textarea').value;

				var parse_pib = pib_td.split(' ');
				var parse_photo = photo_td;
				var parse_email = email_td;
				var parse_rank = rank_td;
				var parse_nomination = nomination_td;
				var parse_information = information_td;

				this.table_form.append('name', parse_pib[0]);
				this.table_form.append('surname', parse_pib[1]);
				if (typeof parse_pib[2] == 'undefined') {
				} else {
					this.table_form.append('patronymic', parse_pib[2]);
				}
				this.table_form.append('email', parse_email);
				this.table_form.append('rank', parse_rank);
				this.table_form.append('photo', parse_photo.files[0]);
				this.table_form.append('nominations', parse_nomination);
				this.table_form.append('informations', parse_information);

				axios.post('/update-jury/'+id, this.table_form)
					.then((response) => {
						this.jurys = [];
						this.getFullJuryList();
						swal("Інформація оновлена", {
							icon: "success",
							timer: 1000,
							button: false
						});
					})
					.catch((error) => {
						this.jurys = [];
						this.getFullJuryList();
						swal({
							icon: "error",
							title: 'Помилка',
							text: 'Поля: "ПІБ журі, фото, електронна адреса" повинні бути заповнені'
						});
					});
			},
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
				const selects = document.querySelectorAll('table_select');
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
							axios.post('/delete-user/' + id)
								.then((response) => {
									if (response.status == 200) {
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
					})
			}
		}
	}
</script>