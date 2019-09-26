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
      <tbody v-for="(item, index) in members" :key="index">
            <tr>

                <td>{{ index + 1 }}</td>
                <td v-if="item.solo_duet.length == 0">
                    <router-link :to="{ name: 'jury-evaluation', params: {id: item.application_id} }">{{ item.group.name }}</router-link>
                </td>
                <td v-if="item.solo_duet.length == 1">
                    <router-link :to="{ name: 'jury-evaluation', params: {id: item.application_id} }">{{ `${item.solo_duet[0].name} ${item.solo_duet[0].surname} ${item.solo_duet[0].patronomic}` }}</router-link>
                </td>
                <td v-if="item.solo_duet.length == 2">
                    <router-link :to="{ name: 'jury-evaluation', params: {id: item.application_id} }">{{ `${item.solo_duet[0].name} ${item.solo_duet[0].surname} ${item.solo_duet[0].patronomic}` }}, <br> {{ `${item.solo_duet[1].name} ${item.solo_duet[1].surname} ${item.solo_duet[1].patronomic}` }}</router-link>
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
                members: '',
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