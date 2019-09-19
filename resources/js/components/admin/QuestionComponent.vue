<template>
    <div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th width="7%">№</th>
                <th width="15%">Ім’я користувача</th>
                <th width="25%">Електронна адреса</th>
                <th width="30%">Текст питання</th>
                <th width="20%">Дата подання</th>
                <th></th>
            </tr>
            </thead>
            <tbody v-for="(item, index) in qInfo" :key="index">
            <tr>
                <td data-toggle="collapse" :data-target="'#collapse'+(index+1)">{{ index + 1 }}</td>
                <td class="editing-td" data-toggle="collapse" :data-target="'#collapse'+(index+1)">{{ item.name }}</td>
                <td class="editing-td" data-toggle="collapse" :data-target="'#collapse'+(index+1)">{{ item.email }}</td>
                <td class="editing-td" data-toggle="collapse" :data-target="'#collapse'+(index+1)">{{ item.question_text }}</td>
                <td class="editing-td" data-toggle="collapse" :data-target="'#collapse'+(index+1)">{{ item.created_at }}</td>
                <td id="del-td"><i class="fa fa-2x fa-times-circle btn btn-default p-0" @click="deleteQuestion(item.id, index)"></i></td>
            </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
	export default {
		data() {
			return {
				qInfo: [],
			};
		},
		created() {
			this.getQuestion();
		},
		methods: {
			getQuestion() {
				axios.get('/get-question')
					.then((response) => {
						this.qInfo.push(...response.data)
					})
			},
			deleteQuestion(id, index){
				axios.post('/delete-question/'+id)
					.then((response) => {
						if(response.status == 200) {
							this.qInfo.splice(index, 1);
						}
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