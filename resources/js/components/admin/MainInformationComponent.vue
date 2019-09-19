<template>
    <div>
        <form enctype="multipart/form-data">
            <div class="row">
                <div class="col-5">

                    <!-- Загальні налаштування -->

                    <h3>Загальні налаштування</h3>
                    <hr>
                    <label for="logo" class="brtop">Логотип</label>
                    <div class="row">
                        <div class="col-9">
                            <label class="custom-file w-100">
                                <input type="file" v-validate="'image'" class="custom-file-input" id="logo" name="logo" ref="logo" @change="previewFiles($event, 'logo')" accept="image/*">
                                <span class="custom-file-control">Файл не обрано</span>
                            </label>
                        </div>
                        <div class="col-3">
                            <button type="button" :disabled="errors.has('logo')" class="btn btn-outline-secondary edit w-100" @click='editFile("logo_section", "logo")'>Зберегти</button>
                        </div>
                        <p class="text-danger col-9" v-if="errors.has('logo')">{{ errors.first('logo') }}</p>
                    </div>
                    <img v-if="!errors.has('logo')" class="mt-3 w-50" :src="logo">
                    <hr>
                    <label for="description" class="brtop">Опис сайту</label>
                    <textarea class="form-control" v-model="descriptionText" id="description" rows="4" disabled></textarea>
                    <button type="button" class="btn btn-outline-secondary my-2 px-5 float-right edit" @click='edit($event, "logo_section", "description")'>Редагувати</button><br><br>
                    <hr>
                    <label for="ticker" class="brtop">Рухомий рядок</label>
                    <textarea class="form-control" v-model="tickerText" id="ticker" rows="4" disabled></textarea>
                    <button type="button" class="btn btn-outline-secondary my-2 px-5 float-right edit" @click='edit($event, "logo_section", "ticker")'>Редагувати</button><br>

                    <!-- Положення -->
                    <br>
                    <h3>Положення</h3>
                    <hr>
                    <label for="provisions_text" class="brtop">Короткий опис положення</label>
                    <textarea class="form-control" v-model="provisionsCompetition" id="provisions_text" rows="4" disabled></textarea>
                    <button type="button" class="btn btn-outline-secondary my-2 px-5 float-right edit" @click='edit($event, "position_section", "provisions_text")'>Редагувати</button><br><br>
                    <hr>
                    <label for="file" class="brtop">Файл документу про положення</label>
                    <div class="row">
                        <div class="col-9">
                            <label class="custom-file w-100">
                                <input type="file" class="custom-file-input" v-validate="{ 'ext':['pdf', 'doc', 'txt', 'docx'] }" name="document" id="file" ref="documentFile" @change="previewFiles">
                                <span class="custom-file-control">Файл не обрано</span>
                            </label>
                        </div>
                        <div class="col-3">
                            <button type="button" :disabled="errors.has('document')" class="btn btn-outline-secondary edit w-100" @click='editFile("position_section", "file")'>Зберегти</button>
                        </div>
                        <p class="text-danger col-9" v-if="errors.has('document')">{{ errors.first('document') }}</p>
                    </div>
                    <hr>
                    <label for="video" class="brtop">Відео для положення конкурсу(з YouTube)</label>
                    <div class="row">
                        <div class="col-9">
                            <input type="text" class="form-control" v-model="youtubeVideo" id="video" disabled>
                        </div>
                        <div class="col-3">
                            <button type="button" class="btn btn-outline-secondary edit" @click='edit($event, "position_section", "video")'>Редагувати</button>
                        </div>
                    </div>


                </div>
                <div class="col-2"></div>
                <div class="col-5">

                    <!-- Гімн -->
                    <h3>Гімн</h3>
                    <hr>
                    <label for="hymn_text" class="brtop">Текст гімну</label>
                    <textarea class="form-control" v-model="hymnText" id="hymn_text" rows="4" disabled></textarea>
                    <button type="button" class="btn btn-outline-secondary my-2 px-5 float-right edit" @click='edit($event, "hymn_section", "hymn_text")'>Редагувати</button><br><br>
                    <hr>
                    <label for="audio" class="brtop">Аудіоматеріал</label>

                    <div class="row">
                        <div class="col-9">
                            <label class="custom-file w-100">
                                <input type="file" v-validate="{ 'ext':['mp3', 'flac', 'aif', 'ac3', 'amr', 'aud', 'iff'] }" name="audio" class="custom-file-input" id="audio" ref="audioFile" @change="previewFiles">
                                <span class="custom-file-control">Файл не обрано</span>
                            </label>
                        </div>
                        <div class="col-3">
                            <button type="button" :disabled="errors.has('audio')" class="btn btn-outline-secondary edit w-100" @click='editFile("hymn_section", "audio")'>Зберегти</button>
                        </div>
                        <p class="text-danger col-9" v-if="errors.has('audio')">{{ errors.first('audio') }}</p>
                    </div>
                    <hr>
                    <label for="note_image" class="brtop">Зображення для нот</label>

                    <div class="row">
                        <div class="col-9">
                            <label class="custom-file w-100">
                                <input type="file" v-validate="'image'" name="note" class="custom-file-input" id="note_image" ref="noteFile" @change="previewFiles($event, 'noteImg')">
                                <span class="custom-file-control">Файл не обрано</span>
                            </label>
                        </div>
                        <div class="col-3">
                            <button type="button" :disabled="errors.has('note')" class="btn btn-outline-secondary edit w-100" @click='editFile("hymn_section", "note_image")'>Зберегти</button>
                        </div>
                        <p class="text-danger col-9" v-if="errors.has('note')">{{ errors.first('note') }}</p>
                    </div>
                    <img v-if="!errors.has('note')" class="mt-3 w-50" :src="noteImg">
                    <!-- Контакти -->
                    <br>
                    <h3>Контакти</h3>
                    <hr>
                    <label for="address" class="brtop">Адреса</label>


                    <div class="row" v-for="(addressItem, index) in address" :key="'address'+index">
                        <div class="col-10">
                            <input type="text" class="form-control" v-model="addressItem.contact" id="address" :disabled="addressItem.disabled == '' ? addressItem.disabled : true">
                        </div>
                        <div class="col-2">
                            <button v-if="addressItem !== editingPhone" type="button" class="btn btn-outline-secondary float-right" @click='editPhone(addressItem, "address", index)'><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                            <button v-else type="button" class="btn btn-outline-secondary float-right" @click='saveAddress(addressItem, "address", index)'><i class="fa fa-floppy-o" aria-hidden="true"></i></button>
                        </div>
                    </div>
                    <hr>
                    <label for="phone" class="brtop">Телефон</label>
                    <div class="row mt-2" v-for="(phone, index) in phones" :key="'phone'+index">
                        <div class="col-9">
                            <input type="text" v-validate="{ regex:/^\+380\d{3}\d{2}\d{2}\d{2}$/ }" class="form-control" v-model="phone.contact" name="phone" id="phone" :disabled="phone.disabled == '' ? phone.disabled : true">
                        </div>
                        <div class="col-3">
                            <button type="button" class="btn btn-outline-secondary float-right ml-2" @click="delPhones(index, phone.contact_items_id)"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            <button v-if="phone !== editingPhone && phone.disabled != false" type="button" class="btn btn-outline-secondary float-right" @click='editPhone(phone, "phone", index)'><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                            <button :disabled="errors.has('phone')" v-else type="button" class="btn btn-outline-secondary float-right" @click='savePhone(phone, "phone", index)'><i class="fa fa-floppy-o" aria-hidden="true"></i></button>
                        </div>
                        <p class="text-danger col-9" v-if="errors.has('phone')">{{ errors.first('phone') }}</p>
                    </div>
                    <button type="button" class="btn btn-outline-secondary btn-block mt-2" @click="addPhones">+</button>

                    <!-- Соціальні мережі -->
                    <hr>
                    <label for="social" class="brtop">Соціальні мережі</label>
                    <div class="row mt-2" v-for="(social, index) in socials" :key="'social'+index">
                        <div class="col-5">
                            <input type="text" class="form-control" v-model="social.contact" id="socialLink" :disabled="social.disabled == '' ? social.disabled : true">
                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control" v-model="social.contact_title" id="socialTitle" :disabled="social.disabled == '' ? social.disabled : true">
                        </div>
                        <div class="col-3">
                            <button type="button" class="btn btn-outline-secondary float-right ml-2" @click="delSocial(index, social.contact_items_id)"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            <button v-if="social !== editingSocial && social.disabled != false" type="button" class="btn btn-outline-secondary float-right" @click='editSocial(social, "social", index)'><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                            <button v-else type="button" class="btn btn-outline-secondary float-right" @click='saveSocial(social, "social", index)'><i class="fa fa-floppy-o" aria-hidden="true"></i></button>
                        </div>
                    </div>
                    <button type="button" class="btn btn-outline-secondary btn-block mt-2" @click="addSocial">+</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            editingPhone: {},
            editingSocial: {},
            logo: '',
	        descriptionText: '',
	        tickerText: '',
	        provisionsCompetition: '',
            youtubeVideo: '',
            hymnText: '',
            noteImg: '',
            address: [],
            phones: [],
            socials: [],
            form: new FormData,
            showButton: true
        };
    },
	created () {
        this.getAllInfo();
	},
    methods: {
        previewFiles(event, el) {
            var input = event.target;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = (e) => {
                    this[el] = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
                input.parentNode.querySelector('span').innerHTML = input.files[0].name;
            }
        },
        editSocial(social, el, index) {
            const textElementLink = document.querySelectorAll('#'+el+"Link")[index];
            const textElementTitle = document.querySelectorAll('#'+el+"Title")[index];
            textElementLink.removeAttribute('disabled');
            textElementTitle.removeAttribute('disabled');
            textElementLink.focus();
            this.editingSocial = social;
        },
        saveSocial(social, el, index) {
            const textElementLink = document.querySelectorAll('#'+el+"Link")[index];
            const textElementTitle = document.querySelectorAll('#'+el+"Title")[index];
            textElementLink.setAttribute('disabled', 'disabled');
            textElementTitle.setAttribute('disabled', 'disabled');
            this.editingSocial = {};
            this.socials[index].disabled = true;
            axios.post('/post-contact', {
                id: this.socials[index].contact_items_id,
                contact: this.socials[index].contact,
                contact_title: this.socials[index].contact_title,
                contact_section_id: 3
            })
        },
        editPhone(phone, el, index) {
            const textElement = document.querySelectorAll('#'+el)[index];
            textElement.removeAttribute('disabled');
            textElement.focus();
            this.editingPhone = phone;
        },
        savePhone(phone, el, index) {
            const textElement = document.querySelectorAll('#'+el)[index];
            textElement.setAttribute('disabled', 'disabled');
            this.editingPhone = {};
            this.phones[index].disabled = true;
            axios.post('/post-contact', {
                id: this.phones[index].contact_items_id,
                contact: this.phones[index].contact,
                contact_section_id: 2
            })
        },

        saveAddress(phone, el, index) {
            const textElement = document.querySelectorAll('#'+el)[index];
            textElement.setAttribute('disabled', 'disabled');
            this.editingPhone = {};
            this.address[index].disabled = true;
            axios.post('/post-contact', {
                id: this.address[index].contact_items_id,
                contact: this.address[index].contact,
                contact_section_id: 1
            }).then((res) => {
                console.log(res)
            })
        },

        editFile(table, row) {
            if(row == 'logo') {
                this.form.append('file', this.$refs.logo.files[0]);
            }
            if(row == 'file') {
                this.form.append('file', this.$refs.documentFile.files[0]);
            }
            if(row == 'audio') {
                this.form.append('file', this.$refs.audioFile.files[0]);
            }
            if(row == 'note_image') {
                this.form.append('file', this.$refs.noteFile.files[0]);
            }
            this.form.append('table', table);
            this.form.append('row', row);
            axios.post('/post-info-file', this.form).then((response) => {
                console.log(response)
            })
        },

        edit(event, table, el) {
            const textElement = document.getElementById(el);
            if(this.showButton) {
                textElement.removeAttribute('disabled');
                textElement.focus();
                event.target.innerHTML = 'Зберегти';
                this.showButton = false;
            }
            else {
                textElement.setAttribute('disabled', 'disabled');
                event.target.innerHTML = 'Редагувати';
                axios.post('/post-info', {
                    table,
                    row: el,
                    value: textElement.value
                })
                this.showButton = true;
            }
        },
	    getAllInfo() {
		    axios.get('/get-all-info')
			    .then((response) => {
                    this.logo = '/img/'+response.data.info[0].logo;
                    this.descriptionText = response.data.info[0].description;
                    this.tickerText = response.data.info[0].ticker;
                    this.provisionsCompetition = response.data.info[0].provisions_text;
                    this.hymnText = response.data.info[0].hymn_text;
                    this.noteImg = '/img/'+response.data.info[0].note_image;
                    this.youtubeVideo = response.data.info[0].video;
                    this.address = response.data.contact[0].contacts_items;
                    this.phones = response.data.contact[1].contacts_items;
                    this.socials = response.data.contact[2].contacts_items;
			    })
        },
        addSocial() {
	        this.socials.push({contact: '', disabled: false});
        },
        addPhones() {
            this.phones.push({contact: '', disabled: false});
        },
        delPhones(index, id) {
            if(id) {
                axios.post('/delete-contact/'+id);
            }
            this.phones.splice(index, 1);
        },
        delSocial(index, id) {
            if(id) {
                axios.post('/delete-contact/'+id);
            }
            this.socials.splice(index, 1);
        }
    }
}
</script>