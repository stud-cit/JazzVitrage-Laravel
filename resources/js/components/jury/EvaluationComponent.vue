<template>
<div>
    <div class="row">
        <div class="col-12 pb-3 comeBack">
            <router-link :to="{ name: 'jury-all-statements' }"><i class="fa fa-angle-left" aria-hidden="true"></i> Повернутися до списку</router-link>
            
        </div>
        <div class="col-8">
            <div class="border" style="width: 100%; height: 400px;"></div>
        </div>
        <div class="col-4">
            <form>
                <label for="stylisticMatching">Стилістична та жанрова відповідність творів.</label>
                <input type="number" class="form-control" id="stylisticMatching">

                <label for="artisticValue">Художньо-естетична цінність та техніко-образна складність виконуваного репертуару.</label>
                <input type="number" class="form-control" id="artisticValue">

                <label for="artistry">Артистизм.</label>
                <input type="number" class="form-control" id="artistry">

                <label for="originality">Оригінальність сценічного вигляду.</label>
                <input type="number" class="form-control" id="originality">
            </form>
        </div>
    </div>
    <br>
    <div class="container">
        <div class="row border evaluationInfo">
           <div class="col-9" v-if="group != null">
                <div class="row">
                    <div class="col-12 evaluationName"><b>Назва:</b> {{ group.name }}</div>
                    <div class="col-6">
                        <b>Тип:</b> {{ type.name }}
                        <b class="mt-3">Кількість учасників:</b> {{ group.count_people }}
                        <b class="mt-3">Середній вік:</b> {{ group.average_age }}
                        <b class="mt-3">Адреса:</b> {{ school.school_address }}
                    </div>
                    <div class="col-6">
                        <b>ПІП викладача:</b> {{ `${school.teacher_name}  ${school.teacher_surname} ${school.teacher_patronomic}` }}
                        <b class="mt-3">Програма кожного твору:</b> {{ `${program.composition_one} - ${program.author_one};` }} <br> {{ `${program.composition_two} - ${program.author_two};` }}
                    </div>
                </div>
            </div>
           <div class="col-9" v-if="member.length == 1">
                <div class="row">
                    <div class="col-12 evaluationName"><b>ПІП:</b> {{ `${member[0].name} ${member[0].surname} ${member[0].patronomic}` }}</div>
                    <div class="col-6">
                        <b>Тип:</b> {{ type.name }}
                        <b class="mt-3">Дата народження:</b> {{ member.data_birthday }}
                        <b class="mt-3">Адреса:</b> {{ school.school_address }}
                    </div>
                    <div class="col-6">
                        <b>ПІП викладача:</b> {{ `${school.teacher_name}  ${school.teacher_surname} ${school.teacher_patronomic}` }}
                        <b class="mt-3">Програма кожного твору:</b> {{ `${program.composition_one} - ${program.author_one};` }} <br> {{ `${program.composition_two} - ${program.author_two};` }}
                    </div>
                </div>
            </div>
            <div class="col-9" v-if="member.length == 2">
                <div class="row">
                    <div class="col-12 evaluationName"><b>ПІП:</b> {{ `${member[0].name} ${member[0].surname} ${member[0].patronomic}` }}, {{ `${member[1].name}  ${member[1].surname} ${member[1].patronomic}` }}</div>
                    <div class="col-6">
                        <b>Тип:</b> {{ type.name }}
                        <b class="mt-3">Дата народження:</b> {{ `${member[0].data_birthday}, ${member[1].data_birthday}` }}
                        <b class="mt-3">Адреса:</b> {{ school.school_address }}
                    </div>
                    <div class="col-6">
                        <b>ПІП викладача:</b> {{ `${school.teacher_name}  ${school.teacher_surname} ${school.teacher_patronomic}` }}
                        <b class="mt-3">Програма кожного твору:</b> {{ `${program.composition_one} - ${program.author_one};` }} <br> {{ `${program.composition_two} - ${program.author_two};` }}
                    </div>
                </div>
            </div>
            <div class="col-3">
                <button type="button" class="btn btn-secondary btn-block">Зберегти</button>
                <button type="button" @click="nextMember" v-show="nextButtonShow" class="btn btn-outline-secondary btn-block mt-4">Наступний учасник</button>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        data() {
            return {
                member: '',
                type: '',
                school: '',
                program: '',
                group: null,
                count: 0
            }
        },
        created() {
            this.getMember();
            this.getAllMembers();
        },
        computed: {
            nextButtonShow() {
                return this.$route.params.id == this.count ? false : true;
            }
        },
        methods: {
            getMember() {
                axios.get('/get-member/'+this.$route.params.id)
                .then((response) => {
                    this.member = response.data[0].solo_duet;
                    this.group = response.data[0].group;
                    this.type = response.data[0].app_type;
                    this.school = response.data[0].preparation;
                    this.program = response.data[0].presentation;
                });
            },
            getAllMembers() {
                axios.get('/get-all-members')
                .then((response) => {
                    this.count = response.data.length;
                });
            },
            nextMember() {
                this.$router.push({ name: 'jury-evaluation', params: {id: ++this.$route.params.id} });
                this.getMember();
            }
        }
    }
</script>