<template>
    <div>
        <input type="text" v-model="keywords">
        <ul v-if="results.length > 0">
            <li v-for="result in results" :key="result.id" v-text="result.name"></li>
        </ul>
    </div>
</template>

<script>
export default {
    data() {
        return {
            keywords: null,
            results: []
        };
    },

    watch: {
        keywords(after, before) {
            this.fetch();
        }
    },

    methods: {
        fetch() {
            axios.get('/api/search', { params: { keywords: this.keywords } })
                .then(response => this.results = reponse.data)
                .catch(error => {});
        }
    }
}
</script>