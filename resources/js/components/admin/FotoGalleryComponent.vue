<template>
    
    <div>
        <form enctype="multipart/form-data">
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
                        <input type="file" class="custom-file-input" id="foto" ref="file" @change="fieldChange()" multiple>
                        <span class="custom-file-control">{{ `Кількість обраних файлів: ${file.length}` }}</span>
                    </label>
                    <div v-for="(item, index) in file" :key="index">
                        <div class="uploadFiles" :style="item.valid ? {color: 'black'} : {color: 'red'}">{{ item.name }} <i class="fa fa-times-circle btn btn-default p-1 mr-3" @click="delFile(index)"></i></div>
                    </div>
                    <!-- Временное решение -->
                    <transition name="load">
                        <div v-if="load" style="text-align:center">Завантаження</div>
                    </transition>
                    <button type="button" class="btn btn-outline-secondary float-right mt-4 px-5" :disabled="file.length == 0" @click="uploadFile">Додати</button>
                </div>
            </div>
        </form>
        <br>
        <div class="row">
            <silentbox-group class="col-4" v-for="(item, index) in foto" :key="item.foto_id">
                <div class="border fotoGallery" :style="{ backgroundImage: 'url(' + '/img/uploads/'+item.file + ')' }">
                    <i class="fa fa-times-circle btn btn-default p-0" @click="delFoto(item.foto_id, index)"></i>
                    <i class="fa fa-calendar"> {{ item.year }}</i>
                    <silentbox-single :src="'/img/uploads/'+item.file" :description="String(item.year)">
                        <i class="fa fa-search"></i>
                    </silentbox-single>
                    <a :href="'/img/uploads/'+item.file" download><i class="fa fa-download"></i></a>
                </div>
            </silentbox-group>
        </div>
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
            load: false
        }
    },
    created() {
        this.getFoto();
    },
    computed: {
        years() {
            const year = new Date().getFullYear();
            return Array.from({length: year - 2000}, (value, index) => 2001 + index);
        }
    },
    methods: {
        getFoto() {
            axios.get('/get-foto')
            .then((response) => {
                this.foto = response.data;
            })
        },
        fieldChange(){
            let changeFile = this.$refs.file.files;
            for(let i = 0; i < changeFile.length; i++) {
                if(changeFile[i].type == 'image/jpeg') {
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
                this.file = [];
                this.load = false;
                this.getFoto();
            })
        },
        delFile(index) {
            this.file.splice(index, 1);
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
                    axios.post('/delete-foto/'+id)
                    .then(() => {
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
</style>