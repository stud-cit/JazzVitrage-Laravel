<template>

    <footer class="footer">
        <div class="container">
            <p class="text-block"><a href="mailto:jazzsumy@email.com">jazzsumy@email.com</a></p>
            <p v-for="(item, index) in phones" :key="index" class="text-block"><a :href="'tel:'+item.contact">{{ item.contact }}</a></p>
            <p class="text-block">Created by StudCIT</p>
        </div>
    </footer>

</template>

<script>
    export default {
        data() {
            return {
                phones: []
            };
        },

        created () {
            this.getInfo();
        },
        computed: {

        },
        methods: {
            getInfo() {
                axios.get('/get-all-info')
                    .then((response) => {
                        this.phones = response.data.contact[1].contacts_items
                    })
            },
        },

    }
</script>
