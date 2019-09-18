<template>
    <div>
        <section class="main-section preview">
            <div class="top-layout">
                <div class="container">
                    <div class="row">
                        <div class="col-7">
                            <img :src="info.logo" width="70%" class="preview-logo">
                            <p class="preview-text">{{ info.description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="sections nominations">
            <div class="container">
                <div class="title-nominations">
                    <img src="img/ribbon.png" alt="">
                    <div class="text">
                        <h2 class="title">НОМІНАЦІЇ</h2>
                        <p class="subtitle">У КОНКУРСІ</p>
                    </div>


                </div>
                <div class="nominations-list">
                    <a href="" class="nominations-items">

                            <img src="img/piano.png" alt="">
                            <div class="items-title">Вокальний жанр</div>

                    </a>
                    <a href="" class="nominations-items">

                            <img src="img/microphone.png" alt="">
                            <div class="items-title">Вокальний жанр</div>

                    </a>
                    <a href="" class="nominations-items">

                            <img src="img/nots.png" alt="">
                            <div class="items-title">Вокальний жанр</div>

                    </a>
                </div>
            </div>
        </section>

        <section class="sections position">
            <div class="container">
                <div class="row">
                    <div class="col-xl-7">
                        <iframe width="100%" height="100%" :src="'https://www.youtube.com/embed/'+info.video.slice(info.video.length - 11, info.video.length)" frameborder="0" allowfullscreen></iframe>
                    </div>
                    <div class="col-xl-5">
                        <h2 class="title-section">Положення</h2>
                        <p class="subtitle">КОНКУРСУ</p>
                        <p class="text">{{ info.provisions_text }}</p>
                        <div class="btn-group">
                            <button class="btn btn-read">ЧИТАТИ ПОВНІСТЮ</button>
                            <button class="btn btn-download">ЗАВАНТАЖИТИ</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="sections gallery">
            <div class="container">
                <h2 class="title-section">ГАЛЕРЕЯ</h2>
                <div class="row" v-for="item in foto" :key="item.foto_id">
                    <div class="col-xl-4 gallery-item"><img :src="'/img/uploads/'+item.file" alt="" class="gallery-img"></div>
                </div>
                <div class="text-center">
                    <button class="archive">АРХІВ</button>
                </div>
            </div>
        </section>
        <section class="sections members">
            <div class="container">
                <h2 class="title-section">СПИСКИ УЧАСНИКІВ</h2>

                <table class="table-members">
                    <tr class="table-title">
                        <th>N</th>
                        <th>П.І.Б. /<br>
                            НАЗВА КОЛЕКТИВУ </th>
                        <th>Місто</th>
                        <th>НАЗВА ЗАКЛАДУ</th>
                        <th>ВИКЛАДАЧ</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>2</td>
                        <td>3</td>
                        <td>4</td>
                        <td>5</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>2</td>
                        <td>3</td>
                        <td>4</td>
                        <td>5</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>2</td>
                        <td>3</td>
                        <td>4</td>
                        <td>5</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>2</td>
                        <td>3</td>
                        <td>4</td>
                        <td>5</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>2</td>
                        <td>3</td>
                        <td>4</td>
                        <td>5</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>2</td>
                        <td>3</td>
                        <td>4</td>
                        <td>5</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>2</td>
                        <td>3</td>
                        <td>4</td>
                        <td>5</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>2</td>
                        <td>3</td>
                        <td>4</td>
                        <td>5</td>
                    </tr>
                </table>
                <div class="search-block">
                    <input type="text" placeholder="ПОШУК">
                    <select name=""  class="nomination">
                        <option value="" selected="selected" >номінація</option>
                        <option value="1">1</option>
                    </select>
                    <select name=""  class="category">
                        <option value="" selected="selected" >вік.категорія</option>
                        <option value="1">вік.категорія1</option>
                    </select>
                    <button class="clean">Очистити</button>

                </div>
                <ul class="pagination">
                    <li class="controls"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></li>
                    <li>1 : 16</li>
                    <li class="controls active"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></li>
                </ul>
            </div>

        </section>
        <section class="sections video-gallery">
            <div class="container">
                <div id="carousel-text" class="carousel slide" data-ride="carousel">
                    <img src="img/carousel-img.png" alt="" class="carousel-img">
                    <ol class="carousel-indicators">
                        <li v-for="(item, index) in quotes" :key="'slide'+index" data-target="#carousel-text" :data-slide-to="index" :class="index == 0 ? 'active' : ''"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div v-for="(item, index) in quotes" :key="item.quote_id" :class="index == 0 ? 'carousel-item active' : 'carousel-item'">
                            {{ item.text }}
                        </div>
                    </div>

                </div>
                <div class="gallery-content">
                    <div class="row">
                        <div class="col-xl-3">
                            <h3 class="title-video">ВІДЕОГАЛЕРЕЯ</h3>
                            <p class="subtitle">КРАЩИХ РОБІТ</p>
                            <ul class="pagination">
                                <li class="controls"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></li>
                                <li>1 : {{ videos.length }}</li>
                                <li class="controls active"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></li>
                            </ul>
                            <button class="archive">АРХІВ</button>
                        </div>
                        <div class="col-xl-5 d-flex align-items-end" v-for="(video, index) in videos" :key="index">
                            <iframe width="440" height="302" :src="'https://www.youtube.com/embed/'+video.url.slice(video.url.length - 11, video.url.length)" class="video active-video" frameborder="0" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="sections contacts">
            <div class="left-layer">
                <img src="img/contacts-layer.png" alt="">
                <div class="text-layer">
                    <div class="text-row">
                        <p class="title-field">Адреса: </p>
                        <p class="text-field" v-for="item in contact.address" :key="item.contact_items_id">{{ item.contact }}</p>
                    </div>
                    <div class="text-row">
                        <p class="title-field">Телефон: </p>
                        <p class="text-field" v-for="item in contact.phones" :key="item.contact_items_id">{{ item.contact }}</p>
                    </div>
                    <div class="text-row">
                        <p class="title-field">Соц. мережі: </p>
                        <p class="text-field text-light" v-for="item in contact.socials" :key="item.contact_items_id"><a :href="item.contact">{{ item.contact_title }}</a></p>
                    </div>
                </div>
            </div>
            <div class="right-layer">
                <h2 class="contacts-title">У ВАС Є ПИТАННЯ?</h2>
                <p class="subtitle">ЗАПОВНІТЬ ФОРМУ НИЖЧЕ</p>
                <form enctype="multipart/form-data" class="contacts-form">
                    <div class="form-row">
                        <span><i class="fa fa-2x fa-user" aria-hidden="true"></i></span>
                        <input type="text" v-model="name" id="name" placeholder="ВАШЕ ІМ'Я">
                    </div>
                    <div class="form-row">
                        <span><i class="fa fa-2x fa-envelope" aria-hidden="true"></i></span>
                        <input type="email" v-model="email" id="email" placeholder="ПОШТА">
                    </div>
                    <div class="form-row">
                        <textarea name="" v-model="questionText" id="question" cols="30" rows="6"></textarea>
                    </div>
                    <div class="text-center">
                        <button type="button" class="submit" @click="postQuestion">НАДІСЛАТИ</button>
                    </div>
                </form>
            </div>
        </section>

    </div>
</template>

<script>

    export default {
        data() {
            return {
                info: {
                    logo: '',
                    description: '',
                    provisions_text: '',
                    video: ''
                },
                contact: {
                    emails: [],
                    address: [],
                    phones: [],
                    socials: []
                },
                foto: [],
                videos: [],
                quotes: [],
                name: '',
                email: '',
	            questionText: '',
	            form: new FormData
            };
        },

        created () {
            this.getInfo();
            this.getFoto();
            this.getVideo();
            this.getQuotes();
        },
        computed: {

        },
        methods: {
            getInfo() {
                axios.get('/get-all-info')
                    .then((response) => {
                        response.data.info.map(item => {
                            Object.assign(this.info, item);
                        });
                        response.data.contact.map(item => {
                            Object.assign(this.contact[item.caption], item.contacts_items);
                        });
                    })
            },
            getFoto() {
                axios.get('/get-foto')
                .then((response) => {
                    this.foto = response.data;
                })
            },
            getVideo() {
                axios.get('/get-video')
                .then((response) => {
                    this.videos = response.data;
                })
            },
            getQuotes() {
                axios.get('/get-quotes')
                .then((response) => {
                    this.quotes = response.data;
                })
            },
	        postQuestion() {
		        this.form.append('name', this.name);
		        this.form.append('email', this.email);
		        this.form.append('question_text', this.questionText);

		        axios.post('/post-question', this.form)
			        .then((response) => {
				        if(response.status == 200) {
					        swal("Питання буде розглядено в найближчий термін", {
						        icon: "success",
					        });
				        }
			        })
			        .catch((error) => {
				        swal({
					        icon: "error",
					        title: 'Помилка',
					        text: 'Не вдалося'
				        });
			        });
            },
            nextSlide(event){

                // const container = document.getElementById('carousel-video');
                console.log(event);
                // const activeEl = container.querySelector('.active');
                // if(activeEl.nextSibling) {
                //     const nextEl = activeEl.nextSibling;
                // }
                // else {
                //     const nextEl = container.firstChild;
                // }
                // console.log(nextEl);
            }

        },


    }
</script>