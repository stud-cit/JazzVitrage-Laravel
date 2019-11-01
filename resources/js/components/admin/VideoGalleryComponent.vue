<template>

    <div>

        <div class="row">
            <div class="col-6">
                <div>
                <label for="video" class="brtop">Посилання на відео (YouTube)</label>
                    <input type="text" v-validate="{regex: /(?:https?:\/\/)?(?:www\.)?youtu\.?be(?:\.com)?\/?.*(?:watch|embed)?(?:.*v=|v\/|\/)([\w\-_]+)\&?/}" ref="video" name="video" v-model="video" class="form-control" id="video">
                    <span class="text-danger" v-if="errors.has('video')">Некоректне посилання</span>
                </div>
                <button type="button" :disabled="errors.has('video')" class="btn btn-outline-secondary mt-4 px-5" @click="postVideo">Додати</button>
                
            </div>
            <div class="col-6">
                <label for="yearCompetition" class="brtop">Рік проведення конкурсу</label>
                <select class="form-control" v-model="yearCompetition" id="yearCompetition">
                    <option v-for="(year, index) in years" :key="index" :value="year">{{ year }}</option>
                </select>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-4" v-for="(item, index) in urls" :key="item.video_id">
                <div class="border fotoGallery">
                    <i class="fa fa-times-circle btn btn-default p-0" @click="delVideo(item.video_id, index)"></i>
                    <iframe width="100%" height="100%" :src="'https://www.youtube.com/embed/'+item.url.slice(item.url.length - 11, item.url.length)" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>

    </div>

</template>

<script>
export default {
    data() {
        return {
            video: '',
            urls: [],
            yearCompetition: new Date().getFullYear()
        }
    },
    created() {
        this.getVideo();
    },
    computed: {
        years() {
            const year = new Date().getFullYear();
            return Array.from({length: year - 2000}, (value, index) => 2001 + index);
        }
    },
    methods: {
        getVideo() {
            axios.get('/get-video')
            .then((response) => {
                this.urls = response.data;
            })
        },
        postVideo() {
            this.$validator.validateAll().then((result) => {
                if (!result) {	
                    return;
                }
                else {
                    axios.post('/post-video', {
                            url: this.video,
                            year: this.yearCompetition
                        }).then(() => {
                            this.urls = [];
                            this.getVideo();
                           
		                swal("Файл завантажено", {
			            icon: "success",
			            timer: 1000,
			            button: false
		            });
	            })
	            .catch((error) => {
		            swal({
			            icon: "error",
			            title: 'Помилка',
			            text: 'Файл не обрано'
		            });
                        })
                }
            });
        },
        delVideo(id, index) {
            swal({
                title: "Бажаєте видалити?",
                text: "Після видалення ви не зможете відновити цей файл!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    axios.post('/delete-video/'+id)
                    .then(() => {
                        this.urls.splice(index, 1);
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