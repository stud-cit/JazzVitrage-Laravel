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
                <td>
                    <router-link :to="{ name: 'jury-evaluation', params: {id: item.application_id} }">{{ item.solo_duet ? item.solo_duet.name + ' ' + item.solo_duet.surname + ' ' + item.solo_duet.patronomic : item.group.name }}</router-link>
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