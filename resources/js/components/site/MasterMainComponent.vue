<template>
    <div>
        <div class="bg">
            <section class="master_main">
                <div class="container centering">
                    <div class="col-12 col-md-12 col-sm-12 col-lg-9">
                        <div class="text_container">
                            <h2>{{ info.title_master }}</h2>
                            <p>{{ info.description_master }}</p>
                        </div>
                    </div>
                </div>
            </section>
            <section class="master_galary">
                <div class="container">
                    <h3>{{ info.title_gallery_master }}</h3>
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" :data-slide-to="index" :class="index == 0 ? 'active' : ''" v-for="(item, index) in photo" :key="index"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div :class="index == 0 ? 'carousel-item active' : 'carousel-item'" v-for="(item, index) in photo" :key="index">
                                <img class="d-block w-100" :src="'/img/uploads/'+item.file">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                        </div>
                    </div>
            </section>
            <section class="master_form">
                <div class="container">
                    <div class="center-block col-12 col-sm-12 col-md-12 col-lg-8">
                        <h3>{{ info.title_req_master }}</h3>
                        <form>
                            <input type="text" v-model="request.name" placeholder="ФІО" id="name" name="name" v-validate="{ required: true }">
                            <span class="errors" v-if="errors.has('name')">
                                Введіть корректні дані
                            </span>

                            <input type="text" v-model="request.appointment" placeholder="Посада" id="appointment" name="appointment">

                            <input type="text" v-model="request.phone" placeholder="Телефон" id="phone" name="phone" v-validate="{ required: true, regex: /^((\+380)(\d{9})|(\d{6,13}))$/ }">
                            <span class="errors" v-if="errors.has('phone')">
                                Введіть номер мобільного телефону у форматі +380 або стаціонарного телефону - від 6 до 13 символів (вводити лише цифри)
                            </span>
                            <input type="text" v-model="request.email" id="email" name="email" placeholder="Email" v-validate="{ required: true, regex: /^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/ }">
                            <span class="errors" v-if="errors.has('email')">
                                Введіть дані у форматі name@email.com
                            </span>

                            <input type="text" v-model="request.sity" id="sity" name="sity" placeholder="Місто" v-validate="{ required: true }">
                            <span class="errors" v-if="errors.has('sity')">
                                Введіть корректні дані
                            </span>

                            <input type="text" v-model="request.school_name" id="school_name" name="school_name" placeholder="Назва школи" v-validate="{ required: true }">
                            <span class="errors" v-if="errors.has('school_name')">
                                Введіть корректні дані
                            </span>


                            <input type="button" value="Надіслати" @click="sendRequest">
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                info: {
                    logo: '',
                    text: ''
                },
                photo: [],
                request: {
                    name: '',
                    appointment: '',
                    phone: '',
                    email: '',
                    sity: '',
                    school_name: ''
                }
            }
        },
        created() {
            this.getInfo();
            document.title = "Майстер клас";
        },
        methods: {
            getInfo() {
			    axios.get('/api/info-master')
				    .then((response) => {
                        this.info = response.data.info;
                        this.photo = response.data.photo;
				    })
            },
            sendRequest() {
                this.$validator.validateAll().then((result) => {
                    if (!result) {

                        return
                    }
                    else {
                        axios.post('/api/master-request', this.request)
                            .then(() => {
                                swal("Успішно відправлено", {
                                    icon: "success",
                                });
                            }).catch((error) => {
                                swal({
                                    icon: "error",
                                    title: 'Помилка',
                                    text: 'Не вдалося'
                                });
                            });
                        }
                });
        }
    }
}
</script>

<style scoped>

    .bg{
        background-image: url('/img/master-bg.jpg');
        background-attachment: fixed;
    }
    .master_main{
        height: calc(100vh - 88px);
    }
    .text_container{
        background: linear-gradient(135deg, rgba(0,0,0,1) 0%, rgba(128,128,128,0.5) 100%);
        border-radius: 8px;
        padding: 100px;
        color: #fff;
        text-align: right;
        position: relative;
    }
    .text_container::before{
        content: '';
        position: absolute;
        left: -320px;
        top: -60%;
        height: 250%;
        width: 500px;
        background-image: url('/img/master-item.png');
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
    }
    .text_container h2{
        font-size: 60px;
        font-weight: 600;
        margin-bottom: 40px;
    }
    h3{
        font-size: 42px;
        font-weight: 700;
        margin-bottom: 30px;
        color: #fff;
        text-align: center;
    }
    /* .text_container p{

    } */
    .centering{
        display: flex;
        align-items: center;
        justify-content: flex-end;
        height: 100%;
    }
    .master_galary{
        margin-bottom: 120px;
    }
    /*3*/
    form{
        padding: 60px 100px;
        background: transparent linear-gradient(134deg, #00000070 0%, #80808070 100%) 0% 0% no-repeat padding-box;
        border-radius: 10px;
    }
    input[type="text"]{
        background: transparent linear-gradient(180deg, #FFFFFF 0%, #E4E4E4 91%, #808080 100%) 0% 0% no-repeat padding-box;
        border-radius: 10px;
        height: 60px;
        margin-bottom: 20px;
        border: none;
        outline: none;
        padding-left: 30px;
        color: #333;
        display: block;
        width: 100%;
    }
    input[type="button"]{
        background: transparent linear-gradient(180deg, #A24416 0%, #953E14 87%, #51220B 100%) 0% 0% no-repeat padding-box;
        border-radius: 10px;
        height: 60px;
        margin-top: 40px;
        border: none;
        outline: none;
        color: #fff;
        display: block;
        width: 100%;
    }
    .center-block {
        display: block;
        margin-right: auto;
        margin-left: auto;
    }
    .master_form{
        padding-bottom: 60px;
    }
    @media(max-width: 992px){
        .text_container::before{
            height: 100%;
            top: 0;
        }
    }
    @media(max-width: 767px){
        .master_main{
            height: auto;
            padding: 60px 0;
        }
        .text_container h2{
            font-size: 42px;
        }
        .text_container{
            padding: 30px;
        }
        form{
            padding: 30px 20px;
        }
        .master_form{
            padding-bottom: 120px;
        }
        .master_main{
            padding-top: 200px;
        }
        .master_galary{
            margin-bottom: 80px;
        }
    }
</style>
