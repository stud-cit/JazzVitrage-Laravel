<template>
<div class="container bootstrap snippet">
    <div class="row">
  	    <div class="col-sm-4">
            <div class="text-center">
                <img v-if="data.photo" :src="'/img/user-photo/' + data.photo" class="avatar img-circle img-thumbnail" alt="avatar">
                <img v-else :src="'/img/user.png'" class="avatar img-circle img-thumbnail" alt="avatar">
                <h6>Завантажити інше фото...</h6>
                <input type="file" name="foto" id="foto" ref="file" accept="image/*" class="text-center center-block file-upload ml-2" v-validate="'image'"><br>
                <span class="errors text-danger ml-2" v-if="errors.has('foto')">
                    Оберіть файл графічного формату
                </span>
            </div>
                
            <br/>
            <ul class="list-group">
                <li class="list-group-item text-muted">Діяльність</li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Роль</strong></span> {{ data.role }}</li>
                <li v-show="data.rank" class="list-group-item text-right"><span class="pull-left"><strong>Звання </strong></span> {{ data.rank }}</li>
                <li v-show="data.nominations" class="list-group-item text-right"><span class="pull-left"><strong>Номінація</strong></span> {{ data.nominations }}</li>
            </ul> 
        </div>

    	<div class="col-sm-8">
          <div class="tab-content">
            <div class="tab-pane active" id="home">
                <form class="form" id="registrationForm">
                    <div class="row">
                        <div class="form-group">
                            <div class="col-8">
                                <label for="surname"><h4>Прізвище</h4></label>
                                <input type="text" class="form-control" name="surname" id="surname" v-model="data.surname"
                                    v-validate="{ required: true, regex: /^([a-zа-яіїє']+){2,}$/i }">
                                <span class="errors text-danger" v-if="errors.has('surname')">
                                        Поле "Прізвище" має бути заповнене не менше, ніж 2 символами
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-8">
                                <label for="name"><h4>Ім'я</h4></label>
                                <input type="text" class="form-control" name="name" id="name" v-model="data.name"
                                    v-validate="{ required: true, regex: /^([a-zа-яіїє']+){2,}$/i }">
                                <span class="errors text-danger" v-if="errors.has('name')">
                                        Поле "Ім’я" має бути заповнене не менше, ніж 2 символами
                                </span>
                            </div>
                        </div>
                        <div class="form-group" v-show="data.role == 'jury' || data.role == 'orgComittee'">
                            <div class="col-8">
                                <label for="patronymic"><h4>По-батькові</h4></label>
                                <input type="text" class="form-control" name="patronymic" id="patronymic" v-model="data.patronymic"
                                    v-validate="{ required: true, regex: /^([a-zа-яіїє']+){5,}$/i }">
                                <span class="errors text-danger" v-if="errors.has('patronymic')">
                                        Поле "По-батькові" має бути заповнене не менше, ніж 5 символами
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-8">
                                <label for="email"><h4>Email</h4></label>
                                <input type="email" class="form-control" name="email" id="email" v-model="data.email" required
                                    v-validate="{ regex: /^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/ }">
                                <span class="errors text-danger" v-if="errors.has('email')">
                                    Введіть дані у форматі name@email.com
                                </span>
                            </div>
                        </div>
                        <div class="form-group" v-show="data.role == 'jury' || data.role == 'orgComittee'">
                            <div class="col-8">
                                <label for="info"><h4>Біографія</h4></label>
                                <textarea class="form-control" id="info" name="info" rows="3" v-model="data.informations"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-8">
                                <h5 style="border-bottom: 1px solid #dedede;padding-bottom: 10px">Зміна паролю</h5>
                                <label for="newPassword"><h4>Новий пароль</h4></label>
                                <input type="password" class="form-control" name="newPassword" id="newPassword" v-model="newPassword">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-8">
                                <label for="repeatPassword"><h4>Повторіть пароль</h4></label>
                                <input type="password" class="form-control" name="repeatPassword" id="repeatPassword" v-model="repeatPassword">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-12">
                                <button :disabled="!checkNewPassword || errors.any()" class="btn btn-lg btn-success" type="button" @click="save"><i class="glyphicon glyphicon-ok-sign"></i> Зберегти</button>
                            </div>
                        </div>
                    </div>
              	</form>
            </div>
        </div>
    </div>
</div>
</div>
</template>
<script>

export default {
    data() {
        return {
            data: [],
            password: '',
            newPassword: '',
            repeatPassword: ''
        }
    },
    created() {
        this.getUser();
    },
    computed: {
        checkNewPassword() {
            return (this.newPassword == this.repeatPassword) && (this.newPassword != '' || this.repeatPassword != '')
        }
    },
    methods: {
        getUser() {
            axios.get(`/user/${this.$route.params.id}`)
            .then((response) => {
                this.data = response.data;
            })
        },
        save() {
            this.$validator.validateAll().then((result) => {
                if (!result) {	
                    return;
                }
                else {
                    var form = new FormData;
                    this.data.password = this.newPassword;
                    form.append('photo', this.$refs.file.files[0]);
                    form.append('data', JSON.stringify(this.data));
            
                        axios.post(`/user/${this.$route.params.id}`, form, {
                            headers: {
                            'Content-Type': 'multipart/form-data'
                            }
                        })
                        .then(() => {
                            swal("Дані збережено", {
                                icon: "success",
                            });
                        }).catch(() => {
                            swal({
                                icon: "error",
                                title: 'Помилка',
                                text: 'Не вдалося'
                            });
                        })
                    }
            })
        }
    }
}
</script>