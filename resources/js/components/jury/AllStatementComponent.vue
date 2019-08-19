<template>
    <div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Example</th>
                <th>Example</th>
                <th>Example</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><router-link :to="{ path: '/admin/all-statements/evaluation/1' }">evaluation</router-link></td>
                <td>Example</td>
                <td>Example</td>
            </tr>
            </tbody>
        </table>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                // members: [],
                // search: '',
            }
        },
        // created() {
        //     this.getFullList();
        // },
        // computed: {
        //     filteredList() {
        //         return this.members.filter(members => {
        //             if(!members.group) {
        //                 return members.solo_duet.name.toLowerCase().includes(this.search.toLowerCase())
        //             } else {
        //                 return members.group.name.toLowerCase().includes(this.search.toLowerCase())
        //             }
        //         })
        //     }
        // },
        // methods: {
        //     getFullList() {
        //         axios.get('/get-all-members')
        //             .then((response) => {
        //                 this.members = response.data;
        //             })
        //     },
        //     archiveMember(event){
        //         const id =  event.target.getAttribute('data-value');
        //         axios.post('/archive-members/'+id)
        //             .then((response) => {
        //                 if(response.status == 200) {
        //                     this.getFullList();
        //                 }
        //             })
        //     }
        // },
    }
</script>