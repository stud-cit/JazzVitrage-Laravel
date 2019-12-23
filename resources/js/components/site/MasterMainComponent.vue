<template>
    <div>
        <div class="bg">
            <section class="master_main">
                <b-container class="centering">
                    <b-col cols="12" md="12" sm="12" lg="9">
                        <div class="text_container">
                            <h2>Lorem ipsum dolor </h2>
                            <p>{{ info.description_master }}</p>
                        </div>
                    </b-col>
                </b-container>
            </section>
            <section class="master_galary">
                <b-container>
                    <b-col cols="12">
                          <b-carousel
                            id="carousel-fade"
                            style="text-shadow: 0px 0px 2px #000"
                            fade
                            indicators
                            img-width="1024"
                            img-height="480"
                        >
                            <b-carousel-slide
                            v-for="item in photo"
                            :key="item.foto_id"
                            caption=""
                            :img-src="'img/uploads/'+item.file"
                            ></b-carousel-slide>

                        </b-carousel>
                    </b-col>
                </b-container>
            </section>
            <section class="master_form">
                <b-container>
                    <b-col cols="12" sm="12" md="12" lg="8" class="center-block">
                        <form>
                            <input type="text" v-model="request.name" placeholder="Им'я" id="name" name="name" v-validate="{ required: true }">
                            <span class="errors" v-if="errors.has('name')">
                                Введіть корректні дані
                            </span>
                            <input type="text" v-model="request.phone" placeholder="Телефон" id="phone" name="phone" v-validate="{ required: true, regex: /^((\+380)(\d{9})|(\d{6,13}))$/ }">
                            <span class="errors" v-if="errors.has('phone')">
                                Введіть номер мобільного телефону у форматі +380 або стаціонарного телефону - від 6 до 13 символів (вводити лише цифри)
                            </span>
                            <input type="text" v-model="request.email" id="email" name="email" placeholder="Email" v-validate="{ regex: /^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/ }">
                            <span class="errors" v-if="errors.has('email')">
                                Введіть дані у форматі name@email.com
                            </span>
                            <input type="button" value="Надіслати" @click="sendRequest">
                        </form>
                    </b-col>
                </b-container>
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
                    phone: '',
                    email: ''
                }
            }
        },
        created() {
            this.getInfo();
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
			    axios.post('/api/master-request', this.request)
				    .then(() => {
						swal("Успішно відправлено", {
							icon: "success",
						});
				    })
            }
        },
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
        top: -20%;
        height: 150%;
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
    .text_container p{

    }
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
        padding-left: 30px;
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
            padding: 60px;
        }
    }
</style>
