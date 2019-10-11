<template>
    <div>
        <form role="form" class="search">
            <i class="fa fa-search" aria-hidden="true"></i>
            <input v-model="search" type="text" class="form-control">
        </form>
        <br> 
      <table class="table table-bordered accordion" id="accordion">
          <thead>
                <tr>
                    <th>№</th>
                    <th>ПІБ Учасника / Назва групи</th>
                    <th>Тип заявки</th>
                    <th width="30px"></th>
                    <th width="30px"></th>
                </tr>
          </thead>
          
          <tbody class="card" v-for="(item, index) in filteredList" :key="index">
                <tr>
                    <td data-toggle="collapse" :data-target="'#collapse'+(index+1)">
                        {{index+1}}
                    </td>
                    <td>{{ item.name }}</td>
                    <td>{{ item.type }}</td>
                    <td>
                        <a href="#" @click="unarchiveMember(item.id)"><i class="fa fa-2x fa-check-circle" aria-hidden="true"></i></a>                
                    <td>
                        <a href="#" @click="deleteMember(item.id)"><i class="fa fa-2x fa-trash" aria-hidden="true"></i></a>
                    </td>
                </tr>
                <tr id="collapse1" class="collapse "  data-parent="#accordion">
                    <td colspan="5" class="card-body">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                    </td>
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
            };
        },

        created () {
            this.getFullList();
        },
        computed: {
            filteredList() {
                return this.members.filter(members => {
                    return members.name.toLowerCase().includes(this.search.toLowerCase()) || members.type.toLowerCase().includes(this.search.toLowerCase())
                })
            }
        },
        methods: {
	        getFullList() {
		        axios.get('/get-members')
			        .then((response) => {
				        this.members = [];
				        response.data.forEach(member => {
					        if (member.solo_duet.length == 0 && member.status == "archive") {
						        this.members.push({
							        name: member.group.name,
							        type: member.app_type.name,
							        id: member.application_id
						        })
					        } else if (member.solo_duet.length == 1 && member.status == "archive") {
						        this.members.push({
							        name: `${member.solo_duet[0].name} ${member.solo_duet[0].surname} ${member.solo_duet[0].patronymic}`,
							        type: member.app_type.name,
							        id: member.application_id
						        })
					        } else if (member.solo_duet.length == 2 && member.status == "archive") {
						        this.members.push({
							        name: `${member.solo_duet[0].name} ${member.solo_duet[0].surname} ${member.solo_duet[0].patronymic}, ${member.solo_duet[1].name} ${member.solo_duet[1].surname} ${member.solo_duet[1].patronymic}`,
							        type: member.app_type.name,
							        id: member.application_id
						        })
					        }
				        });
			        })
	        },
	        unarchiveMember(id) {
		        axios.post('/unarchive-members/' + id)
			        .then((response) => {
				        if (response.status == 200) {
					        this.getFullList();
				        }
				        swal("Учасник був успішно повернений", {
					        icon: "success",
				        });

			        })
			        .catch((error) => {
				        swal({
					        icon: "error",
					        title: 'Помилка',
					        text: 'Не вдалося '
				        });
			        });
	        },
	        deleteMember(id) {
		        swal({
			        title: "Бажаєте видалити?",
			        text: "Після видалення ви не зможете відновити дану заяву",
			        icon: "warning",
			        buttons: true,
			        dangerMode: true,
		        })
			        .then((willDelete) => {
				        if (willDelete) {
					        axios.post('/delete-members/' + id)
						        .then((response) => {
							        if (response.status == 200) {
								        this.getFullList();
							        }
							        swal("Учасник був успішно видалений", {
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
			        })
	        }
        }
    }
</script>