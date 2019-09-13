<template>

    <div>

        <div class="row">
            <div class="col-5">
                <label for="video" class="brtop">Посилання на відео (YouTube)</label>
                <input type="text" v-model="video" class="form-control" id="video">
                <button type="button" class="btn btn-outline-secondary mt-4 px-5" @click="postVideo">Додати</button>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-4" v-for="(item, index) in urls" :key="item.video_id">
                <div class="border fotoGallery">
                    <i class="fa fa-times-circle btn btn-default p-0" @click="delVideo(item.video_id, index)"></i>
                    <iframe width="100%" height="100%" :src="'https://www.youtube.com/embed/'+item.url.split('=')[1]" frameborder="0" allowfullscreen></iframe>
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
        }
    },
    created() {
        this.getVideo();
    },
    methods: {
        getVideo() {
            axios.get('/get-video')
            .then((response) => {
                this.urls = response.data;
            })
        },
        postVideo() {
            axios.post('/post-video', {url: this.video})
                .then(() => {
                    this.urls = [];
                    this.getVideo();
                })
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