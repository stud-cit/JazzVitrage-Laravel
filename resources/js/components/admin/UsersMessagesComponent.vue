<template>
    <div>
        <form enctype="multipart/form-data">
                <h3>Повідомлення користувачам сайту</h3>
            <div class="row">
                <div class="col-5">
                    <label for="application_accepted" class="brtop">Повідомлення про реєстрацію учасника в конкурсі</label>
                    <textarea name="application_accepted" class="form-control" id="application_accepted" 
                        v-model="data.application_accepted.text" rows="6" 
                        disabled 
                        v-validate="{ required: true}"
                        data-vv-as="Повідомлення про реєстрацію учасника в конкурсі"
                    ></textarea>
                    <span class="errors text-danger" v-if="errors.has('application_accepted')">
                            {{ errors.first('application_accepted') }}<br>
                    </span>
                    <button :disabled="errors.has('application_accepted')" type="button" class="btn btn-outline-secondary my-2 px-5 float-right edit" @click='edit($event, "application_accepted")'>Редагувати</button><br><br>
                    <hr>

                    <label for="application_approved" class="brtop">Повідомлення про затвердження учасника в конкурсі</label>
                    <textarea name="application_approved" class="form-control" id="application_approved" 
                        v-model="data.application_approved.text" rows="6" 
                        disabled 
                        v-validate="{ required: true}"
                        data-vv-as="Повідомлення про затвердження учасника в конкурсі"
                    ></textarea>
                    <span class="errors text-danger" v-if="errors.has('application_approved')">
                            {{ errors.first('application_approved') }}<br>
                    </span>
                    <button :disabled="errors.has('application_approved')" type="button" class="btn btn-outline-secondary my-2 px-5 float-right edit" @click='edit($event, "application_approved")'>Редагувати</button><br><br>
                    <hr>

                    <label for="application_denied" class="brtop">Повідомлення про відхилення учасника в конкурсі</label>
                    <textarea name="application_denied" class="form-control" id="application_denied" 
                        v-model="data.application_denied.text" rows="6" 
                        disabled 
                        v-validate="{ required: true}"
                        data-vv-as="Повідомлення про відхилення учасника в конкурсі"
                    ></textarea>
                    <span class="errors text-danger" v-if="errors.has('application_denied')">
                            {{ errors.first('application_denied') }}<br>
                    </span>
                    <button :disabled="errors.has('application_denied')" type="button" class="btn btn-outline-secondary my-2 px-5 float-right edit" @click='edit($event, "application_denied")'>Редагувати</button><br><br>
                </div>
                <div class="col-2"></div>
                <div class="col-5">
                    <label for="jury_accepted" class="brtop">Повідомлення про реєстрацію журі на сайті</label>
                    <textarea name="jury_accepted" class="form-control" id="jury_accepted" 
                        v-model="data.jury_accepted.text" rows="6" 
                        disabled 
                        v-validate="{ required: true}"
                        data-vv-as="Повідомлення про реєстрацію журі на сайті"
                    ></textarea>
                    <span class="errors text-danger" v-if="errors.has('jury_accepted')">
                            {{ errors.first('jury_accepted') }}<br>
                    </span>
                    <button :disabled="errors.has('jury_accepted')" type="button" class="btn btn-outline-secondary my-2 px-5 float-right edit" @click='edit($event, "jury_accepted")'>Редагувати</button><br><br>
                    <hr>

                    <label for="org_accepted" class="brtop">Повідомлення про реєстрацію організаційного комітету на сайті</label>
                    <textarea name="org_accepted" class="form-control" id="org_accepted" 
                        v-model="data.org_accepted.text" rows="6" 
                        disabled 
                        v-validate="{ required: true}"
                        data-vv-as="Повідомлення про реєстрацію організаційного комітету на сайті"
                    ></textarea>
                    <span class="errors text-danger" v-if="errors.has('org_accepted')">
                            {{ errors.first('org_accepted') }}<br>
                    </span>
                    <button :disabled="errors.has('org_accepted')" type="button" class="btn btn-outline-secondary my-2 px-5 float-right edit" @click='edit($event, "org_accepted")'>Редагувати</button><br><br>
                    <hr>

                    <label for="admin_accepted" class="brtop">Повідомлення про реєстрацію адміністратора на сайті</label>
                    <textarea name="admin_accepted" class="form-control" id="admin_accepted" 
                        v-model="data.admin_accepted.text" rows="6" 
                        disabled 
                        v-validate="{ required: true}"
                        data-vv-as="Повідомлення про реєстрацію адміністратора на сайті"
                    ></textarea>
                    <span class="errors text-danger" v-if="errors.has('admin_accepted')">
                            {{ errors.first('admin_accepted') }}<br>
                    </span>
                    <button :disabled="errors.has('admin_accepted')" type="button" class="btn btn-outline-secondary my-2 px-5 float-right edit" @click='edit($event, "admin_accepted")'>Редагувати</button><br><br>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    name: "page-info",
    data() {
        return {
            data: {
                application_accepted: {text: ''},
                application_approved: {text: ''},
                application_denied: {text: ''},
                jury_accepted: {text: ''},
                org_accepted: {text: ''},
                admin_accepted: {text: ''}
            }
        }
    },
	created() {
        this.getData();
    },
    methods: {
	    getData() {
		    axios.get('/api/users-messages')
			    .then((response) => {
                    response.data.map(item => {
                        this.data[item.type] = {text: item.text}
                    });
                })
        },
        edit(event, page) {
            const textElement = document.getElementById(page);
            if(event.target.innerHTML == "Редагувати") {
                textElement.removeAttribute('disabled');
                textElement.focus();
                event.target.innerHTML = 'Зберегти';
            }
            else {
                textElement.setAttribute('disabled', 'disabled');
                event.target.innerHTML = 'Редагувати';
                axios.post('/api/users-messages', {
                    page,
                    text: this.data[page].text
                }).then((response) => {
                    swal("Інформація оновлена", {
                        icon: "success",
                        timer: 1000,
                        button: false
                    });
	            })
            }
        },
    }
};
</script>

<style scoped></style>