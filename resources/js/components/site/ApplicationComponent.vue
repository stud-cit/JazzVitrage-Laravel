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

                    <!--step1-->

                    <transition name="fade" >
                        <form @submit.prevent="nextStep"  class="step-form" v-if="activeStep == 0">
                            <h3 class="step-title">тип заявки <i class="hint"></i></h3>
                            <div class="input-group">
                                <label><input type="radio" name="app-type" class="app-type" value="1"  v-model="registration.data.appType" ><i></i>СОЛІСТ</label>
                                <label><input type="radio" name="app-type" class="app-type" value="2" v-model="registration.data.appType"><i></i>ДУЕТ</label>
                                <label><input type="radio" name="app-type" class="app-type" value="3" v-model="registration.data.appType"><i></i>АНСАМБЛЬ</label>
                                <label><input type="radio" name="app-type" class="app-type" value="4" v-model="registration.data.appType"><i></i>ХОР</label>
                                <label><input type="radio" name="app-type" class="app-type" value="5" v-model="registration.data.appType"><i></i>ОРКЕСТР</label>


                            </div>
                            <div class="select-block">
                                <img src="img/star.png" class="star" alt="">
                                <select name="nomination" v-model="registration.data.nomination"
                                                 v-validate="{ required: true, regex: /^[1-9]$/ }"
                                                 data-vv-as="серия и номер паспорта"
                                                 id="" class="select" >
                                    <option disabled selected class="d-none" value="0">НОМІНАЦІЯ</option>
                                    <option value="1">Інструментальний  жанр</option>
                                    <option value="2">Вокальний  жанр</option>
                                    <option value="3">Композиція</option>
                                </select>
                            </div>

                            <span v-if="errors.has('nomination')">
                                {{ errors.first('nomination') }}
                            </span>
                            <div class="text-right">
                                <button type="submit"  class="next-step">Далі</button>
                            </div>
                        </form>
                    </transition>

                    <!--step2-->

                    <transition name="fade">
                        <!--<div class="step-form" v-if="activeStep == 1 && registration.data.appType == 1">-->
                        <form class="step-form" v-if="activeStep == 1" >

                            <!--<input type="text" name="nomination2" v-model="registration.data.nomination2"-->
                            <!--v-validate="{ required: true, regex: /^[1-9]$/ }"-->
                            <!--data-vv-as="серия и номер паспорта">-->
                            <!--<span v-if="errors.has('nomination2')">-->
                                <!--{{ errors.first('nomination2') }}-->
                            <!--</span>-->
                            <h3 class="step-title">Інформація про учасника</h3>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/step2-user.png" alt="" class="input-img">
                                    <input type="text" placeholder="ПРІЗВИЩЕ" v-model="registration.data.memberSurname">
                                </div>
                                <div class="input-container ml-4">
                                    <input type="text" placeholder="ІМ'Я" v-model="registration.data.memberName">
                                </div>
                                <div class="input-container ml-4">
                                    <input type="text" placeholder="ПО-БАТЬКОВІ" v-model="registration.data.memberPatronymic">
                                </div>
                            </div>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/step2-data.png" alt="" class="input-img">
                                    <input type="text" placeholder="ЧИСЛО, МІСЯЦЬ, РІК НАРОДЖЕННЯ" v-model="registration.data.memberDate" required pattern="[0-9]{2}.[0-9]{2}.[0-9]{4}">
                                </div>
                            </div>
                            <h3 class="step-title">Копія документа <i class="hint"></i></h3>
                            <div class="input-row">
                                <div class="input-container">

                                    <img src="img/file-image.png" alt="" class="input-img">

                                    <input @change="getInputFile" id="memberBirthdayFile" class="d-none" type="file" >
                                    <label for="memberBirthdayFile">
                                        <span>{{fileTitle.memberBirthdayFile}}</span>
                                    </label>

                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <h3 class="step-title title-left">ІДЕНТИФІКАЦІЙНИЙ НОМЕР: <i class="hint"></i></h3>
                                <div class="input-group input-group-right">
                                    <label><input type="radio" name="id-code-type" class="app-type" v-model="registration.data.idMemberType" value="0"><i></i>УЧНЯ</label>
                                    <label><input type="radio" name="id-code-type" class="app-type" v-model="registration.data.idMemberType" value="1"><i></i>ОДНОГО З БАТЬКІВ</label>
                                </div>
                            </div>
                            <div class="input-row" v-if="registration.data.idMemberType == 1">
                                <div class="input-container">
                                    <img src="img/step2-user.png" alt="" class="input-img">
                                    <input type="text" placeholder="ПРІЗВИЩЕ " v-model="registration.data.parentSurname">
                                </div>
                                <div class="input-container ml-4">
                                    <input type="text" placeholder="ІМ'Я  " v-model="registration.data.parentName">
                                </div>
                                <div class="input-container ml-4">
                                    <input type="text" placeholder="ПО-БАТЬКОВІ  " v-model="registration.data.parentPatronymic">
                                </div>
                            </div>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/step2-data.png" alt="" class="input-img">
                                    <input type="text" :placeholder="registration.data.idMemberType == 1 ? 'ІДЕНТИФІКАЦІЙНИЙ НОМЕР ОДНОГО З БАТЬКІВ' : 'ІДЕНТИФІКАЦІЙНИЙ НОМЕР УЧНЯ'" v-model="registration.data.idCode">
                                </div>
                            </div>
                            <h3 class="step-title">Копія документа <i class="hint"></i></h3>
                            <div class="input-row">
                                <div class="input-container">

                                    <img src="img/file-image.png" alt="" class="input-img">

                                    <input @change="getInputFile" id="idFile" class="d-none" type="file" >
                                    <label for="idFile">
                                        <span>{{fileTitle.idFile}}</span>
                                    </label>

                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-5">
                                <span class="prev-step" @click="prevStep">Назад</span>
                                <button type="button" @click="nextStep" class="next-step">Далі</button>
                            </div>

                        </form>

                        <!--duet-->

                        <div class="step-form" v-else-if="activeStep == 1 && registration.data.appType == 2">
                            <h3 class="step-title">Перший учасник дуету</h3>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/step2-user.png" alt="" class="input-img">
                                    <input type="text" placeholder="ПРІЗВИЩЕ" v-model="registration.data.memberSurname">
                                </div>
                                <div class="input-container ml-4">
                                    <input type="text" placeholder="ІМ'Я" v-model="registration.data.memberName">
                                </div>
                                <div class="input-container ml-4">
                                    <input type="text" placeholder="ПО-БАТЬКОВІ" v-model="registration.data.memberPatronymic">
                                </div>
                            </div>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/step2-data.png" alt="" class="input-img">
                                    <input type="text" placeholder="ЧИСЛО, МІСЯЦЬ, РІК НАРОДЖЕННЯ" v-model="registration.data.memberDate" required pattern="[0-9]{2}.[0-9]{2}.[0-9]{4}">
                                </div>
                            </div>
                            <h3 class="step-title">Копія документа <i class="hint"></i></h3>
                            <div class="input-row">
                                <div class="input-container">

                                    <img src="img/file-image.png" alt="" class="input-img">

                                    <input @change="getInputFile" id="memberBirthdayFile" class="d-none" type="file" >
                                    <label for="memberBirthdayFile">
                                        <span>{{fileTitle.memberBirthdayFile}}</span>
                                    </label>

                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <h3 class="step-title title-left">ІДЕНТИФІКАЦІЙНИЙ НОМЕР: <i class="hint"></i></h3>
                                <div class="input-group input-group-right">
                                    <label><input type="radio" name="id-code-type" class="app-type" v-model="registration.data.idMemberType" value="0"><i></i>УЧНЯ</label>
                                    <label><input type="radio" name="id-code-type" class="app-type" v-model="registration.data.idMemberType" value="1"><i></i>ОДНОГО З БАТЬКІВ</label>
                                </div>
                            </div>
                            <div class="input-row" v-if="registration.data.idMemberType == 1">
                                <div class="input-container">
                                    <img src="img/step2-user.png" alt="" class="input-img">
                                    <input type="text" placeholder="ПРІЗВИЩЕ " v-model="registration.data.parentSurname">
                                </div>
                                <div class="input-container ml-4">
                                    <input type="text" placeholder="ІМ'Я  " v-model="registration.data.parentName">
                                </div>
                                <div class="input-container ml-4">
                                    <input type="text" placeholder="ПО-БАТЬКОВІ  " v-model="registration.data.parentPatronymic">
                                </div>
                            </div>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/step2-data.png" alt="" class="input-img">
                                    <input type="text" :placeholder="registration.data.idMemberType == 1 ? 'ІДЕНТИФІКАЦІЙНИЙ НОМЕР ОДНОГО З БАТЬКІВ' : 'ІДЕНТИФІКАЦІЙНИЙ НОМЕР УЧНЯ'" v-model="registration.data.idCode">
                                </div>
                            </div>
                            <h3 class="step-title">Копія документа <i class="hint"></i></h3>
                            <div class="input-row">
                                <div class="input-container">

                                    <img src="img/file-image.png" alt="" class="input-img">

                                    <input @change="getInputFile" id="idFile" class="d-none" type="file" >
                                    <label for="idFile">
                                        <span>{{fileTitle.idFile}}</span>
                                    </label>

                                </div>
                            </div>

                            <h3 class="step-title">Другий учасник дуету</h3>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/step2-user.png" alt="" class="input-img">
                                    <input type="text" placeholder="ПРІЗВИЩЕ" v-model="registration.data.memberSurname2">
                                </div>
                                <div class="input-container ml-4">
                                    <input type="text" placeholder="ІМ'Я" v-model="registration.data.memberName2">
                                </div>
                                <div class="input-container ml-4">
                                    <input type="text" placeholder="ПО-БАТЬКОВІ" v-model="registration.data.memberPatronymic2">
                                </div>
                            </div>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/step2-data.png" alt="" class="input-img">
                                    <input type="text" placeholder="ЧИСЛО, МІСЯЦЬ, РІК НАРОДЖЕННЯ" v-model="registration.data.memberDate2" required pattern="[0-9]{2}.[0-9]{2}.[0-9]{4}">
                                </div>
                            </div>
                            <h3 class="step-title">Копія документа <i class="hint"></i></h3>
                            <div class="input-row">
                                <div class="input-container">

                                    <img src="img/file-image.png" alt="" class="input-img">

                                    <input @change="getInputFile" id="member2BirthdayFile" class="d-none" type="file" >
                                    <label for="member2BirthdayFile">
                                        <span>{{fileTitle.member2BirthdayFile}}</span>
                                    </label>

                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <h3 class="step-title title-left">ІДЕНТИФІКАЦІЙНИЙ НОМЕР: <i class="hint"></i></h3>
                                <div class="input-group input-group-right">
                                    <label><input type="radio" name="id-code-type" class="app-type" v-model="registration.data.idMemberType2" value="0"><i></i>УЧНЯ</label>
                                    <label><input type="radio" name="id-code-type" class="app-type" v-model="registration.data.idMemberType2" value="1"><i></i>ОДНОГО З БАТЬКІВ</label>
                                </div>
                            </div>
                            <div class="input-row" v-if="registration.data.idMemberType == 1">
                                <div class="input-container">
                                    <img src="img/step2-user.png" alt="" class="input-img">
                                    <input type="text" placeholder="ПРІЗВИЩЕ " v-model="registration.data.parentSurname2">
                                </div>
                                <div class="input-container ml-4">
                                    <input type="text" placeholder="ІМ'Я  " v-model="registration.data.parentName2">
                                </div>
                                <div class="input-container ml-4">
                                    <input type="text" placeholder="ПО-БАТЬКОВІ  " v-model="registration.data.parentPatronymic2">
                                </div>
                            </div>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/step2-data.png" alt="" class="input-img">
                                    <input type="text" :placeholder="registration.data.idMemberType2 == 1 ? 'ІДЕНТИФІКАЦІЙНИЙ НОМЕР ОДНОГО З БАТЬКІВ' : 'ІДЕНТИФІКАЦІЙНИЙ НОМЕР УЧНЯ'" v-model="registration.data.idCode2">
                                </div>
                            </div>
                            <h3 class="step-title">Копія документа <i class="hint"></i></h3>
                            <div class="input-row">
                                <div class="input-container">

                                    <img src="img/file-image.png" alt="" class="input-img">

                                    <input @change="getInputFile" id="idFile2" class="d-none" type="file" >
                                    <label for="idFile2">
                                        <span>{{fileTitle.idFile2}}</span>
                                    </label>

                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-5">
                                <span class="prev-step" @click="prevStep">Назад</span>
                                <button type="button" @click="nextStep" class="next-step">Далі</button>
                            </div>
                        </div>

                        <!--group-->

                        <div class="step-form" v-else-if="activeStep == 1">
                            <h3 class="step-title">Інформація про учасника</h3>

                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/step2-user.png" alt="" class="input-img">
                                    <input type="text" placeholder="НАЗВА КОЛЕКТИВУ " v-model="registration.data.groupName">
                                </div>
                            </div>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/step2-data.png" alt="" class="input-img">
                                    <input type="text" placeholder="КІЛЬКІСТЬ УЧАСНИКІВ " v-model="registration.data.groupCount">
                                </div>
                            </div>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/step2-data.png" alt="" class="input-img">
                                    <input type="text" placeholder="СЕРЕДНІЙ ВІК УЧАСНИКІВ " v-model="registration.data.groupAverage">
                                </div>
                            </div>
                            <h3 class="step-title">Копія документа <i class="hint"></i></h3>
                            <div class="input-row">
                                <div class="input-container">

                                    <img src="img/file-image.png" alt="" class="input-img">

                                    <input @change="getInputFile" id="groupBirthdayFile" class="d-none" type="file" placeholder="../birthdays.jpg ">
                                    <label for="groupBirthdayFile">
                                        <span>{{fileTitle.groupBirthdayFile}}</span>
                                    </label>

                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-5">
                                <span class="prev-step" @click="prevStep">Назад</span>
                                <button type="button" @click="nextStep" class="next-step">Далі</button>
                            </div>

                        </div>

                    </transition>

                    <!--step3-->

                    <transition name="fade" >
                        <div class="step-form" v-if="activeStep == 2">
                            <h3 class="step-title">Інформація про УЧБОВИЙ ЗАКЛАД </h3>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/input-castle.png" alt="" class="input-img" >
                                    <input type="text" placeholder="НАЗВА" v-model="registration.data.schoolName">
                                </div>
                            </div>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/input-map.png" alt="" class="input-img">
                                    <input type="text" placeholder="АДРЕСА" v-model="registration.data.schoolAddress">
                                </div>
                            </div>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/step2-data.png" alt="" class="input-img">
                                    <input type="text" placeholder="ТЕЛЕФОН" v-model="registration.data.schoolPhone">
                                </div>
                            </div>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/step2-data.png" alt="" class="input-img">
                                    <input type="text" placeholder="E-MAIL " v-model="registration.data.schoolEmail">
                                </div>
                            </div>
                            <h3 class="step-title">Інформація про ВИКЛАДАЧА  </h3>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/step2-user.png" alt="" class="input-img">
                                    <input type="text" placeholder="ПРІЗВИЩЕ " v-model="registration.data.teacherSurname">
                                </div>
                                <div class="input-container ml-4">
                                    <input type="text" placeholder="ІМ'Я  " v-model="registration.data.teacherName">
                                </div>
                                <div class="input-container ml-4">
                                    <input type="text" placeholder="ПО-БАТЬКОВІ  " v-model="registration.data.teacherPatronymic">
                                </div>
                            </div>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/input-mail.png" alt="" class="input-img">
                                    <input type="text" placeholder="E-MAIL " v-model="registration.data.teacherEmail">
                                </div>
                            </div>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/step2-data.png" alt="" class="input-img">
                                    <input type="text" placeholder="ІДЕНТИФІКАЦІЙНИЙ НОМЕР КЕРІВНИКА" v-model="registration.data.teacherIdCode">
                                </div>
                            </div>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/input-phone.png" alt="" class="input-img">
                                    <input type="text" placeholder="КОНТАКТНИЙ ТЕЛЕФОН ВИКЛАДАЧА" v-model="registration.data.teacherPhone">
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
                                    <input type="text" placeholder="ПРІЗВИЩЕ " v-model="registration.data.concertSurname">
                                </div>
                                <div class="input-container ml-4">
                                    <input type="text" placeholder="ІМ'Я  " v-model="registration.data.concertName">
                                </div>
                                <div class="input-container ml-4">
                                    <input type="text" placeholder="ПО-БАТЬКОВІ  " v-model="registration.data.concertPatronymic">
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-5">
                                <span class="prev-step" @click="prevStep">Назад</span>
                                <button type="button" @click="nextStep" class="next-step">Далі</button>
                            </div>
                        </div>
                    </transition>

                    <!--step4-->

                    <transition name="fade" >
                        <div class="step-form" v-if="activeStep == 3">
                            <h3 class="step-title">Інформація про ВИСТУП</h3>
                            <h3 class="step-title">перший твір</h3>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/input-composition.png" alt="" class="input-img">
                                    <input type="text" placeholder="НАЗВА" v-model="registration.data.compositionName">
                                </div>
                            </div>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/input-author.png" alt="" class="input-img">
                                    <input type="text" placeholder="АВТОР" v-model="registration.data.compositionAuthor">
                                </div>
                            </div>
                            <h3 class="step-title">Другий твір</h3>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/input-composition.png" alt="" class="input-img">
                                    <input type="text" placeholder="НАЗВА" v-model="registration.data.compositionName2">
                                </div>
                            </div>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/input-author.png" alt="" class="input-img">
                                    <input type="text" placeholder="АВТОР" v-model="registration.data.compositionAuthor2">
                                </div>
                            </div>
                            <h4 class="step-title">ВИ ПОВИННІ ЗАВАНТАЖИТИ ОДИН ФАЙЛ, ЯКИЙ БУДЕ МІСТИТИ 2 ВІДЕО<i class="hint"></i></h4>
                            <div class="input-row">
                                <div class="input-container">

                                    <img src="img/input-video.png" alt="" class="input-img">

                                    <input @change="getInputFile" id="compositionVideo" class="d-none" type="file" placeholder="../birthdays.jpg ">
                                    <label for="compositionVideo">
                                        <span>{{fileTitle.compositionVideo}}</span>
                                    </label>

                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-5">
                                <span class="prev-step" @click="prevStep">Назад</span>
                                <button type="button" @click="nextStep" class="next-step">Далі</button>
                            </div>
                        </div>
                    </transition>

                    <!--step5-->

                    <transition name="fade" >

                        <div class="step-form" v-if="activeStep == 4">

                            <div class="result-row"><h5 class="step-title">Тип заявки: {{appTypes[registration.data.appType]}}</h5></div>
                            <div class="result-row"><h5 class="step-title">Номінація: {{nominations[registration.data.nomination]}}</h5></div>
                            <div class="result-row"><h5 class="step-title">Вікова категорія:</h5></div>
                            <div class="result-row"><h5 class="step-title">Інформація про учасника </h5>
                            <ul class="info-list">
                                <li class="info-item">Прізвище, ім'я, по-батькові: {{registration.data.memberName + ' ' + registration.data.memberSurname + ' ' + registration.data.memberPatronymic}}</li>
                                <li class="info-item">Число, місяці, рік народження: {{registration.data.memberDate}}</li>
                                <li class="info-item">Електрона адреса: {{registration.data.memberName}}</li>
                                <li class="info-item">Ідентифікаційний номер: {{registration.data.idCode}}</li>
                            </ul></div>
                            <div class="result-row"><h5 class="step-title">Інформація про першого учасника </h5>
                            <ul class="info-list">
                                <li class="info-item">Прізвище, ім'я, по-батькові: {{registration.data.memberName + ' ' + registration.data.memberSurname + ' ' + registration.data.memberPatronymic}}</li>
                                <li class="info-item">Число, місяці, рік народження: {{registration.data.memberDate}}</li>
                                <li class="info-item">Електрона адреса: {{registration.data.memberName}}</li>
                                <li class="info-item">Ідентифікаційний номер: {{registration.data.idCode}}</li>
                            </ul></div>
                            <div class="result-row"><h5 class="step-title">Інформація про другого учасника </h5>
                            <ul class="info-list">
                                <li class="info-item">Прізвище, ім'я, по-батькові: {{registration.data.memberName2 + ' ' + registration.data.memberSurname2 + ' ' + registration.data.memberPatronymic2}}</li>
                                <li class="info-item">Число, місяці, рік народження: {{registration.data.memberDate2}}</li>
                                <li class="info-item">Електрона адреса: {{registration.data.memberName2}}</li>
                                <li class="info-item">Ідентифікаційний номер: {{registration.data.idCode2}}</li>
                            </ul></div>
                            <div class="result-row"><h5 class="step-title">Інформація про мистецький заклад </h5>
                            <ul class="info-list">

                                <li class="info-item">Назва: {{registration.data.schoolName}}</li>
                                <li class="info-item">Телефон: {{registration.data.schoolPhone}}</li>
                                <li class="info-item">Адреса: {{registration.data.schoolAddress}}</li>
                                <li class="info-item">Електронна адреса: {{registration.data.schoolEmail}}</li>
                            </ul></div>
                            <div class="result-row"><h5 class="step-title">Інформація про викладача  </h5>
                            <ul class="info-list">
                                <li class="info-item">Прізвище, ім'я, по-батькові: {{registration.data.teacherSurname + ' ' + registration.data.teacherName + ' ' + registration.data.teacherPatronymic}}</li>
                                <li class="info-item">Контактний телефон: {{registration.data.teacherPhone}}</li>

                            </ul></div>
                            <div class="result-row"><h5 class="step-title">Прізвище, ім'я, по-батькові концертмейстера:  {{registration.data.concertSurname + ' ' + registration.data.concertName + ' ' + registration.data.concertPatronymic}}</h5></div>
                            <div class="result-row"><h5 class="step-title">Інформація про виступ </h5>
                            <ul class="info-list">
                                <li class="info-item">Назва та автор першого твору: {{registration.data.compositionName + ' ' + registration.data.compositionAuthor}}</li>
                                <li class="info-item">Назва та автор другого твору: {{registration.data.compositionName2 + ' ' + registration.data.compositionAuthor2}}</li>

                            </ul></div>
                            <div class="result-row  file-row" >

                                <div class="d-flex flex-column align-items-center file-item" v-for="file in registration.files"><img src="img/file.png" alt=""><span>{{file.name}}</span></div>
                                <!--<div class="d-flex flex-column file-item"><img src="img/file.png" alt=""><span>2</span></div>-->
                                <!--<div class="d-flex flex-column file-item"><img src="img/file.png" alt=""><span>3</span></div>-->
                            </div>
                            <div class="input-row checkbox-row result-checkbox">
                                <label for="concertmaster" >
                                    <input @change="concertmaster = !concertmaster" id="concertmaster" class="d-none" type="checkbox" >
                                    <i></i>
                                    <p>Даю згоду на збір <a href="">персональних даних та права на використання</a></p>
                                </label>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-5">

                                <span class="prev-step" @click="prevStep">Назад</span>
                                <button type="button" @click="sendApp" class="next-step">Зареєструватися</button>
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
                appTypes: ['', 'СОЛІСТ', 'ДУЕТ', 'АНСАМБЛЬ', 'ХОР', 'ОРКЕСТР'],
                nominations: ['', 'Інструментальний  жанр', 'Вокальний  жанр', 'Композиція'],

                fileTitle: {
                    memberBirthdayFile: 'завантажити файл',
                    member2BirthdayFile: 'завантажити файл',
                    idFile: 'завантажити файл',
                    idFile2: 'завантажити файл',
                    compositionVideo: 'завантажити файл',
                },
                steps: [
                    {
                        appType: 1,
                        nomination: 0,
                    }
                ],
                registration: {
                    data: {
                        appType: 1,
                        nomination: 0,
                        nomination2: '',
                        memberName: '',
                        memberSurname: '',
                        memberPatronymic: '',
                        memberDate: '',
                        groupName: '',
                        groupCount: '',
                        groupAverage: '',
                        idMemberType: 1,
                        parentName: '',
                        parentSurname: '',
                        parentPatronymic: '',
                        idCode: '',
                        memberName2: '',
                        memberSurname2: '',
                        memberPatronymic2: '',
                        memberDate2: '',
                        idMemberType2: 1,
                        parentName2: '',
                        parentSurname2: '',
                        parentPatronymic2: '',
                        idCode2: '',
                        schoolName: '',
                        schoolAddress: '',
                        schoolPhone: '',
                        teacherIdCode: '',
                        schoolEmail: '',
                        teacherSurname: '',
                        teacherName: '',
                        teacherPatronymic: '',
                        teacherEmail: '',
                        teacherPhone: '',
                        concertSurname: '',
                        concertName: '',
                        concertPatronymic: '',
                        compositionName: '',
                        compositionAuthor: '',
                        compositionName2: '',
                        compositionAuthor2: '',
                    },
                    files: {

                    }
                }
            };
        },

        created () {
            document.title = "Заповнити заявку";

        },
        computed: {

        },
        methods: {
            nextStep(){

                const steps = this.steps;
                this.$validator.validateAll().then((result) => {
                    if (!result) {
                        alert('form');
                        return
                    }
                    this.activeStep++;
                    steps[this.activeStep] = true;
                    console.log(this.registration);


                }).catch(() => {
                    console.log(2);

                });




            },
            prevStep(){
                // $event.preventDefault();
                const steps = this.steps;
                steps[this.activeStep] = false;
                this.activeStep--;



            },
            getInputFile(event){
                const input = event.target;
                const image = input.value.split('\\').pop();
                this.fileTitle[input.id] = image;
                this.registration.files[input.id] = input.files[0];

            },

            sendApp(){

                let formData = new FormData();
                formData.append('data', JSON.stringify(this.registration.data));

                for (let key in this.registration.files) {
                    formData.append('files['+key+']', this.registration.files[key])
                }

                axios.post('/send-app', formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    })
                    .then((response) => {
                        if(response.status == 200 ) {
                            this.$router.push({name: "index"});
                        }
                    })
                    .catch((error) => {
                        swal({
                            icon: "error",
                            title: 'Помилка',
                            text: error.response.status
                        });
                    });
            },


        },

    }
</script>