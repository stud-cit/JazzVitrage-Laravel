<template>
    <div>
      <form role="form" class="search">
            <i class="fa fa-search" aria-hidden="true"></i>
            <input v-model="search" type="text" class="form-control">
      </form>
      <table class="table table-bordered accordion" id="accordion">
          <thead>
                <tr>
                    
                    <th>#</th>
                    <th>ПІБ Учасника</th>
                    <th>Тип Заявки</th>
                    
                    <th width="30px"></th>
                    <th width="30px"></th>
                </tr>
          </thead>
          
          <tbody class="card" v-for="(item, index) in filteredMembersList">
                <tr>
                    <td data-toggle="collapse" :data-target="'#collapse'+(index+1)">
                        {{index+1}}
                    </td>
                    <td data-toggle="collapse" :data-target="'#collapse'+(index+1)">
                        {{ item.name }}
                    </td>
                    <td data-toggle="collapse" :data-target="'#collapse'+(index+1)">
                       {{ item.type }}
                    </td>
                    <td>
                        <i class="fa fa-2x fa-check-circle btn btn-default p-0"></i>
                                           
                    <td>

                        <i class="fa fa-2x fa-times-circle btn btn-default p-0"  @click="archiveMember(item.id)"></i>
                    </td>
                </tr>
                <tr :id="'collapse'+(index+1)" class="collapse "  data-parent="#accordion">
                    <td class="card-body" v-for="(item, index) in filteredMemberList" :key="index">
                        <div class="row">
                            <div class="col-5">
                                <p><bold>ПІП:</bold> {{ `${item.name} ${item.surname} ${item.patronymic}` }}</p>
                            </div>
                            <div class="col-2"></div>
                            <div class="col-5">
                                <p><bold>Тип:</bold> {{ item.type }}</p>
                            </div>
                            <div class="mt-2"></div>
                            <div class="col-5">
                                <label for="memberDate" class="brtop">Дата народження</label>
                                <p id="memberDate" class="form-control">{{ item.memberDate }}</p>

                                <label for="memberIdCode" class="brtop">Ідентифікаційний номер учня</label>
                                <p id="memberIdCode" class="form-control">{{ item.idCode }}</p>

                                <label for="schoolName" class="brtop">Назва мистецького навчального закладу</label>
                                <p id="schoolName" class="form-control">{{ item.schoolName }}</p>

                                <label for="schoolContact" class="brtop">Адреса, телефон та e-mail навч. закладу</label>
                                <p id="schoolContact" class="form-control">{{ `${item.schoolAddress} + "/" ${item.schoolPhone} + "/" ${item.schoolEmail}` }}</p>

                                <label for="teacherDate" class="brtop">ПІП викладача</label>
                                <p id="teacherDate" class="form-control">{{ `${item.teacherSurname} ${item.teacherName} ${item.teacherPatronymic}` }}</p>

                                <label for="teacherPhone" class="brtop">Контактний телефон викладача</label>
                                <p id="teacherPhone" class="form-control">{{ item.teacherPhone }}</p>

                                <label for="concertDate" class="brtop">ПІП концертмейстра</label>
                                <p id="concertDate" class="form-control">{{ `${item.concertSurname} ${item.concertName} ${item.concertPatronymic}` }}</p>

                                <label class="brtop">Програма та хронометраж кожного твору</label>
                                <p><bold>Перший твір</bold></p>
                                <p><bold>Назва:</bold> {{ item.compositionName }}</p>
                                <p><bold>Автор:</bold> {{ item.compositionAuthor }}</p>
                                <p><bold>Хронометраж:</bold> {{ item.compositionTiming }}</p>

                                <p><bold>Другий твір</bold></p>
                                <p><bold>Назва:</bold> {{ item.compositionName2 }}</p>
                                <p><bold>Автор:</bold> {{ item.compositionAuthor2 }}</p>
                                <p><bold>Хронометраж:</bold> {{ item.compositionTiming2 }}</p>
                            </div>
                        </div>
                      
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
            keywords: null,
            results: [],
            members: [],
	        member: [],
            search: '',
        };
    },

    created () {
        this.getFullList();
	    this.getMember();
    },
    computed: {
        filteredMembersList() {
            return this.members.filter(members => {
                return members.name.toLowerCase().includes(this.search.toLowerCase()) || members.type.toLowerCase().includes(this.search.toLowerCase())
            })
        },
        filteredMemberList() {
	        return this.member.filter(member => {
		        return member.name.toLowerCase()
	        })
        }
    },
    methods: {
	    getMember(){
	    	axios.get('/get-member')
                .then((response) => {
                	this.member = [];
                	response.data.filter( app => {
		                return app.status =="created";
	                }).forEach(m => {
	                    if(m.solo_duet.length == 0) {
		                    this.member.push({
			                    name: m.group.name,
			                    type: m.app_type.name,
			                    id: m.application_id
		                    })
	                    }
	                    else if(m.solo_duet.length == 1) {
		                    this.member.push({
			                    name: `${m.solo_duet[0].name} ${m.solo_duet[0].surname} ${m.solo_duet[0].patronymic}`,
			                    type: m.app_type.name,
			                    id: m.application_id
		                    })
	                    }
	                    else if(m.solo_duet.length == 2) {
		                    this.member.push({
			                    name: `${m.solo_duet[0].name} ${m.solo_duet[0].surname} ${m.solo_duet[0].patronymic}, ${m.solo_duet[1].name} ${m.solo_duet[1].surname} ${m.solo_duet[1].patronymic}`,
			                    type: m.app_type.name,
			                    id: m.application_id
		                    })
	                    }
                    });
                })
        },
        getFullList(){
            axios.get('/get-members')
            .then((response) => {
                this.members = [];
                response.data.filter( app => {
                    return app.status =="created";
                }).forEach(member => {
                    if(member.solo_duet.length == 0) {
                        this.members.push({
                            name: member.group.name,
                            type: member.app_type.name,
                            id: member.application_id
                        })
                    }
                    else if(member.solo_duet.length == 1) {
                        this.members.push({
                            name: `${member.solo_duet[0].name} ${member.solo_duet[0].surname} ${member.solo_duet[0].patronymic}`,
                            type: member.app_type.name,
                            id: member.application_id
                        })
                    }
                    else if(member.solo_duet.length == 2) {
                        this.members.push({
                            name: `${member.solo_duet[0].name} ${member.solo_duet[0].surname} ${member.solo_duet[0].patronymic}, ${member.solo_duet[1].name} ${member.solo_duet[1].surname} ${member.solo_duet[1].patronymic}`,
                            type: member.app_type.name,
                            id: member.application_id
                        })
                    }
                });
            })
            .catch((error) => {
                swal({
                    icon: "error",
                    title: 'Помилка',
                    text: error.response.status
                });
            });
        },
        archiveMember(id){
            axios.post('/archive-members/'+id)
                .then((response) => {
                    if(response.status == 200 ) {
                        this.getFullList();
                    }
                    swal("Запис був успішно доданий до архіву", {
                        icon: "success",
                    });

                })
                .catch((error) => {
                    swal({
                        icon: "error",
                        title: 'Помилка',
                        text: 'Не вдалося додати заяву до архіву'
                    });
                });
        }
    }
}
</script>