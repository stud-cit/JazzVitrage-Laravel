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
                <tr :id="'collapse'+(index+1)" class="collapse" data-parent="#accordion">
                    <td colspan="5" class="card-body">
                        <div class="col-5">
                            <p>ПІП: {{ item.name }}</p>
                        </div>
                        <div class="col-2"></div>
                        <div class="col-5">
                            <p>Тип: {{ item.type }}</p>
                        </div>
                        <div class="mt-2"></div>
                        <div class="col-5">
                            <label for="memberDate" class="brtop">Дата народження</label>
                            <p id="memberDate">{{ item.memberDate }}</p>

                            <label for="memberIdCode" class="brtop">Ідентифікаційний номер учня</label>
                            <p id="memberIdCode">{{ item.idCode }}</p>

                            <label for="schoolName" class="brtop">Назва мистецького навчального закладу</label>
                            <p id="schoolName">{{ item.schoolName }}</p>

                            <label for="schoolContact" class="brtop">Адреса, телефон та e-mail навч. закладу</label>
                            <p id="schoolContact">{{ `${item.schoolAddress} + "/" ${item.schoolPhone} + "/" ${item.schoolEmail}` }}</p>

                            <label for="teacherDate" class="brtop">ПІП викладача</label>
                            <p id="teacherDate">{{ `${item.teacherSurname} ${item.teacherName} ${item.teacherPatronymic}` }}</p>

                            <label for="teacherPhone" class="brtop">Контактний телефон викладача</label>
                            <p id="teacherPhone">{{ item.teacherPhone }}</p>

                            <label for="concertDate" class="brtop">ПІП концертмейстра</label>
                            <p id="concertDate">{{ `${item.concertSurname} ${item.concertName} ${item.concertPatronymic}` }}</p>

                            <label class="brtop">Програма та хронометраж кожного твору</label>
                            <p>Перший твір</p>
                            <p>Назва: {{ item.compositionName }}</p>
                            <p>Автор: {{ item.compositionAuthor }}</p>
                            <p>Хронометраж: {{ item.compositionTiming }}</p>

                            <p>Другий твір</p>
                            <p>Назва: {{ item.compositionName2 }}</p>
                            <p>Автор: {{ item.compositionAuthor2 }}</p>
                            <p>Хронометраж: {{ item.compositionTiming2 }}</p>
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
            search: '',
        };
    },

    created () {
        this.getFullList();
    },
    computed: {
        filteredMembersList() {
            return this.members.filter(members => {
                return members.name.toLowerCase().includes(this.search.toLowerCase()) || members.type.toLowerCase().includes(this.search.toLowerCase())
            })
        },
    },
    methods: {
        getFullList(){
            axios.get('/get-members')
            .then((response) => {
                this.members = [];
                response.data.filter( app => {
                    return app.status =="created";
                }).forEach(member => {
                    if(member.solo_duet.length == 0) {
                        this.members.push({
                            surname: member.group.surname,
                            name: member.group.name,
                            patronymic: member.group.patronymic,
                            type: member.app_type.name,
	                        memberDate: member.group.memberDate,
	                        idCode: member.group.idCode,
	                        schoolName: member.group.schoolName,
	                        schoolAddress: member.group.schoolAddress,
	                        schoolPhone: member.group.schoolPhone,
	                        schoolEmail: member.group.schoolEmail,
	                        teacherSurname: member.group.teacherSurname,
	                        teacherName: member.group.teacherName,
	                        teacherPatronymic: member.group.teacherPatronymic,
	                        teacherPhone: member.group.teacherPhone,
	                        concertSurname: member.group.concertSurname,
	                        concertName: member.group.concertName,
	                        concertPatronymic: member.group.concertPatronymic,
	                        compositionName: member.group.compositionName,
	                        compositionAuthor: member.group.compositionAuthor,
	                        compositionTiming: member.group.compositionTiming,
	                        compositionName2: member.group.compositionName2,
	                        compositionAuthor2: member.group.compositionAuthor2,
	                        compositionTiming2: member.group.compositionTiming2,
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