<template>
<div class="container bootstrap snippet">
    <div class="row">
  	    <div class="col-sm-4">
            <div class="text-center">
                <img v-if="data.photo" :src="'/img/user-photo/' + data.photo" class="avatar img-circle img-thumbnail" alt="avatar">
                <img v-else :src="'/img/user.png'" class="avatar img-circle img-thumbnail" alt="avatar">
                <h6>Завантажити інше фото...</h6>
                <input type="file" id="foto" ref="file" class="text-center center-block file-upload ml-2">
            </div>
            <br/>
            <ul class="list-group">
                <li class="list-group-item text-muted">Діяльність</li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Роль</strong></span> {{ data.role }}</li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Звання </strong></span> {{ data.rank }}</li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Номінація</strong></span> {{ data.nominations }}</li>
            </ul> 
        </div>

    	<div class="col-sm-8">
          <div class="tab-content">
            <div class="tab-pane active" id="home">
                <form class="form" id="registrationForm">
                    <div class="row">
                        <div class="form-group">
                            <div class="col-8">
                                <label for="name"><h4>Ім'я</h4></label>
                                <input type="text" class="form-control" name="name" id="name" v-model="data.name">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-8">
                                <label for="surname"><h4>Фамілія</h4></label>
                                <input type="text" class="form-control" name="surname" id="surname" v-model="data.surname">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-8">
                                <label for="patronymic"><h4>Прізвище</h4></label>
                                <input type="text" class="form-control" name="patronymic" id="patronymic" v-model="data.patronymic">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-8">
                                <label for="email"><h4>Email</h4></label>
                                <input type="email" class="form-control" name="email" id="email" v-model="data.email">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-8">
                                <label for="info"><h4>Біографія</h4></label>
                                <textarea class="form-control" id="info" name="info" rows="3" v-model="data.informations"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-8">
                                <label for="oldPassword"><h4>Старий пароль</h4></label>
                                <input type="password" class="form-control" name="oldPassword" id="oldPassword" @blur="checkPassword" v-model="password">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-8">
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
                                <button :disabled="!checkNewPassword" class="btn btn-lg btn-success" type="button" @click="save"><i class="glyphicon glyphicon-ok-sign"></i> Зберегти</button>
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
            var form = new FormData;
            this.data.password = this.newPassword;
            form.append('photo', this.$refs.file.files[0]);
            form.append('data', JSON.stringify(this.data));
            axios.post(`/user/${this.$route.params.id}`, form, {
                headers: {
                'Content-Type': 'multipart/form-data'
                }
            })
            .then((response) => {
                //
            })
        },
        checkPassword() {
            axios.post(`/check-passwrod-user/${this.$route.params.id}`, {
                password: this.password
            })
            .then((response) => {
                //
            })
        }
    }
}
</script>