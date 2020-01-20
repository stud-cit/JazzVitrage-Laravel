<template>
    <div>
        <section class="sections main-section gymn">
            <div class="container">
                <div class="row align-items-stretch wrapper-gymn">

                    <pre class="col-12 col-lg-5 couplets"><h1>ГІМН</h1>{{ info.hymn_text }}</pre>

                    <div class="col-12 col-lg-7 media">
                        <div class="overflow">
                            <div class="scroll-img">
                                <img :src="info.note_image" alt="">
                            </div>
                        </div>
                        <div class="absolute-block">
                            <audio controls ref="player" class="audio">
                                <source :src="info.audio" type="audio/wav">
                            </audio>
                            <div class="text-center">
                                <a :href="info.audio" class="download" download="">ЗАВАНТАЖИТИ</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                info: {
                    hymn_text: '',
                    note_image: '',
                    audio: ''
                },
            };
        },
        created () {
            this.getInfo();
        },
        mounted () {
            this.$watch('info.audio', () => {
                this.$refs.player.load()
            })
        },
        methods: {
            getInfo() {
                axios.get('/get-all-info')
                    .then((response) => {
                        response.data.info.map(item => {
                            Object.assign(this.info, item);
                        });
                    })
            },
        },

    }
</script>
