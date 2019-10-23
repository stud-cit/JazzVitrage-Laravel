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
                        <i class="fa fa-2x fa-check-circle btn btn-default p-0" @click="addApproved(item.id)"></i>

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
                            <label for="memberDate" class="brtop" v-if="item.type == 'соліст'">Дата народження</label>
                            <p id="memberDate" v-if="item.type == 'соліст'">{{ item.memberDate }}</p>

                            <label for="memberDate1" class="brtop" v-if="item.type == 'дует'">Дата народження першого учасника</label>
                            <p id="memberDate1" v-if="item.type == 'дует'">{{ item.memberDate1 }}</p>

                            <label for="memberDate2" class="brtop" v-if="item.type == 'дует'">Дата народження другого учасника</label>
                            <p id="memberDate2" v-if="item.type == 'дует'">{{ item.memberDate2 }}</p>

                            <label for="memberAverage" class="brtop" v-if="item.type == 'ансамбль' || item.type == 'Хор' || item.type == 'Оркестр'">Середній вік учасників</label>
                            <p id="memberAverage" v-if="item.type == 'ансамбль' || item.type == 'Хор' || item.type == 'Оркестр'">{{ item.memberAverage }}</p>

                            <label for="memberIdCode" class="brtop" v-if="item.type == 'соліст'">Ідентифікаційний номер учня</label>
                            <p id="memberIdCode" v-if="item.type == 'соліст'">{{ item.idCode }}</p>

                            <label for="memberIdCode1" class="brtop" v-if="item.type == 'дует'">Ідентифікаційний номер першого учасника</label>
                            <p id="memberIdCode1" v-if="item.type == 'дует'">{{ item.idCode1 }}</p>

                            <label for="memberIdCode2" class="brtop" v-if="item.type == 'дует'">Ідентифікаційний номер другого учасника</label>
                            <p id="memberIdCode2" v-if="item.type == 'дует'">{{ item.idCode2 }}</p>

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

                            <div v-if="item.concertSurname == '' || item.concertName == '' || item.concertPatronymic == ''"> </div>
                            <div v-else>
                            <label for="concertDate" class="brtop">ПІП концертмейстра</label>
                            <p id="concertDate">{{ `${item.concertSurname} ${item.concertName} ${item.concertPatronymic}` }}</p>
                            </div>

                            <label for="memberPhoto" class="brtop">Фото документів</label>
                            <p></p>

                            <div id="memberPhoto" class="row" v-if="item.type == 'соліст'">
                                <div class="col-4">
                                    <div class="border statementPhotoDoc"
                                         :style="{ backgroundImage: 'url(' + '/memberFiles/'+item.passport_photo + ')' }">
                                        <silentbox-single :src="'/memberFiles/'+item.passport_photo">
                                            <i class="fa fa-search"></i>
                                        </silentbox-single>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="border statementPhotoDoc"
                                         :style="{ backgroundImage: 'url(' + '/memberFiles/'+item.in_file + ')' }">
                                        <silentbox-single :src="'/memberFiles/'+item.in_file">
                                            <i class="fa fa-search"></i>
                                        </silentbox-single>
                                    </div>
                                </div>
                            </div>

                            <div id="memberPhoto" class="row" v-if="item.type == 'дует'">
                                <div class="col-4">
                                    <div class="border statementPhotoDoc"
                                         :style="{ backgroundImage: 'url(' + '/memberFiles/'+item.passport_photo1 + ')' }">
                                        <silentbox-single :src="'/memberFiles/'+item.passport_photo1">
                                            <i class="fa fa-search"></i>
                                        </silentbox-single>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="border statementPhotoDoc"
                                         :style="{ backgroundImage: 'url(' + '/memberFiles/'+item.in_file1 + ')' }">
                                        <silentbox-single :src="'/memberFiles/'+item.in_file1">
                                            <i class="fa fa-search"></i>
                                        </silentbox-single>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="border statementPhotoDoc"
                                         :style="{ backgroundImage: 'url(' + '/memberFiles/'+item.passport_photo2 + ')' }">
                                        <silentbox-single :src="'/memberFiles/'+item.passport_photo2">
                                            <i class="fa fa-search"></i>
                                        </silentbox-single>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="border statementPhotoDoc"
                                         :style="{ backgroundImage: 'url(' + '/memberFiles/'+item.in_file2 + ')' }">
                                        <silentbox-single :src="'/memberFiles/'+item.in_file2">
                                            <i class="fa fa-search"></i>
                                        </silentbox-single>
                                    </div>
                                </div>
                            </div>

                            <div id="memberPhoto" class="row"
                                 v-if="item.type == 'ансамбль' || item.type == 'Хор' || item.type == 'Оркестр'">
                                <div class="col-4">
                                    <div class="border statementPhotoDoc"
                                         :style="{ backgroundImage: 'url(' + '/memberFiles/'+item.file + ')' }">
                                        <silentbox-single :src="'/memberFiles/'+item.file">
                                            <i class="fa fa-search"></i>
                                        </silentbox-single>
                                    </div>
                                </div>
                            </div>

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
                this.memberPhoto = [];
                response.data.filter( app => {
                    return app.status == "created" || app.status == "approved";
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
	                        file: member.group.file,

                            id: member.application_id
                        })
                    }
                    else if(member.solo_duet.length == 1) {
                        this.members.push({
                            name: `${member.solo_duet[0].name} ${member.solo_duet[0].surname} ${member.solo_duet[0].patronymic}`,
                            type: member.app_type.name,

	                        memberDate: member.solo_duet[0].data_birthday.split('-').reverse().join('-'),
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
	                        passport_photo: member.solo_duet[0].passport_photo,
	                        in_file: member.solo_duet[0].in_file,

                            id: member.application_id
                        })
                    }
                    else if(member.solo_duet.length == 2) {
                        this.members.push({
                            name: `${member.solo_duet[0].name} ${member.solo_duet[0].surname} ${member.solo_duet[0].patronymic}, ${member.solo_duet[1].name} ${member.solo_duet[1].surname} ${member.solo_duet[1].patronymic}`,
	                        type: member.app_type.name,

	                        memberDate1: member.solo_duet[0].data_birthday.split('-').reverse().join('-'),
	                        memberDate2: member.solo_duet[1].data_birthday.split('-').reverse().join('-'),
	                        idCode1: member.solo_duet[0].in,
	                        idCode2: member.solo_duet[1].in,
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
	                        passport_photo1: member.solo_duet[0].passport_photo,
	                        in_file1: member.solo_duet[0].in_file,
	                        passport_photo2: member.solo_duet[1].passport_photo,
	                        in_file2: member.solo_duet[1].in_file,

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
	    addApproved(id){
            axios.post('/add-approved/'+id)
                .then((response) => {
	                if(response.status == 200 ) {
		                this.getFullList();
	                }
	                swal("Учаснику присвоєно статус: Схвалений", {
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