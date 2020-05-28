<template>
    <div>
      <table class="table table-bordered">
      <thead>
            <tr>
                <th width="30px">№</th>
                <th>ПІБ Учасника / Назва групи</th>
                <th>Тип заявки</th>
                <th>Номінація</th>
                <th>Оцінка</th>
            </tr>
      </thead>
      <tbody v-for="(item, index) in members" :key="index">

            <tr v-if="item && item.status == 'approved'">


                <td>{{ index + 1 }}</td>
                <td v-if="item.solo_duet.length == 0">
                    <router-link :to="{ name: 'jury-evaluation', params: {id: item.application_id} }">{{ item.group.name }}</router-link>
                </td>
                <td v-if="item.solo_duet.length == 1">
                    <router-link :to="{ name: 'jury-evaluation', params: {id: item.application_id} }">{{ `${item.solo_duet[0].surname} ${item.solo_duet[0].name} ${item.solo_duet[0].patronymic}` }}</router-link>
                </td>
                <td v-if="item.solo_duet.length == 2">
                    <router-link :to="{ name: 'jury-evaluation', params: {id: item.application_id} }">{{ `${item.solo_duet[0].surname} ${item.solo_duet[0].name} ${item.solo_duet[0].patronymic}` }}, <br> {{ `${item.solo_duet[1].surname} ${item.solo_duet[1].name} ${item.solo_duet[1].patronymic}` }}</router-link>
                </td>
                <td>{{ item.app_type.name }}</td>
                <td>{{ item.nomination.name }}</td>
                <td>{{ userJury.role == 'jury' ? (item.evaluations[0] ? item.evaluations[0].evaluation : "") : item.rating }}</td>
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
                userJury: {},
            }
        },
        created() {
            this.getUserJury();
        },
        methods: {
			getUserJury() {
				axios.get('/get-user-jury')
					.then((response) => {
                        this.userJury = response.data;
                        if(this.userJury.role == 'jury') {
                            this.getFullListJury();
                        } else {
                            this.getFullList();
                        }
                    })
            },
            getFullListJury() {
                axios.get('/get-all-members')
                    .then((response) => {
                        this.members = response.data.map(item => {
                            item.evaluations = item.evaluations.filter(evaluation => {
                                return evaluation.user_id == this.userJury.user_id
                            })
                            return item
                        })
                    })
            },
            getFullList() {
                axios.get('/get-all-members')
                    .then((response) => {
                        this.members = response.data
                    })
            },
        }
    }
</script>
