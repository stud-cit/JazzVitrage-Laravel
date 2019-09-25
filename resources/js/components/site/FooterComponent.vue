<template>

    <footer class="footer">
        <div class="container">
            <p class="text-block" v-for="item in emails" :key="item.contact_items_id">{{ item.contact }}</p>
            <p class="text-block" v-for="item in phones" :key="item.contact_items_id">{{ item.contact }}</p>
            <p class="text-block">Created by studCIT</p>
        </div>
    </footer>

</template>

<script>
    export default {
        data() {
            return {
                emails: [],
                phones: [],
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
                        this.phones = response.data.contact[1].contacts_items;
                        this.emails = response.data.contact[3].contacts_items;
                    })
            },
        },

    }
</script>