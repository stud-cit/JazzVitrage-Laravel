<template>
<div>
    <div class="row">
        <div class="col-12 pb-3 comeBack">
            <router-link :to="{ name: 'jury-all-statements' }"><i class="fa fa-angle-left" aria-hidden="true"></i> Повернутися до списку</router-link>

        </div>
        <div class="col-8">
            <video width="100%" id="videoMember" controls>
                <source v-if="program.video" :src="program.video" type="video/mp4">
            </video>
        </div>
        <div class="col-4">
            <form>
                <label for="stylisticMatching">Стилістична та жанрова відповідність творів.</label>
                <input
                    type="number"
                    v-bind:min="minEvaluation"
                    v-bind:max="maxEvaluation"
                    v-model.number="stylisticMatching"
                    class="form-control check-nomination"
                    id="stylisticMatching" >

                <label for="artisticValue">Художньо-естетична цінність та техніко-образна складність виконуваного репертуару.</label>
                <input
                    type="number"
                    v-bind:min="minEvaluation"
                    v-bind:max="maxEvaluation"
                    v-model.number="artisticValue"
                    class="form-control check-nomination"
                    id="artisticValue" >

                <label for="artistry">Артистизм.</label>
                <input
                    type="number"
                    v-bind:min="minEvaluation"
                    v-bind:max="maxEvaluation"
                    v-model.number="artistry"
                    class="form-control check-nomination"
                    id="artistry" >

                <label for="originality">Оригінальність сценічного вигляду.</label>
                <input
                    type="number"
                    v-bind:min="minEvaluation"
                    v-bind:max="maxEvaluation"
                    v-model.number="originality"
                    class="form-control check-nomination"
                    id="originality">
            </form>
            <p class="evaluation mt-2">Загальна оцінка:  <b>{{evaluation}}</b></p>
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
                        <b class="mt-3">Номінація:</b> {{ nomination.name }}
                        <b class="mt-3">Кількість учасників:</b> {{ group.count_people }}
                        <b class="mt-3">Середній вік:</b> {{ group.average_age }}
                        <b class="mt-3">Адреса:</b> {{ school.school_address }}
                    </div>
                    <div class="col-6">
                        <b>ПІП викладача:</b> {{ `${school.teacher_surname} ${school.teacher_name} ${school.teacher_patronymic}` }}
                        <b class="mt-3">Програма кожного твору:</b> {{ `${program.composition_one} - ${program.author_one};` }} <br> {{ `${program.composition_two} - ${program.author_two};` }}
                    </div>
                </div>
            </div>
           <div class="col-9" v-if="member.length == 1">
                <div class="row">
                    <div class="col-12 evaluationName"><b>ПІП:</b> {{ `${member[0].surname} ${member[0].name} ${member[0].patronymic}` }}</div>
                    <div class="col-6">
                        <b>Тип:</b> {{ type.name }}
                        <b>Номінація:</b> {{ nomination.name }}
                        <b class="mt-3">Дата народження:</b> {{ member[0].data_birthday }}
                        <b class="mt-3">Адреса:</b> {{ school.school_address }}
                    </div>
                    <div class="col-6">
                        <b>ПІП викладача:</b> {{ `${school.teacher_surname} ${school.teacher_name} ${school.teacher_patronymic}` }}
                        <b class="mt-3">Програма кожного твору:</b> {{ `${program.composition_one} - ${program.author_one};` }} <br> {{ `${program.composition_two} - ${program.author_two};` }}
                    </div>
                </div>
            </div>
            <div class="col-9" v-if="member.length == 2">
                <div class="row">
                    <div class="col-12 evaluationName"><b>ПІП:</b> {{ `${member[0].surname} ${member[0].name} ${member[0].patronymic}` }}, {{ `${member[1].surname} ${member[1].name} ${member[1].patronymic}` }}</div>
                    <div class="col-6">
                        <b>Тип:</b> {{ type.name }}
                        <b class="mt-3">Дата народження:</b> {{ `${member[0].data_birthday}, ${member[1].data_birthday}` }}
                        <b class="mt-3">Адреса:</b> {{ school.school_address }}
                    </div>
                    <div class="col-6">
                        <b>ПІП викладача:</b> {{ `${school.teacher_surname} ${school.teacher_name}  ${school.teacher_patronymic}` }}
                        <b class="mt-3">Програма кожного твору:</b> {{ `${program.composition_one} - ${program.author_one};` }} <br> {{ `${program.composition_two} - ${program.author_two};` }}
                    </div>
                </div>
            </div>
            <div class="col-3">
                <button type="button" v-if="!hasRecord" @click="createEvaluation" class="btn btn-secondary btn-block check-button">Зберегти</button>
                <button type="button" v-if="hasRecord" @click="updateEvaluation" class="btn btn-secondary btn-block">Оновити</button>
                <button type="button" @click="nextMember" v-show="nextButtonShow" class="btn btn-outline-secondary btn-block mt-4">Наступний учасник</button>
                <button type="button" @click="prevMember" v-show="prevButtonShow" class="btn btn-outline-secondary btn-block mt-4">Попередній учасник</button>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        data() {
            return {
                memberIds: [],
                memberIndex: 0,
                memberId: 0,
                member: '',
                type: '',
                school: '',
                program: '',
                group: null,
                count: 0,
                // оцінки
                // score: {
                    user_id: 0,
                    stylisticMatching: 0,
                    artisticValue: 0,
                    artistry: 0,
                    originality: 0,
                    evaluation: 0,
                // },
                // мінімальна максимальна оцінка
                minEvaluation: 0,
                maxEvaluation: 25,
                maxRating: 100,
                hasError: false,
                hasRecord: false,
	            userJury: '',
	            juryNomination: ''
            }
        },
        watch: {
            stylisticMatching: function (val) {
                this.evaluation += val;
            },
            artisticValue: function (val) {
	            this.evaluation += val;
            },
            artistry: function (val) {
                this.evaluation += val;
            },
            originality: function (val) {
                this.evaluation += val;
            },
            evaluation: function () {
                this.evaluation = Number(this.stylisticMatching) + Number(this.artisticValue) + Number(this.artistry) + Number(this.originality);
            }
        },
        created() {
            this.getMember();
            this.getAllMembers();
        },
        computed: {

            nextButtonShow() {
                return this.memberIndex == this.count ? false : true;
            },
            prevButtonShow() {
                return this.memberIndex >= 1 ? true : false;
            }
        },

        methods: {
            getEvaluation() {
                axios.get(`/has-record/${this.$route.params.id}/`)
                    .then( ( response )  => {
	                    this.checkJury();
                        this.hasRecord = this.isRecord(response.data);
                        const {stylistic_matching, artistic_value, artistry, originality, evaluation, user_id } = response.data;

                        if(this.hasRecord) {
                            this.user_id = user_id;
                            this.stylisticMatching = stylistic_matching;
                            this.artisticValue = artistic_value;
                            this.artistry = artistry;
                            this.originality = originality;
                            this.evaluation = evaluation;
                        } else {
                            this.setDefaultEvaluate();
                        }
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            },
            // need make validation
            createEvaluation() {
                const {evaluation, stylisticMatching, artisticValue, artistry, originality} = this;

                axios.post('/to-rate', {
                    application_id: this.program.application_id,
                    evaluation,
                    stylistic_matching: stylisticMatching,
                    artistic_value: artisticValue,
                    artistry,
                    originality
                })
                .then( (response)  => {
                    swal( `Ваша оцінка ${this.evaluation} із можливих ${this.maxRating}`, {
                        icon: 'success',
                    });
                    this.hasRecord = true;
                 })
                .catch( (error) => {
                    if (error.response.status === 422) {
                        swal(`Оцінка за окрему категорію повинна бути
                        в межах від ${this.minEvaluation} до ${this.maxEvaluation}`, {
                            icon: 'error'
                        });
                    } else {
                        swal('Щось пішло не так, зверніться до адміністратора', {
                            icon: 'error'
                        });
                    }
                });
            },
            updateEvaluation() {
                const {evaluation, stylisticMatching, artisticValue, artistry, originality, user_id} = this;
                axios.post(`/to-rate-update/${this.$route.params.id}`, {
                    user_id,
                    evaluation,
                    stylistic_matching: stylisticMatching,
                    artistic_value: artisticValue,
                    artistry,
                    originality
                })
                .then( (response) => {
                    swal(`Оцінку успішно змінено`, {
                        icon: 'success'
                    });
                })
                .catch( (error) => {
                    if (error.response.status === 422) {
                        swal(`Оцінка за окрему категорію повинна бути
                            в межах від ${this.minEvaluation} до ${this.maxEvaluation}`, {
                            icon: 'error'
                        });
                    } else {
                        swal('Щось пішло не так, зверніться до адміністратора', {
                            icon: 'error'
                        });
                    }

                });
            },

            setDefaultEvaluate() {
                this.stylisticMatching = 0;
                this.artisticValue = 0;
                this.artistry = 0;
                this.originality = 0;
                this.evaluation = 0;
            },
            isRecord(obj) {
                for (let key in obj) {
                    // если тело цикла начнет выполняться - значит в объекте есть свойства
                    return true;
                }
                return false;
            },
            getMember() {
                axios.get(`/get-member/${this.$route.params.id}`)
                    .then((response) => {
                        if(response.data.length == 0) {
                            this.$router.push('/admin/all-statements');
                        }
                        this.member = response.data.solo_duet;
                        this.group = response.data.group;
                        this.type = response.data.app_type;
                        this.nomination = response.data.nomination;
                        this.school = response.data.preparation;
                        this.program = response.data.presentation;

                        var container = document.getElementById("videoMember");
                        container.setAttribute("src", this.program.video);
	                    this.juryNomination = response.data.nomination;
                    })
                    .catch( error => console.error(error) );
	                this.getUserJury();
                    this.getEvaluation();
            },
            getAllMembers() {
                axios.get('/get-approved-members')
                    .then( ( response ) => {
                        this.count = response.data.length - 1;
                        this.memberIds = response.data.map( (row) => row.application_id);
                        this.memberId = Number (this.$route.params.id);
                        this.memberIndex = this.memberIds.indexOf( this.memberId );
                    });

            },
	        getUserJury() {
                axios.get('/get-user-jury')
	                .then((response) => {
		                this.userJury = response.data;
	                })
            },
            checkJury() {
	            var juryNomination;
	            var resultButton;

	            console.log(this.userJury.nominations);
	            console.log(this.juryNomination.name);

	            if(this.userJury.nominations != this.juryNomination.name){
		            juryNomination = document.getElementsByClassName('check-nomination');
		            juryNomination[0].setAttribute('disabled', 'disabled');
		            juryNomination[1].setAttribute('disabled', 'disabled');
		            juryNomination[2].setAttribute('disabled', 'disabled');
		            juryNomination[3].setAttribute('disabled', 'disabled');
		            resultButton = document.getElementsByClassName('check-button');
		            resultButton[0].hidden = true;
	            }
            },
            nextItem() {

                this.memberIndex = this.memberIds.indexOf( Number( this.$route.params.id ) );
                if(this.memberIndex >= 0 && this.memberIndex < this.count) {
                    this.memberIndex += 1;
                    this.memberId = this.memberIds[this.memberIndex];
                }
            },
            prevItem() {
                this.memberIndex = this.memberIds.indexOf( Number(this.$route.params.id) );
                if(this.memberIndex > 0) {
                    this.memberIndex -= 1;
                    this.memberId = this.memberIds[this.memberIndex];
                }
            },
            nextMember () {
                this.nextItem();
                this.$router.push({ name: 'jury-evaluation', params: {id: this.memberId } });
                this.getMember();
            },
            prevMember() {
                this.prevItem();
                this.$router.push({name: 'jury-evaluation', params: { id: this.memberId } });
                this.getMember();
            },
        },
    }
</script>
<style lang="sass" scoped>
.evaluation
    font-size: 1.5rem
</style>
