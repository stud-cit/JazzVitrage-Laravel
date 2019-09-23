<template>
    <div>
        <section class="sections main-section gallery">
            <div class="container">
                <h2 class="title-section">Положення</h2>
                <div class="row">
                    
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
                    file: ''
                },
            };
        },
        created () {
            this.getInfo();
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