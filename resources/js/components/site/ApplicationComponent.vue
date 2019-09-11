<template>
    <div>
        <section class="sections main-section applications">
            <div class="application-for-participation">
                <h2 class="title-section">Заявка на участь </h2>
                <p class="subtitle">У КОНКУРСІ</p>
            </div>
            <div class="container">
                <div class="step-block" ref="stepBlock">
                    <div class="step-numbers">
                        <div :class="['number-item d-flex align-items-center', {active:steps[0]}]">
                            <div class="number-circle">1</div>
                            <div class="number-text">Крок 1</div>
                        </div>
                        <div :class="['number-item d-flex align-items-center', {active:steps[1]}]">
                            <div class="number-circle">2</div>
                            <div class="number-text">Крок 2</div>
                        </div>
                        <div :class="['number-item d-flex align-items-center', {active:steps[2]}]">
                            <div class="number-circle">3</div>
                            <div class="number-text">Крок 3</div>
                        </div>
                        <div :class="['number-item d-flex align-items-center', {active:steps[3]}]">
                            <div class="number-circle">4</div>
                            <div class="number-text">Крок 4</div>
                        </div>
                        <div :class="['number-item d-flex align-items-center', {active:steps[4]}]">
                            <div class="number-circle">5</div>
                            <div class="number-text">Крок 5</div>
                        </div>

                    </div>
                    <transition name="fade" >
                        <div class="step-form step1" v-if="activeStep == 0">
                            <h3 class="step-title">тип заявки <i class="hint"></i></h3>
                            <div class="input-group">
                                <label><input type="radio" name="app-type" class="app-type"><i></i>СОЛІСТ</label>
                                <label><input type="radio" name="app-type" class="app-type"><i></i>ДУЕТ</label>
                                <label><input type="radio" name="app-type" class="app-type"><i></i>АНСАМБЛЬ</label>
                                <label><input type="radio" name="app-type" class="app-type"><i></i>ХОР</label>
                                <label><input type="radio" name="app-type" class="app-type"><i></i>ОРКЕСТР</label>


                            </div>
                            <div class="select-block">
                                <img src="img/star.png" class="star" alt="">
                                <select name="" id="" class="select" >
                                    <option disabled selected class="d-none">НОМІНАЦІЯ</option>
                                    <option value="1">1</option>
                                </select>
                            </div>
                            <div class="text-right">
                                <button type="button" @click="nextStep" class="next-step">Далі</button>
                            </div>
                        </div>
                    </transition>
                    <transition name="fade">
                        <form class="step-form step1" v-if="activeStep == 1">
                            <h3 class="step-title">Інформація про учасника</h3>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/step2-user.png" alt="" class="input-img">
                                    <input type="text" placeholder="ПРІЗВИЩЕ ">
                                </div>
                                <div class="input-container ml-4">
                                    <input type="text" placeholder="ІМ'Я  ">
                                </div>
                                <div class="input-container ml-4">
                                    <input type="text" placeholder="ПО-БАТЬКОВІ  ">
                                </div>
                            </div>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/step2-data.png" alt="" class="input-img">
                                    <input type="text" placeholder="ЧИСЛО, МІСЯЦЬ, РІК НАРОДЖЕННЯ " required pattern="[0-9]{2}.[0-9]{2}.[0-9]{4}">
                                </div>
                            </div>
                            <h3 class="step-title">Копія документа <i class="hint"></i></h3>
                            <div class="input-row">
                                <div class="input-container">

                                    <img src="img/file-image.png" alt="" class="input-img">

                                    <input @change="getInputAttr" id="birthday" class="d-none" type="file" placeholder="../birthdays.jpg ">
                                    <label for="birthday">
                                        <span>{{birthdayFile}}</span>
                                    </label>

                                </div>
                            </div>
                            <h3 class="step-title">ІДЕНТИФІКАЦІЙНИЙ НОМЕР: <i class="hint"></i></h3>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/step2-user.png" alt="" class="input-img">
                                    <input type="text" placeholder="ПРІЗВИЩЕ ">
                                </div>
                                <div class="input-container ml-4">
                                    <input type="text" placeholder="ІМ'Я  ">
                                </div>
                                <div class="input-container ml-4">
                                    <input type="text" placeholder="ПО-БАТЬКОВІ  ">
                                </div>
                            </div>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/step2-data.png" alt="" class="input-img">
                                    <input type="text" placeholder="ІДЕНТИФІКАЦІЙНИЙ НОМЕР ОДНОГО З БАТЬКІВ">
                                </div>
                            </div>
                            <h3 class="step-title">Копія документа <i class="hint"></i></h3>
                            <div class="input-row">
                                <div class="input-container">

                                    <img src="img/file-image.png" alt="" class="input-img">

                                    <input @change="getInputAttr" id="birthday" class="d-none" type="file" placeholder="../birthdays.jpg ">
                                    <label for="birthday">
                                        <span>{{birthdayFile}}</span>
                                    </label>

                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="prev-step" @click="prevStep">Назад</span>
                                <button type="button" @click="nextStep" class="next-step">Далі</button>
                            </div>

                        </form>

                    </transition>
                    <transition name="fade" >
                        <div class="step-form" v-if="activeStep == 2">
                            <h3 class="step-title">Інформація про УЧБОВИЙ ЗАКЛАД </h3>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/input-castle.png" alt="" class="input-img">
                                    <input type="text" placeholder="НАЗВА">
                                </div>
                            </div>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/input-map.png" alt="" class="input-img">
                                    <input type="text" placeholder="АДРЕСА">
                                </div>
                            </div>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/step2-data.png" alt="" class="input-img">
                                    <input type="text" placeholder="ТЕЛЕФОН">
                                </div>
                            </div>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/step2-data.png" alt="" class="input-img">
                                    <input type="text" placeholder="E-MAIL ">
                                </div>
                            </div>
                            <h3 class="step-title">Інформація про ВИКЛАДАЧА  </h3>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/step2-user.png" alt="" class="input-img">
                                    <input type="text" placeholder="ПРІЗВИЩЕ ">
                                </div>
                                <div class="input-container ml-4">
                                    <input type="text" placeholder="ІМ'Я  ">
                                </div>
                                <div class="input-container ml-4">
                                    <input type="text" placeholder="ПО-БАТЬКОВІ  ">
                                </div>
                            </div>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/input-mail.png" alt="" class="input-img">
                                    <input type="text" placeholder="E-MAIL ">
                                </div>
                            </div>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/input-phone.png" alt="" class="input-img">
                                    <input type="text" placeholder="КОНТАКТНИЙ ТЕЛЕФОН ВИКЛАДАЧА">
                                </div>
                            </div>
                            <div class="input-row checkbox-row">
                                    <label for="concertmaster" >
                                        <input @change="concertmaster = !concertmaster" id="concertmaster" class="d-none" type="checkbox" >
                                        <i></i>
                                        В мене є концертмейстер
                                    </label>
                            </div>
                            <div class="input-row" v-if="concertmaster">
                                <div class="input-container">
                                    <img src="img/step2-user.png" alt="" class="input-img">
                                    <input type="text" placeholder="ПРІЗВИЩЕ ">
                                </div>
                                <div class="input-container ml-4">
                                    <input type="text" placeholder="ІМ'Я  ">
                                </div>
                                <div class="input-container ml-4">
                                    <input type="text" placeholder="ПО-БАТЬКОВІ  ">
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="prev-step" @click="prevStep">Назад</span>
                                <button type="button" @click="nextStep" class="next-step">Далі</button>
                            </div>
                        </div>
                    </transition>
                    <transition name="fade" >
                        <div class="step-form step1" v-if="activeStep == 3">
                            <h3 class="step-title">Інформація про ВИСТУП</h3>
                            <h3 class="step-title">перший твір</h3>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/input-composition.png" alt="" class="input-img">
                                    <input type="text" placeholder="НАЗВА">
                                </div>
                            </div>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/input-autor.png" alt="" class="input-img">
                                    <input type="text" placeholder="ТЕЛЕФОН">
                                </div>
                            </div>
                            <h3 class="step-title">Другий твір</h3>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/input-composition.png" alt="" class="input-img">
                                    <input type="text" placeholder="НАЗВА">
                                </div>
                            </div>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/input-autor.png" alt="" class="input-img">
                                    <input type="text" placeholder="ТЕЛЕФОН">
                                </div>
                            </div>
                            <h4 class="step-title">ВИ ПОВИННІ ЗАВАНТАЖИТИ ОДИН ФАЙЛ, ЯКИЙ БУДЕ МІСТИТИ 2 ВІДЕО<i class="hint"></i></h4>
                            <div class="input-row">
                                <div class="input-container">

                                    <img src="img/input-video.png" alt="" class="input-img">

                                    <input @change="getInputAttr" id="birthday" class="d-none" type="file" placeholder="../birthdays.jpg ">
                                    <label for="birthday">
                                        <span>{{birthdayFile}}</span>
                                    </label>

                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="prev-step" @click="prevStep">Назад</span>
                                <button type="button" @click="nextStep" class="next-step">Далі</button>
                            </div>
                        </div>
                    </transition>
                </div>
            </div>

        </section>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                steps: [true, false, false, false, false],
                activeStep: 0,
                birthdayFile: 'завантажити файл',
                concertmaster: false,
            };
        },

        created () {
            document.title = "Заповнити заявку";

        },
        computed: {

        },
        methods: {
            nextStep(){
                // $event.preventDefault();
                const steps = this.steps;
                this.activeStep++;
                steps[this.activeStep] = true;




            },
            prevStep(){
                // $event.preventDefault();
                const steps = this.steps;
                steps[this.activeStep] = false;
                this.activeStep--;



            },
            getInputAttr(e){
                const input = e.target;
                const image = input.value.split('\\').pop();
                this.birthdayFile = image;

            },


        },

    }
</script>