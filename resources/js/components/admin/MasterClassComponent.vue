<template>
    <div>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th width="10px" scope="col">№</th>
					<th scope="col">Ім'я</th>
					<th scope="col">Посада</th>
					<th scope="col">Телефон</th>
					<th scope="col">Електронна пошта</th>
                    <th scope="col">Місто</th>
                    <th scope="col">Назва школи</th>
					<th width="10px" scope="col"></th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="(item, index) in masterRequest" :key="item.id">
					<th scope="row">{{ index + 1 }}</th>
					<td>{{ item.name }}</td>
					<td>{{ item.appointment }}</td>
					<td>{{ item.phone }}</td>
					<td>{{ item.email }}</td>
                    <td>{{ item.sity }}</td>
                    <td>{{ item.school_name }}</td>
					<td><i class="fa fa-2x fa-times-circle btn btn-default p-0" @click="deleteQuestion(item.id, index)"></i></td>
				</tr>
			</tbody>
		</table>
    </div>
</template>
<script>
	export default {
		data() {
			return {
				masterRequest: [],
			};
		},
		created() {
			this.getRequest();
		},
		methods: {
			getRequest() {
				axios.get('/api/master-request')
					.then((response) => {
						this.masterRequest = response.data
					})
			},
			deleteQuestion(id, index){
				axios.delete('/api/master-request/'+id)
					.then((response) => {
						this.masterRequest.splice(index, 1);
						swal("Питання успішно видалене", {
							icon: "success",
						});
					})
					.catch((error) => {
						swal({
							icon: "error",
							title: 'Помилка',
							text: 'Не вдалося'
						});
					});
			}
        },
	}
</script>
