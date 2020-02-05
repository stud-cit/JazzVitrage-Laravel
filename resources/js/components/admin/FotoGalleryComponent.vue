<template>
    <div>
		<div class="row">
			<div class="col-12 mt-1 mb-2">
				<div class="row">
					<div class="col-9">
						<button type="button" class="btn btn-primary float-left" @click="showForm = !showForm">Додати фото</button>
					</div>
					<div class="col-3">
						<select class="form-control" placeholder="Сортувати по типу заходу" v-model="typePhoto" id="typePhoto">
							<option value="Всі фото">Всі фото</option>
							<option value="Джаз-Вітраж">Джаз-Вітраж</option>
							<option value="Мастер клас">Мастер клас</option>
						</select>
					</div>
				</div>
				<button type="button" v-if="id.length" class="btn btn-primary float-right mx-2 mt-2" @click="delArrayFoto">Видалити</button>
				<button type="button" v-if="id.length" class="btn btn-primary float-right mt-2" @click="editPhoto">Змінити дату</button>
				<span v-if="id.length" class="btn float-right mx-2 mt-2">Обрано {{id.length}} елементів</span>
			</div>
		</div>
		<hr>
		<transition name="load">
			<form enctype="multipart/form-data" v-if="showForm">
				<div class="row">
					<div class="col-5">
						<label for="typeEvent">Тип заходу</label>
						<select class="form-control" v-model="typeEvent" id="typeEvent">
							<option>Джаз-Вітраж</option>
							<option>Мастер клас</option>
						</select>
						<label for="yearCompetition">Рік проведення конкурсу</label>
						<select class="form-control" v-model="yearCompetition" id="yearCompetition">
							<option v-for="(year, index) in years" :key="index" :value="year">{{ year }}</option>
						</select>
					</div>
					<div class="col-2"></div>
					<div class="col-5">
						<label for="foto">Фото в оригінальній якості</label>
						<label class="custom-file w-100">
							<input type="file" name="foto" v-validate="'image'" class="custom-file-input" id="foto" ref="file" @change="fieldChange()" accept="image/*" multiple>
							<span class="custom-file-control">{{ `Кількість обраних файлів: ${file.length}` }}</span>
						</label>
						<div v-for="(item, index) in file" :key="index">
							<div class="uploadFiles" :style="item.valid ? {color: 'black'} : {color: 'red'}">{{ item.name }} <i class="fa fa-times-circle btn btn-default p-1 mr-3" @click="delFile(index)"></i></div>
							<span class="text-danger" v-if="errors.has('foto')">Файл повинен бути зображенням</span>
						</div>
						<!-- Временное решение -->
						<transition name="load">
							<div v-if="load" style="text-align:center">Завантаження</div>
						</transition>
						<button type="button" class="btn btn-outline-secondary float-right mt-4 px-5" :disabled="file.length == 0 || errors.has('foto')" @click="uploadFile">Додати</button>
					</div>
				</div>
			</form>
		</transition>
        <br>
        <div class="row">
            <silentbox-group class="col-4" v-for="(item, index) in paginatedData" :key="item.foto_id">
                <div class="border fotoGallery">
					<div class="circle"><i class="fa fa-times-circle btn btn-default p-0" @click="delFoto(item.foto_id, index)"></i></div>
					<div class="calendar"><i class="fa fa-calendar "> {{ item.year }}</i></div>
                    <div class="gallery-img" :style="{ backgroundImage: 'url(' + '/img/uploads/'+item.file + ')'  }"></div>
                    <silentbox-single :src="'/img/uploads/'+item.file" :description="String(item.year)">
                        <i class="fa fa-search"></i>
                    </silentbox-single>
					<div class="edit">
						<div class="chekbox-two">
							<label class="checkbox">
								<input type="checkbox" class="checkPhoto" :checked="id.indexOf(item.foto_id) != -1 ? true : false" @click="itemFile(item.foto_id)">
								<span class="checkbox__icon"></span>
							</label>
						</div>
					</div>
                    <a :href="'/img/uploads/'+item.file" download><i class="fa fa-download"></i></a>
                </div>
            </silentbox-group>
        </div>
        <ul v-if="foto.length > 0" class="pagination justify-content-center">
            <li class="controls active" v-if="pagination.pageNumber !== 0" @click="prevPage"><i class="fa fa-long-arrow-left" aria-hidden="true" v-if="pagination.pageNumber !== 0"></i></li>
            <li>{{ pagination.pageNumber + 1 }} : {{ pageCount }}</li>
            <li class="controls active" v-if="pagination.pageNumber <= pageCount -2" @click="nextPage"><i class="fa fa-long-arrow-right" aria-hidden="true" v-if="pagination.pageNumber <= pageCount -2"></i></li>
        </ul>
    </div>
</template>

<script>
	export default {
		data() {
			return {
				file: [],
				foto: [],
				yearCompetition: new Date().getFullYear(),
				typeEvent: 'Джаз-Вітраж',
				typePhoto: 'Всі фото',
				load: false,
				pagination : {
					pageNumber: 0,
					size: 9
				},
				id: [],
				showForm: false
			}
		},
		created() {
			this.getFoto();
		},
		computed: {
			years() {
				const year = new Date().getFullYear();
				return Array.from({length: year - 2000}, (value, index) => 2001 + index);
			},
			filteredList() {
				return this.foto.filter(photo => {
					if (this.typePhoto == 'Всі фото'){
						return this.foto;
					}
					else {
						return photo.type == this.typePhoto
					}
				})
			},
			paginatedData() {
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
			getFoto() {
				axios.get('/get-foto')
					.then((response) => {
						this.foto = response.data;
					})
			},
			itemFile(id) {
				if(this.id.indexOf(id) == -1) {
					this.id.push(id);
				} else {
					this.id.splice(this.id.indexOf(id), 1);
				}
			},
			editPhoto() {
				swal("Введіть бажану дату:", {
					content: "input"
				}).then((year) => {
					var regex = /(20[0-9]{2})$/;
            		if (regex.test(year)) {
						axios.post('/put-foto', {
							id: this.id,
							year
						}).then(() => {
							this.id = [];
							this.getFoto();
							swal("Дата змінена", {
								icon: "success",
							});
						})
					}
					else {
						swal({
							icon: "error",
							title: 'Введіть коректні дані (рік не раніше 2000)'
						});
					}
				});
			},
			fieldChange(){
				let changeFile = this.$refs.file.files;
				for(let i = 0; i < changeFile.length; i++) {
					if(changeFile[i].type == 'image/jpeg' || changeFile[i].type == 'image/png') {
						changeFile[i].valid = true;
					} else {
						changeFile[i].valid = false;
					}
					this.file.push(changeFile[i]);
				}
			},
			uploadFile(){
				var form = new FormData;
				this.load = true;
				for(let i = 0; i < this.file.length; i++){
					if(this.file[i].valid) {
						form.append('pics[]', this.file[i]);
					}
				}
				form.append('type', this.typeEvent);
				form.append('year', this.yearCompetition);
				axios.post('/post-foto', form)
					.then((res) => {
						console.log(res.data)
						this.file = [];
						this.load = false;
						this.showForm = false;
						this.getFoto();
					})
			},
			delFile(index) {
				this.file.splice(index, 1);
			},
			delArrayFoto() {
				swal({
					title: "Бажаєте видалити?",
					text: "Після видалення ви не зможете відновити ці файли!",
					icon: "warning",
					buttons: true,
					dangerMode: true,
				}).then((willDelete) => {
					if (willDelete) {
						axios.post('/delete-foto', {
							id: this.id
						})
							.then(() => {
								this.id = [];
								this.getFoto();
								swal("Файли успішно видалені", {
									icon: "success",
								});
							});
					}
				});
			},
			delFoto(id, index) {
				swal({
					title: "Бажаєте видалити?",
					text: "Після видалення ви не зможете відновити цей файл!",
					icon: "warning",
					buttons: true,
					dangerMode: true,
				})
					.then((willDelete) => {
						if (willDelete) {
							axios.post('/delete-foto', {
								id: [id]
							})
								.then(() => {
									this.id = [];
									this.foto.splice(index, 1);
									swal("Файл успішно видалено", {
										icon: "success",
									});
								});
						}
					});
			}
		}
	}
</script>

<style scoped>
    .uploadFiles {
        border: 1px solid silver;
        width: 100%;
        margin-top: 10px;
        padding: 10px 15px;
        border-radius: 5px;
    }
    .uploadFiles i {
        position: absolute;
        right: 10px;
    }
    .fotoGallery{
        height: auto
    }
    .fotoGallery .fa-calendar{
        position: static
    }
    .fotoGallery .width-100{
        width: calc(100% - 30px);
    }
    .gallery-img{
        background-size: cover;
        margin-bottom: 10px;
        height: 200px;
    }
</style>