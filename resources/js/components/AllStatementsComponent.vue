<template>
    <div>
      <table class="table table-bordered">
      <thead>
            <tr>
                <th width="30px">№</th>
                <th>ПІБ Учасника / Назва групи</th>
                <th>Тип заявки</th>
            </tr>
      </thead>
      <tbody v-for="(item, index) in members">
            <tr>
                <td>{{ index + 1 }}</td>
                <td v-if="item.solo_duet">
                    <a href="/admin/evaluation">{{ item.solo_duet.name + ' ' + item.solo_duet.surname + ' ' + item.solo_duet.patronomic }}</a>
                </td>
                <td v-else>
                    <a href="/admin/evaluation">{{ item.group.name }}</a>
                </td>
                <td>{{ item.app_type.name }}</td>
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
        }
    },
    created() {
        this.getFullList();
    },
    methods: {
        getFullList() {
            axios.get('/get-all-members')
            .then((response) => {
                this.members = response.data;
            })
        }
    }
}
</script>