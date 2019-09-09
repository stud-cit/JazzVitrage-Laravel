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
                                <label><input type="radio" name="app-type" class="app-type"><i></i>СОЛІСТ</label>
                                <label><input type="radio" name="app-type" class="app-type"><i></i>СОЛІСТ</label>
                                <label><input type="radio" name="app-type" class="app-type"><i></i>СОЛІСТ</label>
                                <label><input type="radio" name="app-type" class="app-type"><i></i>СОЛІСТ</label>


                            </div>
                            <div class="select-block">
                                <img src="img/star.png" class="star" alt="">
                                <select name="" id="" class="select" >
                                    <option disabled selected class="d-none">НОМІНАЦІЯ</option>
                                    <option value="1">1</option>
                                </select>
                            </div>
                            <div class="text-right">
                                <button type="button" @click="changeStep(1)" class="next-step">Далі</button>
                            </div>
                        </div>
                    </transition>
                    <transition name="fade">
                        <div class="step-form step1" v-if="activeStep == 1">
                            <h3 class="step-title">тип заявки2 <i class="hint"></i></h3>
                            <div class="input-group">
                                <label><input type="radio" name="app-type" class="app-type"><i></i>СОЛІСТ</label>
                                <label><input type="radio" name="app-type" class="app-type"><i></i>СОЛІСТ</label>
                                <label><input type="radio" name="app-type" class="app-type"><i></i>СОЛІСТ</label>
                                <label><input type="radio" name="app-type" class="app-type"><i></i>СОЛІСТ</label>
                                <label><input type="radio" name="app-type" class="app-type"><i></i>СОЛІСТ</label>


                            </div>
                            <h3 class="step-title">тип заявки2 <i class="hint"></i></h3>
                            <div class="input-group">
                                <label><input type="radio" name="app-type" class="app-type"><i></i>СОЛІСТ</label>
                                <label><input type="radio" name="app-type" class="app-type"><i></i>СОЛІСТ</label>
                                <label><input type="radio" name="app-type" class="app-type"><i></i>СОЛІСТ</label>
                                <label><input type="radio" name="app-type" class="app-type"><i></i>СОЛІСТ</label>
                                <label><input type="radio" name="app-type" class="app-type"><i></i>СОЛІСТ</label>


                            </div>
                            <h3 class="step-title">тип заявки2 <i class="hint"></i></h3>
                            <div class="input-group">
                                <label><input type="radio" name="app-type" class="app-type"><i></i>СОЛІСТ</label>
                                <label><input type="radio" name="app-type" class="app-type"><i></i>СОЛІСТ</label>
                                <label><input type="radio" name="app-type" class="app-type"><i></i>СОЛІСТ</label>
                                <label><input type="radio" name="app-type" class="app-type"><i></i>СОЛІСТ</label>
                                <label><input type="radio" name="app-type" class="app-type"><i></i>СОЛІСТ</label>


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
                activeStep: 0
            };
        },

        created () {
            document.title = "Заповнити заявку";

        },
        computed: {

        },
        methods: {
            changeStep(step){
                const steps = this.steps;
                steps[step] = true;
                this.activeStep = step;


            }

        },

    }
</script>