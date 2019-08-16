<template>
    <div>
      <form role="form" class="search">
            <i class="fa fa-search" aria-hidden="true"></i>
            <input v-model="search" type="text" class="form-control">
      </form>
      <table class="table table-bordered">
      <thead>
            <tr>
                <th width="30px">№</th>
                <th>ПІБ Учасника / Назва групи</th>
                <th>Тип заявки</th>
                <th  width="30px"></th>
            </tr>
      </thead>
      <tbody v-for="(item, index) in filteredList">
            <tr>
                <td>{{ index + 1 }}</td>
                <td>{{ item.solo_duet ? item.solo_duet.name + ' ' + item.solo_duet.surname + ' ' + item.solo_duet.patronomic : item.group.name }}</td>
                <td>{{ item.app_type.name }}</td>
                <td><a href="#"><i class="fa fa-2x fa-times-circle" aria-hidden="true"></i></a></td>
            </tr>
      </tbody>
      </table>
    </div>
</template>

<script>
export default {
    data() {
        return {
            members: [],
            search: '',
        }
    },
    created() {
        this.getFullList();
    },
    computed: {
        filteredList() {
            return this.members.filter(members => {
                if(!members.group) {
                    return members.solo_duet.name.toLowerCase().includes(this.search.toLowerCase())
                } else {
                    return members.group.name.toLowerCase().includes(this.search.toLowerCase())
                }
            })
        }
    },
    methods: {
        getFullList() {
            axios.get('/get-all-members')
            .then((response) => {
                this.members = response.data;
            })
        }
    },
}
</script>