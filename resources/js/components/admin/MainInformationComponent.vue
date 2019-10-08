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
                            <button type="button" :disabled="errors.has('logo')" class="btn btn-outline-secondary edit w-100" @click='editFile("logo_section", "logo", "img")'>Зберегти</button>
                        </div>
                        <p class="text-danger col-9" v-if="errors.has('logo')">{{ errors.first('logo') }}</p>
                    </div>
                    <img v-if="!errors.has('logo')" class="mt-3 w-50" :src="info.logo">
                    <hr>
                    <label for="description" class="brtop">Опис сайту</label>
                    <textarea class="form-control" v-model="info.description" id="description" rows="4" disabled></textarea>
                    <button type="button" class="btn btn-outline-secondary my-2 px-5 float-right edit" @click='edit($event, "logo_section", "description")'>Редагувати</button><br><br>
                    <hr>
                    <label for="ticker" class="brtop">Рухомий рядок</label>
                    <textarea class="form-control" v-model="info.ticker" id="ticker" rows="4" disabled></textarea>
                    <button type="button" class="btn btn-outline-secondary my-2 px-5 float-right edit" @click='edit($event, "logo_section", "ticker")'>Редагувати</button><br>

                    <!-- Положення -->
                    <br>
                    <h3>Положення</h3>
                    <hr>
                    <label for="provisions_text" class="brtop">Короткий опис положення</label>
                    <textarea class="form-control" v-model="info.provisions_text" id="provisions_text" rows="4" disabled></textarea>
                    <button type="button" class="btn btn-outline-secondary my-2 px-5 float-right edit" @click='edit($event, "position_section", "provisions_text")'>Редагувати</button><br><br>
                    <hr>
                    <label for="file" class="brtop">Файл документу про положення</label>
                    <div class="row">
                        <div class="col-9">
                            <label class="custom-file w-100">
                                <input type="file" class="custom-file-input" v-validate="{ 'ext':['pdf', 'doc', 'txt', 'docx'] }" name="document" id="file" ref="file" @change="previewFiles">
                                <span class="custom-file-control">{{ info.file.split('/')[2] }}</span>
                            </label>
                        </div>
                        <div class="col-3">
                            <button type="button" :disabled="errors.has('document')" class="btn btn-outline-secondary edit w-100" @click='editFile("position_section", "file", "file")'>Зберегти</button>
                        </div>
                        <p class="text-danger col-9" v-if="errors.has('document')">{{ errors.first('document') }}</p>
                    </div>
                    <hr>
                    <label for="video" class="brtop">Відео для положення конкурсу (YouTube)</label>
                    <div class="row">
                        <div class="col-9">
                            <input type="text" class="form-control" v-model="info.video" id="video" disabled>
                        </div>
                        <div class="col-3">
                            <button type="button" class="btn btn-outline-secondary edit" @click='edit($event, "position_section", "video")'>Редагувати</button>
                        </div>
                    </div>
                    <iframe class="mt-3" width="100%" height="300" :src="'https://www.youtube.com/embed/'+info.video.slice(info.video.length - 11, info.video.length)" frameborder="0" allowfullscreen></iframe>
                    <hr>
                    <!-- Цитати -->
                    <label for="quote" class="brtop">Цитати</label>
                    <div class="row mt-2" v-for="(quote, index) in quotes" :key="'quote'+index">
                        <div class="col-9">
                            <textarea name="quote" class="form-control" id="quote" cols="30" rows="3" v-model="quote.text" :disabled="quote.disabled == '' ? quote.disabled : true"></textarea>
                        </div>
                        <div class="col-3">
                            <button type="button" class="btn btn-outline-secondary float-right ml-2" @click="delQuotes(index, quote.quote_id)"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            <button v-if="quote !== editing && quote.disabled != false" type="button" class="btn btn-outline-secondary float-right" @click='edit(quote, "quote", index)'><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                            <button v-else type="button" class="btn btn-outline-secondary float-right" @click='saveQuotes(quote, "quote", index)'><i class="fa fa-floppy-o" aria-hidden="true"></i></button>
                        </div>
                    </div>
                    <button type="button" class="btn btn-outline-secondary btn-block mt-2" @click="addQuotes">Додати цитату</button>

                </div>
                <div class="col-2"></div>
                <div class="col-5">

                    <!-- Гімн -->
                    <h3>Гімн</h3>
                    <hr>
                    <label for="hymn_text" class="brtop">Текст гімну</label>
                    <textarea class="form-control" v-model="info.hymn_text" id="hymn_text" rows="10" disabled></textarea>
                    <button type="button" class="btn btn-outline-secondary my-2 px-5 float-right edit" @click='edit($event, "hymn_section", "hymn_text")'>Редагувати</button><br><br>
                    <hr>
                    <label for="audio" class="brtop">Аудіоматеріал</label>

                    <div class="row">
                        <div class="col-9">
                            <label class="custom-file w-100">
                                <input type="file" v-validate="{ 'ext':['mp3', 'flac', 'aif', 'ac3', 'amr', 'aud', 'iff', 'wav'] }" name="audio" class="custom-file-input" id="audio" ref="audio" @change="previewFiles">
                                <span class="custom-file-control">{{ info.audio.split('/')[2] }}</span>
                            </label>
                        </div>
                        <div class="col-3">
                            <button type="button" :disabled="errors.has('audio')" class="btn btn-outline-secondary edit w-100" @click='editFile("hymn_section", "audio", "audio")'>Зберегти</button>
                        </div>
                        <p class="text-danger col-9" v-if="errors.has('audio')">{{ errors.first('audio') }}</p>
                    </div>
                    <hr>
                    <label for="note_image" class="brtop">Зображення для нот</label>

                    <div class="row">
                        <div class="col-9">
                            <label class="custom-file w-100">
                                <input type="file" v-validate="'image'" name="note" class="custom-file-input" id="note_image" ref="note_image" @change="previewFiles($event, 'note_image')">
                                <span class="custom-file-control">Файл не обрано</span>
                            </label>
                        </div>
                        <div class="col-3">
                            <button type="button" :disabled="errors.has('note')" class="btn btn-outline-secondary edit w-100" @click='editFile("hymn_section", "note_image", "img")'>Зберегти</button>
                        </div>
                        <p class="text-danger col-9" v-if="errors.has('note')">{{ errors.first('note') }}</p>
                    </div>
                    <img v-if="!errors.has('note')" class="mt-3 w-50" :src="info.note_image">
                    <!-- Контакти -->
                    <br>
                    <h3 class="mt-3">Контакти</h3>
                    <hr>
                    <label for="emails" class="brtop">Email</label>
                    <div class="row" v-for="(emailItem, index) in contact.emails" :key="'email'+index">
                        <div class="col-10">
                            <input type="text" name="email" class="form-control" v-model="emailItem.contact" id="emails" :disabled="emailItem.disabled == '' ? emailItem.disabled : true"
                                v-validate="{ required: true, regex: /^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/ }"
								    data-vv-as="Email">
                            <span class="errors text-danger" v-if="errors.has('email')">
                                {{ errors.first('email') }}
                            </span>
                        </div>
                        <div class="col-2">
                            <button v-if="emailItem !== editing" type="button" class="btn btn-outline-secondary float-right" @click='editContact(emailItem, "emails", index)'><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                            <button v-else type="button" class="btn btn-outline-secondary float-right" @click='saveContact("emails", index)'><i class="fa fa-floppy-o" aria-hidden="true"></i></button>
                        </div>
                    </div>
                    <hr>
                    <label for="address" class="brtop">Адреса</label>
                    <div class="row" v-for="(addressItem, index) in contact.address" :key="'address'+index">
                        <div class="col-10">
                            <input type="text" name="address" class="form-control" v-model="addressItem.contact" id="address" :disabled="addressItem.disabled == '' ? addressItem.disabled : true"
                                v-validate="{ required: true}" 
                                    data-vv-as="Адреса">
                            <span class="errors text-danger" v-if="errors.has('address')">
								{{ errors.first('address') }}
						    </span>
                        </div>
                        <div class="col-2">
                            <button v-if="addressItem !== editing" type="button" class="btn btn-outline-secondary float-right" @click='editContact(addressItem, "address", index)'><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                            <button v-else type="button" class="btn btn-outline-secondary float-right" @click='saveContact("address", index)'><i class="fa fa-floppy-o" aria-hidden="true"></i></button>
                        </div>
                    </div>
                    <hr>
                    <label for="phones" class="brtop">Телефон 1</label>
                    <div class="row mt-2" v-for="(phone, index) in contact.phones" :key="'phone'+index">
                        <div class="col-9">
                            <input type="text" name="phones" class="form-control" v-model="phone.contact" id="phones" :disabled="phone.disabled == '' ? phone.disabled : true"
                                v-validate="{ required: true, regex: /^(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){10,14}(\s*)?$/ }"
                                    data-vv-as="Телефон">
                        </div>
                        <div class="col-3">
                            <button type="button" class="btn btn-outline-secondary float-right ml-2" @click="del(index, phone.contact_items_id, 'phones')"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            <button v-if="phone !== editing && phone.disabled != false" type="button" class="btn btn-outline-secondary float-right" @click='editContact(phone, "phones", index)'><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                            <button :disabled="errors.has('phone')" v-else type="button" class="btn btn-outline-secondary float-right" @click='saveContact("phones", index)'><i class="fa fa-floppy-o" aria-hidden="true"></i></button>
                        </div>
                    </div>
                            <span class="errors text-danger" v-if="errors.has('phones')">
								{{ errors.first('phones') }}
						    </span>
                    <button type="button" class="btn btn-outline-secondary btn-block mt-2" @click="add('phones')">Додати телефон</button>

                    <!-- Соціальні мережі -->
                    <hr>
                    <label for="social" class="brtop">Соціальні мережі</label>
                    <div class="row mt-2" v-for="(social, index) in contact.socials" :key="'social'+index">
                        <div class="col-5">
                            <input type="text" name="socialLink" class="form-control" v-model="social.contact" id="socialLink" :disabled="social.disabled == '' ? social.disabled : true"
                                v-validate="{ required: true}" 
                                    data-vv-as="Соціальні мережі">
                            <span class="errors text-danger" v-if="errors.has('socialLink')">
								{{ errors.first('socialLink') }}
						    </span>
                        </div>
                        <div class="col-4">
                            <input type="text" name="socialTitle" class="form-control" v-model="social.contact_title" id="socialTitle" :disabled="social.disabled == '' ? social.disabled : true"
                                v-validate="{ required: true}" 
                                    data-vv-as="Соціальні мережі">
                            <span class="errors text-danger" v-if="errors.has('socialTitle')">
								{{ errors.first('socialTitle') }}
						    </span>
                        </div>
                        <div class="col-3">
                            <button type="button" class="btn btn-outline-secondary float-right ml-2" @click="del(index, social.contact_items_id, 'socials')"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            <button v-if="social !== editing && social.disabled != false" type="button" class="btn btn-outline-secondary float-right" @click='editSocial(social, "social", index)'><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                            <button v-else type="button" class="btn btn-outline-secondary float-right" @click='saveSocial("social", index)'><i class="fa fa-floppy-o" aria-hidden="true"></i></button>
                        </div>
                    </div>
                    <button type="button" class="btn btn-outline-secondary btn-block mt-2" @click="add('socials')">Додати соціальну мережу</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import { imgValid } from "../../mixins/validation";
export default {
    data() {
        return {
            editing: {},
            info: {
                logo: '',
                description: '',
                ticker: '',
                provisions_text: '',
                video: '',
                audio: '',
                file: '',
                hymn_text: '',
                note_image: ''
            },
            contact: {
                emails: [],
                address: [],
                phones: [],
                socials: []
            },
            quotes: [],
            form: new FormData,
            showButton: true
        };
    },
	created () {
        this.getAllInfo();
        this.getQuotes();
    },
    validations: {
        info: {
            logo: { imgValid },
        }
    },
    methods: {
        previewFiles(event, el) {
            var input = event.target;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = (e) => {
                    this.info[el] = e.target.result;
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
            this.editing = social;
        },
        saveSocial(el, index) {
            const textElementLink = document.querySelectorAll('#'+el+"Link")[index];
            const textElementTitle = document.querySelectorAll('#'+el+"Title")[index];
            textElementLink.setAttribute('disabled', 'disabled');
            textElementTitle.setAttribute('disabled', 'disabled');
            this.editing = {};
            this.contact.socials[index].disabled = true;
            axios.post('/post-contact', {
                id: this.contact.socials[index].contact_items_id,
                contact: this.contact.socials[index].contact,
                contact_title: this.contact.socials[index].contact_title,
                contact_section_id: 3
            })
        },
        editContact(phone, el, index) {
            const textElement = document.querySelectorAll('#'+el)[index];
            textElement.removeAttribute('disabled');
            textElement.focus();
            this.editing = phone;
        },
        saveContact(el, index) {
            this.selectElement(el, this.contact[el][index], index);
            axios.post('/post-contact', {
                id: this.contact[el][index].contact_items_id,
                contact: this.contact[el][index].contact,
                contact_section_id: this.contact[el][index].contact_section_id
            })
        },

        editFile(table, row, type) {
            this.form.append('type', type);
            this.form.append('table', table);
            this.form.append('row', row);
            this.form.append('file', this.$refs[row].files[0]);
            axios.post('/post-info-file', this.form);
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
                    response.data.info.map(item => {
                        Object.assign(this.info, item);
                    }),
                    response.data.contact.map(item => {
                        Object.assign(this.contact[item.caption], item.contacts_items);
                    })
			    })
        },

        // Quotes
        getQuotes() {
            axios.get('/get-quotes')
            .then((response) => {
                this.quotes = response.data;
            })
        },
        addQuotes() {
	        this.quotes.push({text: '', disabled: false});
        },
        delQuotes(index, id) {
            if(id) {
                axios.post('/delete-quote/'+id);
            }
            this.quotes.splice(index, 1);
        },
        saveQuotes(quote, el, index) {
            this.selectElement(el, this.quotes[index], index);
            if(quote.quote_id) {
                axios.post('/put-quote', {
                    id: this.quotes[index].quote_id,
                    text: this.quotes[index].text,
                })
            } else {
                axios.post('/post-quote', {
                    text: this.quotes[index].text,
                })
            }
        },
        // End Quotes

        add(arr) {
	        this.contact[arr].push({contact: '', disabled: false});
        },
        del(index, id, arr) {
            if(id) {
                axios.post('/delete-contact/'+id);
            }
            this.contact[arr].splice(index, 1);
        },

        selectElement(el, elArray, index) {
            const textElement = document.querySelectorAll('#'+el)[index];
            textElement.setAttribute('disabled', 'disabled');
            this.editing = {};
            elArray.disabled = true;
        },
    }
}
</script>
<style scope>
    .hasError {
        color: red;
    }
</style>