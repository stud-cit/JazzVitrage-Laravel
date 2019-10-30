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
                    <div  class="nominations-items">

                            <img src="img/piano.png" alt="">
                            <div class="items-title">Інструментальний жанр</div>

                    </div>
                    <div  class="nominations-items">

                            <img src="img/microphone.png" alt="">
                            <div class="items-title">Вокальний жанр</div>

                    </div>
                    <div class="nominations-items">

                            <img src="img/nots.png" alt="">
                            <div class="items-title">Композиція</div>

                    </div>
                </div>
            </div>
        </section>

        <section class="sections position">
            <div class="container">
                <div class="row">
                    <div class="col-12 mb-5 d-xl-none">
                        <h2 class="title-section">Положення</h2>
                        <p class="subtitle">КОНКУРСУ</p>
                    </div>
                    <div class="col-lg-7 col-xl-7">
                        <iframe width="100%" height="100%" :src="'https://www.youtube.com/embed/'+info.video.slice(info.video.length - 11, info.video.length)" frameborder="0" allowfullscreen></iframe>
                    </div>
                    <div class="col-lg-5 col-xl-5">
                        <div class="d-none d-xl-block">
                            <h2 class="title-section">Положення</h2>
                            <p class="subtitle">КОНКУРСУ</p>
                        </div>
                        <p class="text">{{ info.provisions_text }}</p>

                        <div class="btn-group">
                            <a :href="info.file" target="_blank" class="btn btn-read">ЧИТАТИ ПОВНІСТЮ</a>
                            <a :href="info.file" class="btn btn-download" download="">ЗАВАНТАЖИТИ</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="sections gallery">
            <div class="container">
                <h2 class="title-section">ГАЛЕРЕЯ</h2>
                <div class="row">
                    <div class="col-12 col-sm-6 col-lg-4 gallery-item" v-for="item in foto.slice(0, 6)" :key="item.foto_id"><img :src="'/img/uploads/'+item.file" alt="" class="gallery-img"></div>
                </div>
                <div class="text-center">
                    <router-link :to="{name: 'gallery'}"><button class="archive">АРХІВ</button></router-link>
                </div>
            </div>
        </section>
        <section class="sections members">
            <div class="container">
                <h2 class="title-section">СПИСКИ УЧАСНИКІВ</h2>

                <table class="table-members">
                    <tr class="table-title">
                        <th>№</th>
                        <th>П.І.Б. /<br>
                            НАЗВА КОЛЕКТИВУ </th>
                        <th>АДРЕСА</th>
                        <th>НАЗВА ЗАКЛАДУ</th>
                        <th>ВИКЛАДАЧ</th>
                    </tr>
                    <tr v-for="item in paginatedData" :key="item.index">
                        <td>{{ item.index+1 }}</td>
                        <td>{{ item.name }}</td>
                        <td>{{ item.schoolAddress }}</td>
                        <td>{{ item.schoolName }}</td>
                        <td>{{ item.teacher }}</td>
                    </tr>
                    <tr class="search">
                        <td colspan="5">
                        <div class="search-block">
                            <input type="text" v-model="searchMember" placeholder="ПОШУК">
                            <select v-model="searchNomination" class="nomination">
                                <option value="" selected="selected">номінація</option>
                                <option v-for="(value, index) in nominations" :value="value.name" :key="index">{{ value.name }}</option>
                            </select>
                            <select v-model="ageCategory" class="category">
                                <option value="" selected="selected" >вік.категорія</option>
                                <option value="8-10">Від 8 до 10 років</option>
                                <option value="11-13">Від 11 до 13 років</option>
                                <option value="14-17">Від 14 до 17 років</option>
                            </select>
                            <button class="clean" @click="clean">Очистити</button>

                        </div>
                        <ul class="pagination">
                            <li class="controls active" v-if="pagination.pageNumber !== 0" @click="prevPage"><i class="fa fa-long-arrow-left" aria-hidden="true" v-if="pagination.pageNumber !== 0"></i></li>
                            <li>{{ pagination.pageNumber + 1 }} : {{ pageCount }}</li>
                            <li class="controls active" v-if="pagination.pageNumber <= pageCount -2" @click="nextPage"><i class="fa fa-long-arrow-right" aria-hidden="true" v-if="pagination.pageNumber <= pageCount -2"></i></li>
                        </ul>
                        </td>
                    </tr>
                </table>



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

                        <div id="carouselVideo" class="carousel slide col-xl-12" data-ride="carousel">
                            <h3 class="title-video">ВІДЕОГАЛЕРЕЯ</h3>
                            <p class="subtitle">КРАЩИХ РОБІТ</p>
                            <div class="carousel-inner">
                                <div :class="{'carousel-item': true, active: index < 1 } " v-for="(video, index) in videos" :key="index" >
                                    <div class="d-flex w-100">
                                        <iframe  :src="'https://www.youtube.com/embed/'+videos[index].url.slice(videos[index].url.length - 11, videos[index].url.length)" class="video active-video " frameborder="0" allowfullscreen></iframe>

                                    </div>
                                </div>

                            </div>
                            <a class="carousel-control-prev" href="#carouselVideo" role="button" data-slide="prev">
                                <div class="control-bg">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </div>
                            </a>
                            <a class="carousel-control-next" href="#carouselVideo" role="button" data-slide="next">
                                <div class="control-bg">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </div>
                            </a>
                            <div class="text-center"><router-link :to="{name: 'gallery-video'}"><button class="archive">АРХІВ</button></router-link></div>






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
                pagination : {
                    pageNumber: 0,
                    size: 4
                },
                ageCategory: '',
                members: [],
                nominations: [],
                searchMember: '',
                searchNomination: '',
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
            this.getNominations();
            this.getMembers();
        },
        computed: {
            filteredList() {
                return this.members.filter(members => {
                    return (
                    (this.ageCategory == '' || members.age >= this.ageCategory.split('-')[0] && members.age <= this.ageCategory.split('-')[1]) &&
                    (members.name.toLowerCase().includes(this.searchMember.toLowerCase()) || 
                    members.schoolAddress.toLowerCase().includes(this.searchMember.toLowerCase()) ||
                    members.schoolName.toLowerCase().includes(this.searchMember.toLowerCase())) &&
                    members.nomination.includes(this.searchNomination))
                })
            },
            paginatedData(){
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
            getNominations() {
                axios.get('/get-nominations')
                .then((response) => {
                    this.nominations = response.data;
                })
            },
            getMembers() {
                axios.get('/get-approved-members')
                .then((response) => {
                    response.data.forEach((member, index) => {

                        if(member.solo_duet.length == 0) {

                            this.members.push({
                                index,
                                age: member.group.average_age,
                                name: member.group.name, 
                                schoolAddress: member.preparation.school_address,
                                schoolName: member.preparation.school_one,
                                teacher: `${member.preparation.teacher_surname} ${member.preparation.teacher_name} ${member.preparation.teacher_patronymic}`,
                                nomination: member.nomination.name
                            })
                        }
                        else if(member.solo_duet.length == 1) {
                            this.members.push({
                                index,
                                age: this.getAge(member.solo_duet[0].data_birthday),
                                name: `${member.solo_duet[0].surname} ${member.solo_duet[0].name} ${member.solo_duet[0].patronymic}`,
                                schoolAddress: member.preparation.school_address,
                                schoolName: member.preparation.school_one,
                                teacher: `${member.preparation.teacher_surname} ${member.preparation.teacher_name} ${member.preparation.teacher_patronymic}`,
                                nomination: member.nomination.name
                            })
                        }
                        else if(member.solo_duet.length == 2) {
                            this.members.push({
                                index,
                                age: (this.getAge(member.solo_duet[0].data_birthday) + this.getAge(member.solo_duet[1].data_birthday)) / 2,
                                name: `${member.solo_duet[0].surname} ${member.solo_duet[0].name} ${member.solo_duet[0].patronymic}, ${member.solo_duet[1].surname} ${member.solo_duet[1].name} ${member.solo_duet[1].patronymic}`,
                                schoolAddress: member.preparation.school_address,
                                schoolName: member.preparation.school_one,
                                teacher: `${member.preparation.teacher_surname} ${member.preparation.teacher_name} ${member.preparation.teacher_patronymic}`,
                                nomination: member.nomination.name
                            });
                        }
                    });
                });
            },

            getAge(dateString) {
                var today = new Date();
                var birthDate = new Date(dateString);
                var age = today.getFullYear() - birthDate.getFullYear();
                var m = today.getMonth() - birthDate.getMonth();
                if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }
                return age;
            },

            clean() {
                this.searchMember = '',
                this.searchNomination = ''
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