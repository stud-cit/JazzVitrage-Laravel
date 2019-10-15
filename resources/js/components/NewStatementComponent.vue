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
                            <p v-if="item.type == 'соліст' || item.type == 'дует'"><strong>ПІП:</strong> {{ item.name }}</p>
                            <p v-else><strong>Назва колективу:</strong> {{ item.name }}</p>
                        </div>
                        <div class="col-5 type-style">
                            <p><strong>Тип:</strong> {{ item.type }}</p>
                        </div>
                        <div class="mt-2"></div>
                        <div class="col-5">
                            <label for="memberDate" class="brtop" v-if="item.type == 'соліст' || item.type == 'дует'">Дата народження</label>
                            <p id="memberDate" v-if="item.type == 'соліст' || item.type == 'дует'">{{ item.memberDate }}</p>

                            <label for="memberAverage" class="brtop" v-if="item.type == 'ансамбль' || item.type == 'Хор' || item.type == 'Оркестр'">Середній вік учасників</label>
                            <p id="memberAverage" v-if="item.type == 'ансамбль' || item.type == 'Хор' || item.type == 'Оркестр'">{{ item.memberAverage }}</p>

                            <label for="memberIdCode" class="brtop" v-if="item.type == 'соліст' || item.type == 'дует'">Ідентифікаційний номер учня</label>
                            <p id="memberIdCode" v-if="item.type == 'соліст' || item.type == 'дует'">{{ item.idCode }}</p>

                            <label for="teacherIdCode" class="brtop" v-if="item.type == 'ансамбль' || item.type == 'Хор' || item.type == 'Оркестр'">Ідентифікаційний номер викладача</label>
                            <p id="teacherIdCode" v-if="item.type == 'ансамбль' || item.type == 'Хор' || item.type == 'Оркестр'">{{ item.teacherIdCode }}</p>

                            <label for="schoolName" class="brtop">Назва мистецького навчального закладу</label>
                            <p id="schoolName">{{ item.schoolName }}</p>

                            <label for="schoolContact" class="brtop">Адреса, телефон та e-mail навч. закладу</label>
                            <p id="schoolContact">{{ `${item.schoolAddress} / ${item.schoolPhone} / ${item.schoolEmail}` }}</p>

                            <label for="teacherDate" class="brtop">ПІП викладача</label>
                            <p id="teacherDate">{{ `${item.teacherSurname} ${item.teacherName} ${item.teacherPatronymic}` }}</p>

                            <label for="teacherPhone" class="brtop">Контактний телефон викладача</label>
                            <p id="teacherPhone">{{ item.teacherPhone }}</p>

                            <label for="concertDate" class="brtop">ПІП концертмейстра</label>
                            <p id="concertDate">{{ `${item.concertSurname} ${item.concertName} ${item.concertPatronymic}` }}</p>

                            <label class="brtop mb-3">Програма та хронометраж кожного твору</label>
                            <p>Перший твір:</p>
                            <p class="composition-style">Назва: {{ item.compositionName }} Автор: {{ item.compositionAuthor }} Хронометраж: {{ item.compositionTiming }}</p>
                            <p>Другий твір:</p>
                            <p class="composition-style">Назва: {{ item.compositionName2 }} Автор: {{ item.compositionAuthor2 }} Хронометраж: {{ item.compositionTiming2 }}</p>
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
                            name: member.group.name,
                            type: member.app_type.name,

	                        memberAverage: member.group.average_age,
	                        teacherIdCode: member.preparation.teacher_in,
	                        schoolName: member.preparation.school_one,
	                        schoolAddress: member.preparation.school_address,
	                        schoolPhone: member.preparation.school_phone,
	                        schoolEmail: member.preparation.school_email,
	                        teacherSurname: member.preparation.teacher_surname,
	                        teacherName: member.preparation.teacher_name,
	                        teacherPatronymic: member.preparation.teacher_patronymic,
	                        teacherPhone: member.preparation.teacher_phone,
	                        concertSurname: member.preparation.concertmaster_surname,
	                        concertName: member.preparation.concertmaster_name,
	                        concertPatronymic: member.preparation.concertmaster_patronymic,
	                        compositionName: member.presentation.composition_one,
	                        compositionAuthor: member.presentation.author_one,
	                        compositionTiming: member.presentation.time_one,
	                        compositionName2: member.presentation.composition_two,
	                        compositionAuthor2: member.presentation.author_two,
	                        compositionTiming2: member.presentation.time_two,

                            id: member.application_id
                        })
                    }
                    else if(member.solo_duet.length == 1) {
                        this.members.push({
                            name: `${member.solo_duet[0].name} ${member.solo_duet[0].surname} ${member.solo_duet[0].patronymic}`,
                            type: member.app_type.name,

	                        memberDate: member.solo_duet[0].data_birthday,
	                        idCode: member.solo_duet[0].in,
	                        schoolName: member.preparation.school_one,
	                        schoolAddress: member.preparation.school_address,
	                        schoolPhone: member.preparation.school_phone,
	                        schoolEmail: member.preparation.school_email,
	                        teacherSurname: member.preparation.teacher_surname,
	                        teacherName: member.preparation.teacher_name,
	                        teacherPatronymic: member.preparation.teacher_patronymic,
	                        teacherPhone: member.preparation.teacher_phone,
	                        concertSurname: member.preparation.concertmaster_surname,
	                        concertName: member.preparation.concertmaster_name,
	                        concertPatronymic: member.preparation.concertmaster_patronymic,
	                        compositionName: member.presentation.composition_one,
	                        compositionAuthor: member.presentation.author_one,
	                        compositionTiming: member.presentation.time_one,
	                        compositionName2: member.presentation.composition_two,
	                        compositionAuthor2: member.presentation.author_two,
	                        compositionTiming2: member.presentation.time_two,

                            id: member.application_id
                        })
                    }
                    else if(member.solo_duet.length == 2) {
                        this.members.push({
                            name: `${member.solo_duet[0].name} ${member.solo_duet[0].surname} ${member.solo_duet[0].patronymic}, ${member.solo_duet[1].name} ${member.solo_duet[1].surname} ${member.solo_duet[1].patronymic}`,
	                        type: member.app_type.name,

	                        memberDate: member.solo_duet[0].data_birthday,
	                        idCode: member.solo_duet[0].in,
	                        schoolName: member.preparation.school_one,
	                        schoolAddress: member.preparation.school_address,
	                        schoolPhone: member.preparation.school_phone,
	                        schoolEmail: member.preparation.school_email,
	                        teacherSurname: member.preparation.teacher_surname,
	                        teacherName: member.preparation.teacher_name,
	                        teacherPatronymic: member.preparation.teacher_patronymic,
	                        teacherPhone: member.preparation.teacher_phone,
	                        concertSurname: member.preparation.concertmaster_surname,
	                        concertName: member.preparation.concertmaster_name,
	                        concertPatronymic: member.preparation.concertmaster_patronymic,
	                        compositionName: member.presentation.composition_one,
	                        compositionAuthor: member.presentation.author_one,
	                        compositionTiming: member.presentation.time_one,
	                        compositionName2: member.presentation.composition_two,
	                        compositionAuthor2: member.presentation.author_two,
	                        compositionTiming2: member.presentation.time_two,

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