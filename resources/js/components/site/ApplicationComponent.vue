<template>
    <div>
        <template v-if="isRegistration">
        <section class="sections main-section applications">
            <div class="application-for-participation">
                <h2 class="title-section">Заявка на участь</h2>
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
                            <div class="input-group type-group">
                                <label><input type="radio" name="app-type" class="app-type" value="1"  v-model="registration.data.appType" ><i></i>СОЛІСТ</label>
                                <label><input type="radio" name="app-type" class="app-type" value="2" v-model="registration.data.appType"><i></i>ДУЕТ</label>
                                <label><input type="radio" name="app-type" class="app-type" value="3" v-model="registration.data.appType"><i></i>АНСАМБЛЬ</label>
                                <label><input type="radio" name="app-type" class="app-type" value="4" v-model="registration.data.appType"><i></i>ХОР</label>
                                <label><input type="radio" name="app-type" class="app-type" value="5" v-model="registration.data.appType"><i></i>ОРКЕСТР</label>


                            </div>
                            <div class="select-block">
                                <img src="img/star.png" class="star" alt="">
                                <select name="nomination" v-model="registration.data.nomination"
                                                 v-validate="{ required: true, regex: /^[1-3]$/ }"
                                                 data-vv-as="номінація"
                                                 id="" class="select" >
                                    <option disabled selected class="d-none" value="0">НОМІНАЦІЯ</option>
                                    <option v-for="(value, index) in nominations" :value="index + 1" :key="index">{{ value.name }}</option>
                                </select>
                            </div>

                            <span class="errors" v-if="errors.has('nomination')">
                                Номінація не обрана
                            </span>
                            <div class="text-right">
                                <button type="submit"  class="next-step">Далі <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </form>
                    </transition>

                    <!--step2-->

                    <transition name="fade">
                        <form class="step-form" v-if="activeStep == 1 && registration.data.appType == 1">
                        <!--<form class="step-form" v-if="activeStep == 1" >-->


                            <h3 class="step-title">Інформація про учасника</h3>
                            <label>ПРІЗВИЩЕ ІМ'Я ПО-БАТЬКОВІ</label>
                            <div class="input-row">

                                <div class="input-container">
                                    <img src="img/step2-user.png" alt="" class="input-img">
                                    <input type="text" name="memberSurname" id="memberSurname" v-model="registration.data.memberSurname" required
                                           v-validate="{ regex:/^([a-zа-яіїє'-]+){2,}$/i }"
                                           data-vv-as="ПРІЗВИЩЕ">
                                </div>

                                <!-- <label for="memberName">ІМ'Я</label> -->
                                <div class="input-container ml-4">
                                    <input type="text" name="memberName" id="memberName" v-model="registration.data.memberName" required
                                           v-validate="{ regex:/^([a-zа-яіїє'-]+){2,}$/i }"
                                           data-vv-as="ІМ'Я">
                                </div>
                                <!-- <label for="memberPatronymic">ПО-БАТЬКОВІ</label> -->
                                <div class="input-container ml-4">
                                    <input type="text" name="memberPatronymic" id="memberPatronymic" v-model="registration.data.memberPatronymic" required
                                           v-validate="{ regex:/^([a-zа-яіїє'-]+){5,}$/i }"
                                           data-vv-as="ПО-БАТЬКОВІ">
                                </div>

                            </div>
                            <span class="errors" v-if="errors.has('memberSurname')">
                                    Поле "Прізвище" має бути заповнене не менше, ніж 2 символами (вводити лише літери або тире)
                            </span>
                            <span class="errors" v-if="errors.has('memberName')">
                                    Поле "Ім’я" має бути заповнене не менше, ніж 2 символами (вводити лише літери або тире)
                            </span>
                            <span class="errors" v-if="errors.has('memberPatronymic')">
                                    Поле "По-батькові" має бути заповнене не менше, ніж 5 символами (вводити лише літери або тире)
                            </span>
                            <label>ДАТА НАРОДЖЕННЯ</label>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/step2-data.png" class="input-img">
                                    <date-picker
                                        v-model="registration.data.memberDate"
                                        value-type="YYYY-MM-DD"
                                        :lang="datepicker.lang"
                                        :default-value="datepicker.minDate"
                                        :disabled-date="rangeDate"
                                        :editable="false"
                                        :popup-style="datepicker.styles"
                                    ></date-picker>
                                    <input style="display:none" type="text" name="memberDate" v-model="registration.data.memberDate" required v-validate="{ regex: /^\d{4}[.\/-]\d{2}[.\/-]\d{2}$/ }">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('memberDate')">
                                    Поле "Дата народження" має бути заповнене
                            </span>
                            <label>ДОМАШНЯ АДРЕСА</label>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/input-map.png" alt="" class="input-img">
                                    <input name="memberAddress" type="text" v-model="registration.data.memberAddress"
                                        v-validate="{ required: true }"
                                           data-vv-as="ДОМАШНЯ АДРЕСА">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('memberAddress')">
                                    Поле "Домашня адреса" має бути заповнене
                            </span>
                            <label>ЕЛЕКТРОННА ПОШТА</label>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/input-mail.png" alt="" class="input-img">
                                    <input type="text" name="memberEmail" id="memberEmail" v-model="registration.data.memberEmail" required pattern="^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$"
                                        v-validate="{ regex: /^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/ }"
                                        data-vv-as="Електронна пошта">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('memberEmail')">
                                    Введіть дані у форматі name@email.com
                            </span>
                            <div class="d-flex align-items-center justify-content-between">
                                <h3 class="step-title title-left">ДОКУМЕНТ ПРО ПОСВІДЧЕННЯ ОСОБИ: <i class="hint"></i></h3>
                                <div class="input-group input-group-right">
                                    <label><input type="radio" name="id-passport-type" class="app-type" v-model="registration.data.idPassportType" value="0"><i></i>СВІДОЦТВО ПРО НАРОДЖЕННЯ</label>
                                    <label><input type="radio" name="id-passport-type" class="app-type" v-model="registration.data.idPassportType" value="1"><i></i>ПАСПОРТ</label>
                                </div>
                            </div>
                            <br>
                            <label v-if="registration.data.idPassportType == 0">ДАНІ СВІДОЦТВА ПРО НАРОДЖЕННЯ</label>
                            <label v-if="registration.data.idPassportType == 1">ПАСПОРТНІ ДАНІ</label>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/step2-data.png" alt="" class="input-img">
                                    <input type="text" name="passportData" id="passportData" v-model="registration.data.passportData"
                                           v-validate="{ required: true }">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('passportData') && registration.data.idPassportType == 0">
                                    Поле "ДАНІ СВІДОЦТВА ПРО НАРОДЖЕННЯ" має бути заповнене
                            </span>
                            <span class="errors" v-if="errors.has('passportData') && registration.data.idPassportType == 1">
                                    Поле "ПАСПОРТНІ ДАНІ" має бути заповнене
                            </span>
                            <h3 class="step-title">Відскановане свідоцтво про народження або паспорт за наявністю <i class="hint"></i></h3>
                            <div class="input-row">
                                <div class="input-container" v-if="fileTitle.memberBirthdayFile == null">

                                    <img src="img/file-image.png" alt="" class="input-img">

                                    <input @change="getInputFile" name="memberBirthdayFile" accept=".pdf, .jpg, .png, .gif" id="memberBirthdayFile" class="d-none" type="file" required
                                           v-validate="{ 'ext':['pdf', 'jpg', 'png', 'gif'] }"
                                           data-vv-as="Відскановане свідоцтво про народження або паспорт за наявністю">
                                    <label for="memberBirthdayFile">
                                        <span>{{fileTitle.memberBirthdayFile}}</span>
                                    </label>

                                </div>
                                <div class="input-container" v-if="fileTitle.memberBirthdayFile !== null">

                                    <img src="img/file-image.png" alt="" class="input-img">

                                    <input @change="getInputFile" name="memberBirthdayFile" accept=".pdf, .jpg, .png, .gif" id="memberBirthdayFile" class="d-none" type="file" required
                                           v-validate="{ 'ext':['pdf', 'jpg', 'png', 'gif'] }"
                                           data-vv-as="Відскановане свідоцтво про народження або паспорт за наявністю">
                                    <label for="memberBirthdayFile">
                                        <span>{{fileTitle.memberBirthdayFile}}</span>
                                    </label>

                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('memberBirthdayFile')">
                                    Оберіть файл графічного формату
                            </span>

                            <div class="d-flex align-items-center justify-content-between">
                                <h3 class="step-title title-left">ІДЕНТИФІКАЦІЙНИЙ НОМЕР: <i class="hint"></i></h3>
                                <div class="input-group input-group-right">
                                    <label><input type="radio" name="id-code-type" class="app-type" v-model="registration.data.idMemberType" value="0"><i></i>УЧНЯ</label>
                                    <label><input type="radio" name="id-code-type" class="app-type" v-model="registration.data.idMemberType" value="1"><i></i>ОДНОГО З БАТЬКІВ</label>
                                </div>
                            </div>
                            <div class="input-row" v-if="registration.data.idMemberType == 1">
                                <label v-if="registration.data.idMemberType == 1">ПРІЗВИЩЕ ІМ'Я ПО-БАТЬКОВІ</label>
                            </div>
                            <div class="input-row" v-if="registration.data.idMemberType == 1">
                                <div class="input-container">
                                    <img src="img/step2-user.png" alt="" class="input-img">
                                    <input type="text" name="parentSurname" v-model="registration.data.parentSurname" required
                                           v-validate="{ regex:/^([a-zа-яіїє'-]+){2,}$/i }">
                                </div>
                                <div class="input-container ml-4">
                                    <input type="text" name="parentName" v-model="registration.data.parentName" required
                                           v-validate="{ regex:/^([a-zа-яіїє'-]+){2,}$/i }">
                                </div>
                                <div class="input-container ml-4">
                                    <input type="text" name="parentPatronymic" v-model="registration.data.parentPatronymic" required
                                           v-validate="{ regex:/^([a-zа-яіїє'-]+){5,}$/i }">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('parentSurname')">
                                    Поле "Прізвище" має бути заповнене не менше, ніж 2 символами (вводити лише літери або тире)
                            </span>
                            <span class="errors" v-if="errors.has('parentName')">
                                    Поле "Ім’я" має бути заповнене не менше, ніж 2 символами (вводити лише літери або тире)
                            </span>
                            <span class="errors" v-if="errors.has('parentPatronymic')">
                                    Поле "По-батькові" має бути заповнене не менше, ніж 5 символами (вводити лише літери або тире)
                            </span>
                            <div class="input-row" v-if="registration.data.idMemberType == 1">
                                <label>ІДЕНТИФІКАЦІЙНИЙ НОМЕР ОДНОГО З БАТЬКІВ</label>
                            </div>
                            <div class="input-row" v-if="registration.data.idMemberType == 0">
                                <label>ІДЕНТИФІКАЦІЙНИЙ НОМЕР УЧНЯ</label>
                            </div>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/step2-data.png" alt="" class="input-img">
                                    <input type="text" name="idCode" id="idCode" maxlength="10" v-model="registration.data.idCode" required
                                           v-validate="{ regex: /^\d{10}$/ }">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('idCode')">
                                    Ідентифікаційний номер повинен містити 10 цифр
                            </span>
                            <h3 class="step-title">Копія документа <i class="hint"></i></h3>
                            <div class="input-row">
                                <div class="input-container" v-if="fileTitle.idFile == null">

                                    <img src="img/file-image.png" alt="" class="input-img">

                                    <input @change="getInputFile" name="idFile" id="idFile" class="d-none" type="file" accept="image/*" required
                                           v-validate="'image'">
                                    <label for="idFile">
                                        <span>{{fileTitle.idFile}}</span>
                                    </label>

                                </div>
                                <div class="input-container" v-if="fileTitle.idFile !== null">

                                    <img src="img/file-image.png" alt="" class="input-img">

                                    <input @change="getInputFile" name="idFile" id="idFile" accept="image/*" class="d-none" type="file" required
                                           v-validate="'image'">
                                    <label for="idFile">
                                        <span>{{fileTitle.idFile}}</span>
                                    </label>

                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('idFile')">
                                    Оберіть файл графічного формату
                            </span>

                            <div class="d-flex justify-content-between align-items-center mt-5">
                                <span class="prev-step" @click="prevStep($event)"><i class="fa fa-arrow-left"></i> Назад</span>
                                <button type="button" @click="nextStep" class="next-step">Далі <i class="fa fa-arrow-right"></i></button>
                            </div>

                        </form>

                        <!--duet-->

                        <form class="step-form" v-else-if="activeStep == 1 && registration.data.appType == 2">
                            <h3 class="step-title">Перший учасник дуету</h3>
                            <label>ПРІЗВИЩЕ ІМ'Я ПО-БАТЬКОВІ</label>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/step2-user.png" alt="" class="input-img">
                                    <input type="text" name="memberSurname" v-model="registration.data.memberSurname" required
                                        v-validate="{ regex:/^([a-zа-яіїє'-]+){2,}$/i }">
                                </div>
                                <div class="input-container ml-4">
                                    <input type="text" name="memberName" v-model="registration.data.memberName" required
                                        v-validate="{ regex:/^([a-zа-яіїє'-]+){2,}$/i }">
                                </div>
                                <div class="input-container ml-4">
                                    <input type="text" name="memberPatronymic" v-model="registration.data.memberPatronymic" required
                                        v-validate="{ regex:/^([a-zа-яіїє'-]+){5,}$/i }">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('memberSurname')">
                                    Поле "Прізвище" має бути заповнене не менше, ніж 2 символами (вводити лише літери або тире)
                            </span>
                            <span class="errors" v-if="errors.has('memberName')">
                                    Поле "Ім’я" має бути заповнене не менше, ніж 2 символами (вводити лише літери або тире)
                            </span>
                            <span class="errors" v-if="errors.has('memberPatronymic')">
                                    Поле "По-батькові" має бути заповнене не менше, ніж 5 символами (вводити лише літери або тире)
                            </span>
                            <label>Дата народження</label>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/step2-user.png" alt="" class="input-img">
                                    <date-picker
                                        v-model="registration.data.memberDate"
                                        value-type="YYYY-MM-DD"
                                        :lang="datepicker.lang"
                                        :default-value="datepicker.minDate"
                                        :disabled-date="rangeDate"
                                        :editable="false"
                                        :popup-style="datepicker.styles"
                                    ></date-picker>
                                    <input style="display:none" type="text" name="memberDate" v-model="registration.data.memberDate" required v-validate="{ regex: /^\d{4}[.\/-]\d{2}[.\/-]\d{2}$/ }">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('memberDate')">
                                    Поле "Дата народження" має бути заповнене
                            </span>
                            <label>ДОМАШНЯ АДРЕСА</label>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/input-map.png" alt="" class="input-img">
                                    <input name="memberAddress" type="text" v-model="registration.data.memberAddress"
                                        v-validate="{ required: true }"
                                           data-vv-as="ДОМАШНЯ АДРЕСА">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('memberAddress')">
                                    Поле "Домашня адреса" має бути заповнене
                            </span>
                            <label>Електронна пошта</label>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/input-mail.png" alt="" class="input-img">
                                    <input type="text" name="memberEmail1" id="memberEmail1" v-model="registration.data.memberEmail1" required pattern="^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$"
                                           v-validate="{ regex: /^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/ }"
                                           data-vv-as="Електронна пошта">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('memberEmail1')">
                                    Введіть дані у форматі name@email.com
                            </span>
                             <div class="d-flex align-items-center justify-content-between">
                                <h3 class="step-title title-left">ДОКУМЕНТ ПРО ПОСВІДЧЕННЯ ОСОБИ: <i class="hint"></i></h3>
                                <div class="input-group input-group-right">
                                    <label><input type="radio" name="id-passport-type" class="app-type" v-model="registration.data.idPassportType" value="0"><i></i>СВІДОЦТВО ПРО НАРОДЖЕННЯ</label>
                                    <label><input type="radio" name="id-passport-type" class="app-type" v-model="registration.data.idPassportType" value="1"><i></i>ПАСПОРТ</label>
                                </div>
                            </div>
                            <br>
                            <label v-if="registration.data.idPassportType == 0">ДАНІ СВІДОЦТВА ПРО НАРОДЖЕННЯ</label>
                            <label v-if="registration.data.idPassportType == 1">ПАСПОРТНІ ДАНІ</label>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/step2-data.png" alt="" class="input-img">
                                    <input type="text" name="passportData" id="passportData" v-model="registration.data.passportData"
                                           v-validate="{ required: true }">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('passportData') && registration.data.idPassportType == 0">
                                    Поле "ДАНІ СВІДОЦТВА ПРО НАРОДЖЕННЯ" має бути заповнене
                            </span>
                            <span class="errors" v-if="errors.has('passportData') && registration.data.idPassportType == 1">
                                    Поле "ПАСПОРТНІ ДАНІ" має бути заповнене
                            </span>
                            <h3 class="step-title">Відскановане свідоцтво про народження або паспорт за наявністю <i class="hint"></i></h3>
                            <div class="input-row">
                                <div class="input-container" v-if="fileTitle.memberBirthdayFile == null">

                                    <img src="img/file-image.png" alt="" class="input-img">

                                    <input @change="getInputFile" name="memberBirthdayFile" accept=".pdf, .jpg, .png, .gif" id="memberBirthdayFile" class="d-none" type="file" required
                                         v-validate="{ 'ext':['pdf', 'jpg', 'png', 'gif'] }">
                                    <label for="memberBirthdayFile">
                                        <span>{{fileTitle.memberBirthdayFile}}</span>
                                    </label>

                                </div>
                                <div class="input-container" v-if="fileTitle.memberBirthdayFile !== null">

                                    <img src="img/file-image.png" alt="" class="input-img">

                                    <input @change="getInputFile" name="memberBirthdayFile" accept="image/*" id="memberBirthdayFile" class="d-none" type="file" required
                                           v-validate="'image'">
                                    <label for="memberBirthdayFile">
                                        <span>{{fileTitle.memberBirthdayFile}}</span>
                                    </label>

                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('memberBirthdayFile')">
                                    Оберіть файл графічного формату
                            </span>
                            <div class="d-flex align-items-center justify-content-between">
                                <h3 class="step-title title-left">ІДЕНТИФІКАЦІЙНИЙ НОМЕР: <i class="hint"></i></h3>
                                <div class="input-group input-group-right">
                                    <label><input type="radio" name="id-code-type" class="app-type" v-model="registration.data.idMemberType" value="0"><i></i>УЧНЯ</label>
                                    <label><input type="radio" name="id-code-type" class="app-type" v-model="registration.data.idMemberType" value="1"><i></i>ОДНОГО З БАТЬКІВ</label>
                                </div>
                            </div>
                            <div class="input-row" v-if="registration.data.idMemberType == 1">
                                <label>ПРІЗВИЩЕ ІМ'Я ПО-БАТЬКОВІ</label>
                            </div>
                            <div class="input-row" v-if="registration.data.idMemberType == 1">
                                <div class="input-container">
                                    <img src="img/step2-user.png" alt="" class="input-img">
                                    <input type="text" name="parentSurname" v-model="registration.data.parentSurname" required
                                           v-validate="{ regex:/^([a-zа-яіїє'-]+){2,}$/i }">
                                </div>
                                <div class="input-container ml-4">
                                    <input type="text" name="parentName" v-model="registration.data.parentName" required
                                           v-validate="{ regex:/^([a-zа-яіїє'-]+){2,}$/i }">
                                </div>
                                <div class="input-container ml-4">
                                    <input type="text" name="parentPatronymic" v-model="registration.data.parentPatronymic" required
                                           v-validate="{ regex:/^([a-zа-яіїє'-]+){5,}$/i }">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('parentSurname')">
                                    Поле "Прізвище" має бути заповнене не менше, ніж 2 символами (вводити лише літери або тире)
                            </span>
                            <span class="errors" v-if="errors.has('parentName')">
                                    Поле "Ім’я" має бути заповнене не менше, ніж 2 символами (вводити лише літери або тире)
                            </span>
                            <span class="errors" v-if="errors.has('parentPatronymic')">
                                    Поле "По-батькові" має бути заповнене не менше, ніж 5 символами (вводити лише літери або тире)
                            </span>
                            <div class="input-row" v-if="registration.data.idMemberType == 1">
                                <label>ІДЕНТИФІКАЦІЙНИЙ НОМЕР ОДНОГО З БАТЬКІВ</label>
                            </div>
                            <div class="input-row" v-if="registration.data.idMemberType == 0">
                                <label>ІДЕНТИФІКАЦІЙНИЙ НОМЕР УЧНЯ</label>
                            </div>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/step2-data.png" alt="" class="input-img">
                                    <input type="text" name="idCode" maxlength="10" v-model="registration.data.idCode" required
                                        v-validate="{ regex: /^\d{10}$/ }">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('idCode')">
                                    Ідентифікаційний номер повинен містити 10 цифр
                            </span>
                            <h3 class="step-title">Копія документа <i class="hint"></i></h3>
                            <div class="input-row">
                                <div class="input-container" v-if="fileTitle.idFile == null">

                                    <img src="img/file-image.png" alt="" class="input-img">

                                    <input @change="getInputFile" name="idFile" accept="image/*" id="idFile" class="d-none" type="file" required
                                        v-validate="'image'">
                                    <label for="idFile">
                                        <span>{{fileTitle.idFile}}</span>
                                    </label>

                                </div>
                                <div class="input-container" v-if="fileTitle.idFile !== null">

                                    <img src="img/file-image.png" alt="" class="input-img">

                                    <input @change="getInputFile" name="idFile" accept="image/*" id="idFile" class="d-none" type="file" required
                                           v-validate="'image'">
                                    <label for="idFile">
                                        <span>{{fileTitle.idFile}}</span>
                                    </label>

                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('idFile')">
                                    Оберіть файл графічного формату
                            </span>
                            <h3 class="step-title">Другий учасник дуету</h3>
                            <label>ПРІЗВИЩЕ Ім’я по-батькові</label>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/step2-user.png" alt="" class="input-img">
                                    <input type="text" name="memberSurname2" v-model="registration.data.memberSurname2" required
                                        v-validate="{ regex:/^([a-za-zа-яіїє'-]+){2,}$/i }">
                                </div>
                                <div class="input-container ml-4">
                                    <input type="text" name="memberName2" v-model="registration.data.memberName2" required
                                        v-validate="{ regex:/^([a-za-zа-яіїє'-]+){2,}$/i }">
                                </div>
                                <div class="input-container ml-4">
                                    <input type="text" name="memberPatronymic2" v-model="registration.data.memberPatronymic2" required
                                        v-validate="{ regex:/^([a-za-zа-яіїє'-]+){5,}$/i }">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('memberSurname2')">
                                    Поле "Прізвище" має бути заповнене не менше, ніж 2 символами (вводити лише літери або тире)
                            </span>
                            <span class="errors" v-if="errors.has('memberName2')">
                                    Поле "ім’я" має бути заповнене не менше, ніж 2 символами (вводити лише літери або тире)
                            </span>
                            <span class="errors" v-if="errors.has('memberPatronymic2')">
                                    Поле "По-батькові" має бути заповнене не менше, ніж 5 символами (вводити лише літери або тире)
                            </span>
                            <label>ДАТА НАРОДЖЕННЯ</label>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/step2-data.png" class="input-img">
                                    <date-picker
                                        v-model="registration.data.memberDate2"
                                        value-type="YYYY-MM-DD"
                                        :lang="datepicker.lang"
                                        :default-value="datepicker.minDate"
                                        :disabled-date="rangeDate"
                                        :editable="false"
                                        :popup-style="datepicker.styles"
                                    ></date-picker>
                                    <input style="display:none" type="text" name="memberDate2" v-model="registration.data.memberDate2" required v-validate="{ regex: /^\d{4}[.\/-]\d{2}[.\/-]\d{2}$/ }">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('memberDate2')">
                                    Поле "Дата народження" має бути заповнене
                            </span>
                            <label>ДОМАШНЯ АДРЕСА</label>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/input-map.png" alt="" class="input-img">
                                    <input name="memberAddress2" type="text" v-model="registration.data.memberAddress2"
                                        v-validate="{ required: true }"
                                           data-vv-as="ДОМАШНЯ АДРЕСА">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('memberAddress2')">
                                    Поле "Домашня адреса" має бути заповнене
                            </span>
                            <label>ЕЛЕКТРОННА ПОШТА</label>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/input-mail.png" alt="" class="input-img">
                                    <input type="text" name="memberEmail2" v-model="registration.data.memberEmail2" required pattern="^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$"
                                           v-validate="{ regex: /^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/ }">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('memberEmail2')">
                                    Введіть дані у форматі name@email.com
                            </span>
                             <div class="d-flex align-items-center justify-content-between">
                                <h3 class="step-title title-left">ДОКУМЕНТ ПРО ПОСВІДЧЕННЯ ОСОБИ: <i class="hint"></i></h3>
                                <div class="input-group input-group-right">
                                    <label><input type="radio" name="id-passport-type2" class="app-type" v-model="registration.data.idPassportType2" value="0"><i></i>СВІДОЦТВО ПРО НАРОДЖЕННЯ</label>
                                    <label><input type="radio" name="id-passport-type2" class="app-type" v-model="registration.data.idPassportType2" value="1"><i></i>ПАСПОРТ</label>
                                </div>
                            </div>
                            <br>
                            <label v-if="registration.data.idPassportType2 == 0">ДАНІ СВІДОЦТВА ПРО НАРОДЖЕННЯ</label>
                            <label v-if="registration.data.idPassportType2 == 1">ПАСПОРТНІ ДАНІ</label>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/step2-data.png" alt="" class="input-img">
                                    <input type="text" name="passportData2" id="passportData2" v-model="registration.data.passportData2"
                                           v-validate="{ required: true }">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('passportData2') && registration.data.idPassportType2 == 0">
                                    Поле "ДАНІ СВІДОЦТВА ПРО НАРОДЖЕННЯ" має бути заповнене
                            </span>
                            <span class="errors" v-if="errors.has('passportData2') && registration.data.idPassportType2 == 1">
                                    Поле "ПАСПОРТНІ ДАНІ" має бути заповнене
                            </span>
                            <h3 class="step-title">Відскановане свідоцтво про народження або паспорт за наявністю <i class="hint"></i></h3>
                            <div class="input-row">
                                <div class="input-container" v-if="fileTitle.member2BirthdayFile == null">

                                    <img src="img/file-image.png" alt="" class="input-img">

                                    <input @change="getInputFile" name="member2BirthdayFile" accept=".pdf, .jpg, .png, .gif" id="member2BirthdayFile" class="d-none" type="file" required
                                        v-validate="{ 'ext':['pdf', 'jpg', 'png', 'gif'] }">
                                    <label for="member2BirthdayFile">
                                        <span>{{fileTitle.member2BirthdayFile}}</span>
                                    </label>

                                </div>
                                <div class="input-container" v-if="fileTitle.member2BirthdayFile !== null">

                                    <img src="img/file-image.png" alt="" class="input-img">

                                    <input @change="getInputFile" name="member2BirthdayFile" accept="image/*" id="member2BirthdayFile" class="d-none" type="file" required
                                           v-validate="'image'">
                                    <label for="member2BirthdayFile">
                                        <span>{{fileTitle.member2BirthdayFile}}</span>
                                    </label>

                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('member2BirthdayFile')">
                                    Оберіть файл графічного формату
                            </span>
                            <div class="d-flex align-items-center justify-content-between">
                                <h3 class="step-title title-left">ІДЕНТИФІКАЦІЙНИЙ НОМЕР: <i class="hint"></i></h3>
                                <div class="input-group input-group-right">
                                    <label><input type="radio" name="id-code-type2" class="app-type" v-model="registration.data.idMemberType2" value="0"><i></i>УЧНЯ</label>
                                    <label><input type="radio" name="id-code-type2" class="app-type" v-model="registration.data.idMemberType2" value="1"><i></i>ОДНОГО З БАТЬКІВ</label>
                                </div>
                            </div>
                            <div class="input-row" v-if="registration.data.idMemberType2 == 1">
                                <label>ПРІЗВИЩЕ ІМ'Я ПО-БАТЬКОВІ</label>
                            </div>
                            <div class="input-row" v-if="registration.data.idMemberType2 == 1">
                                <div class="input-container">
                                    <img src="img/step2-user.png" alt="" class="input-img">
                                    <input type="text" name="parentSurname2" v-model="registration.data.parentSurname2" required
                                           v-validate="{ regex:/^([a-za-zа-яіїє'-]+){2,}$/i }">
                                </div>
                                <div class="input-container ml-4">
                                    <input type="text" name="parentName2" v-model="registration.data.parentName2" required
                                           v-validate="{ regex:/^([a-za-zа-яіїє'-]+){2,}$/i }">
                                </div>
                                <div class="input-container ml-4">
                                    <input type="text" name="parentPatronymic2" v-model="registration.data.parentPatronymic2" required
                                           v-validate="{ regex:/^([a-za-zа-яіїє'-]+){5,}$/i }">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('parentSurname2')">
                                    Поле "Прізвище" має бути заповнене не менше, ніж 2 символами (вводити лише літери або тире)
                            </span>
                            <span class="errors" v-if="errors.has('parentName2')">
                                    Поле "Ім’я" має бути заповнене не менше, ніж 2 символами (вводити лише літери або тире)
                            </span>
                            <span class="errors" v-if="errors.has('parentPatronymic2')">
                                    Поле "По-батькові" має бути заповнене не менше, ніж 5 символами (вводити лише літери або тире)
                            </span>
                            <div class="input-row" v-if="registration.data.idMemberType2 == 1">
                                <label  >ІДЕНТИФІКАЦІЙНИЙ НОМЕР ОДНОГО З БАТЬКІВ</label>
                            </div>
                            <div class="input-row" v-if="registration.data.idMemberType2 == 0">
                                <label>ІДЕНТИФІКАЦІЙНИЙ НОМЕР УЧНЯ</label>
                            </div>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/step2-data.png" alt="" class="input-img">
                                    <input type="text" name="idCode2" maxlength="10" v-model="registration.data.idCode2" required
                                        v-validate="{ regex: /^\d{10}$/ }">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('idCode2')">
                                    Ідентифікаційний номер повинен містити 10 цифр
                            </span>
                            <h3 class="step-title">Копія документа <i class="hint"></i></h3>
                            <div class="input-row">
                                <div class="input-container" v-if="fileTitle.idFile2 == null">

                                    <img src="img/file-image.png" alt="" class="input-img">

                                    <input @change="getInputFile" name="idFile2" accept="image/*" id="idFile2" class="d-none" type="file" required
                                        v-validate="'image'">
                                    <label for="idFile2">
                                        <span>{{fileTitle.idFile2}}</span>
                                    </label>

                                </div>
                                <div class="input-container" v-if="fileTitle.idFile2 !== null">

                                    <img src="img/file-image.png" alt="" class="input-img">

                                    <input @change="getInputFile" name="idFile2" accept="image/*" id="idFile2" class="d-none" type="file" required
                                           v-validate="'image'">
                                    <label for="idFile2">
                                        <span>{{fileTitle.idFile2}}</span>
                                    </label>

                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('idFile2')">
                                    Оберіть файл графічного формату
                            </span>

                            <div class="d-flex justify-content-between align-items-center mt-5">
                                <span class="prev-step" @click="prevStep($event)"><i class="fa fa-arrow-left"></i> Назад</span>
                                <button type="button" @click="nextStep" class="next-step">Далі <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </form>

                        <!--group-->

                        <form class="step-form" v-else-if="activeStep == 1 && registration.data.appType > 2">
                            <h3 class="step-title">Інформація про колектив</h3>
                            <label>НАЗВА КОЛЕКТИВУ</label>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/step2-user.png" alt="" class="input-img">
                                    <input type="text" name="groupName" v-model="registration.data.groupName"
                                        v-validate="{ required: true }"
                                           data-vv-as="НАЗВА КОЛЕКТИВУ">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('groupName')">
                                    Поле має бути заповнене
                            </span>
                            <label>КІЛЬКІСТЬ УЧАСНИКІВ</label>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/step2-data.png" alt="" class="input-img">
                                    <input type="text" name="groupCount" v-model="registration.data.groupCount" required
                                        v-validate="{ regex: /^[0-9]{1,2}$/ }">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('groupCount')">
                                    Введіть корректні дані в діапазоні від 1 до 99
                            </span>
                            <label>СЕРЕДНІЙ ВІК УЧАСНИКІВ</label>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/step2-data.png" alt="" class="input-img">
                                    <input type="text" name="groupAverage" v-model="registration.data.groupAverage" required
                                        v-validate="{ regex: /^(([8-9]{1}|1[0-6])(?:[.,][0-9]{1,})?\r?|17)$/ }">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('groupAverage')">
                                    Введіть корректні дані в діапазоні від 8 до 17
                            </span>
                            <h3 class="step-title">Документ з датами народження учасників <i class="hint"></i></h3>
                            <div class="input-row">
                                <div class="input-container" v-if="fileTitle.groupBirthdayFile == null">

                                    <img src="img/file-image.png" alt="" class="input-img">

                                    <input @change="getInputFile" name="groupBirthdayFile" accept=".txt, .doc, .docx, .pdf" id="groupBirthdayFile" class="d-none" type="file" required
                                        v-validate="{ 'ext':['pdf', 'doc', 'txt', 'docx'] }">
                                    <label for="groupBirthdayFile">
                                        <span>{{fileTitle.groupBirthdayFile}}</span>
                                    </label>

                                </div>
                                <div class="input-container" v-if="fileTitle.groupBirthdayFile !== null">

                                    <img src="img/file-image.png" alt="" class="input-img">

                                    <input @change="getInputFile" name="groupBirthdayFile" id="groupBirthdayFile" accept=".txt, .doc, .docx, .pdf" class="d-none" type="file" required
                                           v-validate="{ 'ext':['pdf', 'doc', 'txt', 'docx'] }">
                                    <label for="groupBirthdayFile">
                                        <span>{{fileTitle.groupBirthdayFile}}</span>
                                    </label>

                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('groupBirthdayFile')">
                                    Файл повинен відповідати формату: pdf, doc, txt, docx
                            </span>

                            <div class="d-flex justify-content-between align-items-center mt-5">
                                <span class="prev-step" @click="prevStep($event)"><i class="fa fa-arrow-left"></i> Назад</span>
                                <button type="button" @click="nextStep" class="next-step">Далі <i class="fa fa-arrow-right"></i></button>
                            </div>

                        </form>

                    </transition>

                    <!--step3-->

                    <transition name="fade" >
                        <form class="step-form" v-if="activeStep == 2">
                            <h3 class="step-title">Інформація про УЧБОВИЙ ЗАКЛАД </h3>
                            <label>НАЗВА</label>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/input-castle.png" alt="" class="input-img" >
                                    <input name="school_name" type="text" v-model="registration.data.school.school_name"
                                        v-validate="{ required: true }"
                                            data-vv-as="НАЗВА">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('school_name')">
                                    Введіть корректні дані
                            </span>
                            <label>АДРЕСА</label>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/input-map.png" alt="" class="input-img">
                                    <input name="school_address" type="text" v-model="registration.data.school.school_address"
                                        v-validate="{ required: true }"
                                           data-vv-as="АДРЕСА">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('school_address')">
                                    Введіть корректні дані
                            </span>
                            <label>ТЕЛЕФОН</label>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/step2-data.png" alt="" class="input-img">

                                    <input type="text" name="school_phone" maxlength="13" v-model="registration.data.school.school_phone"
                                        v-validate="{ required: true, regex: /^((\+380)(\d{9})|(\d{6,13}))$/ }">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('school_phone')">
                                    Введіть номер мобільного телефону у форматі +380 або стаціонарного телефону - від 6 до 13 символів (вводити лише цифри)
                            </span>
                            <label>ЕЛЕКТРОННА ПОШТА</label>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/step2-data.png" alt="" class="input-img">
                                    <input type="text" name="school_email" v-model="registration.data.school.school_email" required
                                        v-validate="{ regex: /^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/ }"
                                           data-vv-as="E-MAIL">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('school_email')">
                                Введіть дані у форматі name@email.com
                            </span>

                            <div v-for="(teacher, index) in registration.data.teachers" :key="index">
                                <div class="row">
                                    <div class="col-11">
                                        <h3 class="step-title">Інформація про ВИКЛАДАЧА</h3>
                                    </div>
                                    <div class="col-1 text-right mt-0">
                                        <span v-if="index != 0" class="prev-step" @click="deleteTeacher(index)"><i class="fa fa-times" aria-hidden="true"></i></span>
                                    </div>
                                </div>
                                <label>ПРІЗВИЩЕ Ім’я по-батькові</label>
                                <div class="input-row">
                                    <div class="input-container">
                                        <img src="img/step2-user.png" class="input-img">
                                        <input :name="'teacher_surname_'+index" type="text" v-model="teacher.teacher_surname" required
                                            v-validate="{ regex:/^([a-za-zа-яіїє'-]+){2,}$/i }">
                                    </div>
                                    <div class="input-container ml-4">
                                        <input :name="'teacher_name_'+index" type="text" v-model="teacher.teacher_name" required
                                            v-validate="{ regex:/^([a-za-zа-яіїє'-]+){2,}$/i }">
                                    </div>
                                    <div class="input-container ml-4">
                                        <input :name="'teacher_patronymic_'+index" type="text" v-model="teacher.teacher_patronymic" required
                                            v-validate="{ regex:/^([a-za-zа-яіїє'-]+){5,}$/i }">
                                    </div>
                                </div>
                                <span class="errors" v-if="errors.has('teacher_surname_'+index)">
                                        Поле "Прізвище" має бути заповнене не менше, ніж 2 символами (вводити лише літери або тире)
                                </span>
                                <span class="errors" v-if="errors.has('teacher_name_'+index)">
                                        Поле "Ім'я" має бути заповнене не менше, ніж 2 символами (вводити лише літери або тире)
                                </span>
                                <span class="errors" v-if="errors.has('teacher_patronymic_'+index)">
                                        Поле "По-батькові" має бути заповнене не менше, ніж 5 символами (вводити лише літери або тире)
                                </span>
                                <label>Домашня адреса</label>
                                <div class="input-row">
                                    <div class="input-container">
                                        <img src="img/input-map.png" class="input-img">
                                        <input :name="'teacher_address_'+index" type="text" v-model="teacher.teacher_address" required>
                                    </div>
                                </div>
                                <span class="errors" v-if="errors.has('teacher_address_'+index)">
                                    Поле "Домашня адреса" має бути заповнене
                                </span>
                                <label>Електрона пошта</label>
                                <div class="input-row">
                                    <div class="input-container">
                                        <img src="img/input-mail.png" class="input-img">
                                        <input :name="'teacher_email_'+index" type="text" v-model="teacher.teacher_email" required
                                            v-validate="{ regex: /^([a-zA-Z0-9_-]+\.)*[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)*\.[a-z]{2,6}$/ }">
                                    </div>
                                </div>
                                <span class="errors" v-if="errors.has('teacher_email_'+index)">
                                        Введіть дані у форматі name@email.com
                                </span>
                                <label>ІДЕНТИФІКАЦІЙНИЙ НОМЕР КЕРІВНИКА</label>
                                <div class="input-row">
                                    <div class="input-container">
                                        <img src="img/step2-data.png" class="input-img">
                                        <input :name="'teacher_id_code_'+index" type="text" maxlength="10" v-model="teacher.teacher_in" required
                                            v-validate="{ regex: /^\d{10}$/ }">
                                    </div>
                                </div>
                                <span class="errors" v-if="errors.has('teacher_id_code_'+index)">
                                    Ідентифікаційний номер повинен містити 10 цифр
                                </span>
                                <div class="d-flex align-items-center justify-content-between">
                                    <h3 class="step-title title-left">ДОКУМЕНТ ПРО ПОСВІДЧЕННЯ ОСОБИ: <i class="hint"></i></h3>
                                    <div class="input-group input-group-right">
                                        <label><input type="radio" :name="'teacher_passport_type'+index" class="app-type" v-model="teacher.id_passport_type" value="0"><i></i>СВІДОЦТВО ПРО НАРОДЖЕННЯ</label>
                                        <label><input type="radio" :name="'teacher_passport_type'+index" class="app-type" v-model="teacher.id_passport_type" value="1"><i></i>ПАСПОРТ</label>
                                    </div>
                                </div>
                                <br>
                                <label v-if="teacher.id_passport_type == 0">ДАНІ СВІДОЦТВА ПРО НАРОДЖЕННЯ</label>
                                <label v-if="teacher.id_passport_type == 1">ПАСПОРТНІ ДАНІ</label>
                                <div class="input-row">
                                    <div class="input-container">
                                        <img src="img/step2-data.png" class="input-img">
                                        <input type="text" :name="'teacher_passport_data_'+index" :id="'teacher_passport_data_'+index" v-model="teacher.teacher_passport_data"
                                            v-validate="{ required: true }">
                                    </div>
                                </div>
                                <span class="errors" v-if="errors.has('teacher_passport_data_'+index) && teacher.id_passport_type == 0">
                                        Поле "ДАНІ СВІДОЦТВА ПРО НАРОДЖЕННЯ" має бути заповнене
                                </span>
                                <span class="errors" v-if="errors.has('teacher_passport_data_'+index) && teacher.id_passport_type == 1">
                                    Поле "ПАСПОРТНІ ДАНІ" має бути заповнене
                                </span>

                                <h3 class="step-title">Відскановане свідоцтво про народження або паспорт за наявністю <i class="hint"></i></h3>
                                <div class="input-row">
                                    <div class="input-container" v-if="teacher.teacher_passport == null">
                                        <img src="img/file-image.png" class="input-img">
                                        <input @change="getInputTeacherFile($event, index)" :name="'teacher_passport_'+index" accept=".pdf, .jpg, .png, .gif" :id="'teacher_passport_'+index" class="d-none" type="file" required
                                            v-validate="{ 'ext':['pdf', 'jpg', 'png', 'gif'] }"
                                            data-vv-as="Відскановане свідоцтво про народження або паспорт за наявністю">
                                        <label :for="'teacher_passport_'+index">
                                            <span>{{teacher.teacher_passport}}</span>
                                        </label>
                                    </div>
                                    <div class="input-container" v-if="teacher.teacher_passport !== null">
                                        <img src="img/file-image.png" class="input-img">
                                        <input @change="getInputTeacherFile($event, index)" :name="'teacher_passport_'+index" accept=".pdf, .jpg, .png, .gif" :id="'teacher_passport_'+index" class="d-none" type="file" required
                                            v-validate="{ 'ext':['pdf', 'jpg', 'png', 'gif'] }"
                                            data-vv-as="Відскановане свідоцтво про народження або паспорт за наявністю">
                                        <label :for="'teacher_passport_'+index">
                                            <span>{{teacher.teacher_passport}}</span>
                                        </label>
                                    </div>
                                </div>
                                <span class="errors" v-if="errors.has('teacher_passport_'+index)">
                                    Оберіть файл графічного формату
                                </span>
                                <label>КОНТАКТНИЙ ТЕЛЕФОН ВИКЛАДАЧА</label>
                                <div class="input-row">
                                    <div class="input-container">
                                        <img src="img/input-phone.png" class="input-img">
                                        <input type="text" :name="'teacher_phone_'+index" maxlength="13" v-model="teacher.teacher_phone"
                                            v-validate="{ required: true, regex: /^((\+380)(\d{9})|(\d{6,13}))$/ }">
                                    </div>
                                </div>
                                <span class="errors" v-if="errors.has('teacher_phone_'+index)">
                                    Введіть номер мобільного телефону у форматі +380 або стаціонарного телефону - від 6 до 13 символів (вводити лише цифри)
                                </span>
                                <hr>
                            </div>
                            <br>
                            <button type="button" @click="addTeacher()" style="width: 100%" class="next-step">Додати викладача</button>
                            <br>
                            <div class="input-row checkbox-row">
                                    <label for="concertmaster" >
                                        <input @change="concertmaster = !concertmaster" id="concertmaster" class="d-none" type="checkbox" >
                                        <i></i>
                                        В мене є концертмейстер
                                    </label>
                            </div>
                            <label v-if="concertmaster"> ПРІЗВИЩЕ Ім’я по-батькові</label>
                            <div class="input-row" v-if="concertmaster">
                                <div class="input-container">
                                    <img src="img/step2-user.png" alt="" class="input-img">
                                    <input type="text" name="concertmaster_surname" v-model="registration.data.school.concertmaster_surname" required
                                        v-validate="{ regex:/^([a-za-zа-яіїє'-]+){2,}$/i }">
                                </div>
                                <div class="input-container ml-4">
                                    <input type="text" name="concertmaster_name" v-model="registration.data.school.concertmaster_name" required
                                        v-validate="{ regex:/^([a-za-zа-яіїє'-]+){2,}$/i }">
                                </div>
                                <div class="input-container ml-4">
                                    <input type="text" name="concertmaster_patronymic" v-model="registration.data.school.concertmaster_patronymic" required
                                        v-validate="{ regex:/^([a-za-zа-яіїє'-]+){5,}$/i }">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('concertmaster_surname')">
                                    Поле "Прізвище" має бути заповнене не менше, ніж 2 символами (вводити лише літери або тире)
                            </span>
                            <span class="errors" v-if="errors.has('concertmaster_name')">
                                    Поле "Ім'я" має бути заповнене не менше, ніж 2 символами (вводити лише літери або тире)
                            </span>
                            <span class="errors" v-if="errors.has('concertmaster_patronymic')">
                                    Поле "По-батькові" має бути заповнене не менше, ніж 5 символами (вводити лише літери або тире)
                            </span>
                            <div class="d-flex justify-content-between align-items-center mt-5">
                                <span class="prev-step" @click="prevStep($event)"><i class="fa fa-arrow-left"></i> Назад</span>
                                <button type="button" @click="nextStep" class="next-step">Далі <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </form>
                    </transition>

                    <!--step4-->

                    <transition name="fade" >
                        <form class="step-form" v-if="activeStep == 3">
                            <h3 class="step-title">Інформація про ВИСТУП</h3>
                            <h3 class="step-title">перший твір</h3>
                            <label>НАЗВА</label>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/input-composition.png" alt="" class="input-img">
                                    <input type="text" name="compositionName" v-model="registration.data.compositionName"
                                        v-validate="{ required: true }"
                                           data-vv-as="НАЗВА">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('compositionName')">
                                    Введіть корректні дані
                            </span>
                            <label>АВТОР</label>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/input-author.png" alt="" class="input-img">
                                    <input type="text" name="compositionAuthor" v-model="registration.data.compositionAuthor"
                                        v-validate="{ required: true }"
                                           data-vv-as="АВТОР">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('compositionAuthor')">
                                    Введіть корректні дані
                            </span>
                            <label>ХРОНОМЕТРАЖ</label>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/input-composition.png" alt="" class="input-img">
                                    <input type="text" name="timing1" v-model="registration.data.timing1" maxlength="5"
                                           v-validate="{ required: true, regex: /^([0-5][0-9])(:([0-5][0-9]))$/ }"
                                           data-vv-as="ХРОНОМЕТРАЖ">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('timing1')">
                                    Введіть дані у форматі 00:00 (хвилини-секунди)
                            </span>
                            <h3 class="step-title">Другий твір</h3>
                            <label>НАЗВА</label>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/input-composition.png" alt="" class="input-img">
                                    <input type="text" name="compositionName2" v-model="registration.data.compositionName2"
                                        v-validate="{ required: true }"
                                           data-vv-as="НАЗВА">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('compositionName2')">
                                    Введіть корректні дані
                            </span>
                            <label>АВТОР</label>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/input-author.png" alt="" class="input-img">
                                    <input type="text" name="compositionAuthor2" v-model="registration.data.compositionAuthor2"
                                        v-validate="{ required: true }"
                                           data-vv-as="АВТОР">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('compositionAuthor2')">
                                    Введіть корректні дані
                            </span>
                            <label>ХРОНОМЕТРАЖ</label>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/input-composition.png" alt="" class="input-img">
                                    <input type="text" name="timing2" v-model="registration.data.timing2" maxlength="5"
                                           v-validate="{ required: true, regex: /^([0-5][0-9])(:([0-5][0-9]))$/ }"
                                           data-vv-as="ХРОНОМЕТРАЖ">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('timing2')">
                                    Введіть дані у форматі 00:00 (хвилини-секунди)
                            </span>
                            <h4 class="step-title">ВИ ПОВИННІ ЗАВАНТАЖИТИ ОДИН ФАЙЛ, ЯКИЙ БУДЕ МІСТИТИ 2 ВІДЕО<i class="hint"></i></h4>
                            <div class="input-row">
                                <div class="input-container" v-if="fileTitle.compositionVideo == null">

                                    <img src="img/input-video.png" alt="" class="input-img">

                                    <input @change="getInputFile" name="compositionVideo" accept=".ogm, .ogg, .3pg, .wmv, .mpg, .webm, .ogv, .mov, .asx, .mpeg, .mp4, .m4v, .avi, .mkv, .asf" id="compositionVideo" class="d-none" type="file" required
                                        v-validate="{'ext':['ogm', 'ogg', '3pg', 'wmv', 'mpg', 'webm', 'ogv', 'mov', 'asx', 'mpeg', 'mp4', 'm4v', 'avi', 'mkv', 'asf'], size: 102400}">
                                    <label for="compositionVideo">
                                        <span>{{fileTitle.compositionVideo}}</span>
                                    </label>

                                </div>
                                <div class="input-container" v-if="fileTitle.compositionVideo !== null">

                                    <img src="img/input-video.png" alt="" class="input-img">

                                    <input @change="getInputFile" name="compositionVideo" id="compositionVideo" accept=".ogm, .3pg, .wmv, .mpg, .webm, .ogv, .mov, .asx, .mpeg, .mp4, .m4v, .avi, .mkv, .asf" class="d-none" type="file" required
                                           v-validate="{'ext':['ogm', 'ogg', '3pg', 'wmv', 'mpg', 'webm', 'ogv', 'mov', 'asx', 'mpeg', 'mp4', 'm4v', 'avi', 'mkv', 'asf'], size: 102400}">
                                    <label for="compositionVideo">
                                        <span>{{fileTitle.compositionVideo}}</span>
                                    </label>

                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('compositionVideo')">
                                    Оберіть файл відео-формату розміром не більше 100 Мб
                            </span>
                            <div class="d-flex justify-content-between align-items-center mt-5">
                                <span class="prev-step" @click="prevStep($event)"><i class="fa fa-arrow-left"></i> Назад</span>
                                <button type="button" @click="nextStep" class="next-step">Далі <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </form>
                    </transition>

                    <!--step5-->

                    <transition name="fade">

                        <form class="step-form" v-if="activeStep == 4 && registration.data.appType == 1">

                            <div class="result-row"><h5 class="step-title">Тип заявки: {{appTypes[registration.data.appType]}}</h5></div>
                            <div class="result-row"><h5 class="step-title">Номінація: {{nominations[registration.data.nomination -1].name}}</h5></div>
                            <div class="result-row">
                                <h5 class="step-title">Вікова категорія:
                                    <span v-if="registration.data.ageCategory >= 8 && registration.data.ageCategory <= 10">молодша</span>
                                    <span v-if="registration.data.ageCategory >= 11 && registration.data.ageCategory <= 13">середня</span>
                                    <span v-if="registration.data.ageCategory >= 14 && registration.data.ageCategory <= 19">старша</span>
                                </h5>
                            </div>
                            <div class="result-row"><h5 class="step-title">Інформація про учасника </h5>
                            <ul class="info-list">
                                <li class="info-item">Прізвище, ім'я, по-батькові: {{registration.data.memberName + ' ' + registration.data.memberSurname + ' ' + registration.data.memberPatronymic}}</li>
                                <li class="info-item">Число, місяці, рік народження: {{registration.data.memberDate}}</li>
                                <li class="info-item">Електрона адреса: {{registration.data.memberEmail}}</li>
                                <li class="info-item">Ідентифікаційний номер: {{registration.data.idCode}}</li>
                            </ul></div>
                            <div class="result-row"><h5 class="step-title">Інформація про мистецький заклад </h5>
                            <ul class="info-list">

                                <li class="info-item">Назва: {{registration.data.school.school_name}}</li>
                                <li class="info-item">Телефон: {{registration.data.school.school_phone}}</li>
                                <li class="info-item">Адреса: {{registration.data.school.school_address}}</li>
                                <li class="info-item">Електронна адреса: {{registration.data.school.school_email}}</li>
                            </ul></div>
                            <div class="result-row"><h5 class="step-title">Інформація про викладача</h5>
                                <ul class="info-list" v-for="(teacher, index) in registration.data.teachers" :key="index">
                                    <li class="info-item">Прізвище, ім'я, по-батькові: {{teacher.teacher_surname + ' ' + teacher.teacher_name + ' ' + teacher.teacher_patronymic}}</li>
                                    <li class="info-item">Контактний телефон: {{teacher.teacher_phone}}</li>
                                </ul>
                            </div>
                            <div class="result-row" v-if="concertmaster"><h5 class="step-title">Прізвище, ім'я, по-батькові концертмейстера:  {{registration.data.school.concertmaster_surname + ' ' + registration.data.school.concertmaster_name + ' ' + registration.data.school.concertmaster_patronymic}}</h5></div>
                            <div class="result-row"><h5 class="step-title">Інформація про виступ </h5>
                            <ul class="info-list">
                                <li class="info-item">Назва та автор першого твору: {{registration.data.compositionName + ' ' + registration.data.compositionAuthor}}</li>
                                <li class="info-item">Хронометраж першого твору: {{ registration.data.timing1 }}</li>
                                <li class="info-item">Назва та автор другого твору: {{registration.data.compositionName2 + ' ' + registration.data.compositionAuthor2}}</li>
                                <li class="info-item">Хронометраж другого твору: {{ registration.data.timing2 }}</li>
                            </ul></div>
                            <div class="result-row  file-row" >

                                <div class="d-flex flex-column align-items-center file-item" v-for="(file, index) in registration.files" :key="index"><img src="img/file.png" alt=""><span>{{file.name}}</span></div>
                                <!--<div class="d-flex flex-column file-item"><img src="img/file.png" alt=""><span>2</span></div>-->
                                <!--<div class="d-flex flex-column file-item"><img src="img/file.png" alt=""><span>3</span></div>-->
                            </div>
                            <div class="input-row checkbox-row result-checkbox">
                                <label for="groupCheck1" >
                                    <input @change="checked = !checked" name="groupCheck1" id="groupCheck1" class="d-none" type="checkbox" v-validate="{ required: true }">
                                    <i></i>
                                    <p>Даю згоду на збір <a :href="personal.personal_data" target="_blank">персональних даних та права на використання</a></p>
                                </label>
                            </div>
                            <span class="errors" v-if="!checked">
                                    Для оформлення заявки ви повинні дати згоду на збір даних
                            </span>
                            <div class="d-flex justify-content-between align-items-center mt-5">

                                <span class="prev-step" @click="prevStep($event)"><i class="fa fa-arrow-left"></i> Назад</span>
                                <button type="button" :disabled="!checked" @click="sendApp" class="next-step">Зареєструвати заяву</button>
                            </div>
                        </form>

                        <form class="step-form" v-if="activeStep == 4 && registration.data.appType == 2">

                            <div class="result-row"><h5 class="step-title">Тип заявки: {{appTypes[registration.data.appType]}}</h5></div>
                            <div class="result-row"><h5 class="step-title">Номінація: {{nominations[registration.data.nomination -1].name}}</h5></div>
                            <div class="result-row">
                                <h5 class="step-title">Вікова категорія:
                                    <span v-if="registration.data.ageCategory >= 8 && registration.data.ageCategory <= 10">молодша</span>
                                    <span v-if="registration.data.ageCategory >= 11 && registration.data.ageCategory <= 13">середня</span>
                                    <span v-if="registration.data.ageCategory >= 14 && registration.data.ageCategory <= 19">старша</span>
                                </h5>
                            </div>
                            <div class="result-row"><h5 class="step-title">Інформація про першого учасника </h5>
                                <ul class="info-list">
                                    <li class="info-item">Прізвище, ім'я, по-батькові: {{registration.data.memberName + ' ' + registration.data.memberSurname + ' ' + registration.data.memberPatronymic}}</li>
                                    <li class="info-item">Число, місяці, рік народження: {{registration.data.memberDate}}</li>
                                    <li class="info-item">Електрона адреса: {{registration.data.memberEmail1}}</li>
                                    <li class="info-item">Ідентифікаційний номер: {{registration.data.idCode}}</li>
                                </ul></div>
                            <div class="result-row"><h5 class="step-title">Інформація про другого учасника </h5>
                                <ul class="info-list">
                                    <li class="info-item">Прізвище, ім'я, по-батькові: {{registration.data.memberName2 + ' ' + registration.data.memberSurname2 + ' ' + registration.data.memberPatronymic2}}</li>
                                    <li class="info-item">Число, місяці, рік народження: {{registration.data.memberDate2}}</li>
                                    <li class="info-item">Електрона адреса: {{registration.data.memberEmail2}}</li>
                                    <li class="info-item">Ідентифікаційний номер: {{registration.data.idCode2}}</li>
                                </ul></div>
                            <div class="result-row"><h5 class="step-title">Інформація про мистецький заклад </h5>
                                <ul class="info-list">

                                    <li class="info-item">Назва: {{registration.data.school.school_name}}</li>
                                    <li class="info-item">Телефон: {{registration.data.school.school_phone}}</li>
                                    <li class="info-item">Адреса: {{registration.data.school.school_address}}</li>
                                    <li class="info-item">Електронна адреса: {{registration.data.school.school_email}}</li>
                                </ul></div>
                            <div class="result-row"><h5 class="step-title">Інформація про викладача  </h5>
                                <ul class="info-list" v-for="(teacher, index) in registration.data.teachers" :key="index">
                                    <li class="info-item">Прізвище, ім'я, по-батькові: {{teacher.teacher_surname + ' ' + teacher.teacher_name + ' ' + teacher.teacher_patronymic}}</li>
                                    <li class="info-item">Контактний телефон: {{teacher.teacher_phone}}</li>
                                </ul>
                            </div>
                            <div class="result-row" v-if="concertmaster"><h5 class="step-title">Прізвище, ім'я, по-батькові концертмейстера:  {{registration.data.school.concertmaster_surname + ' ' + registration.data.school.concertmaster_name + ' ' + registration.data.school.concertmaster_patronymic}}</h5></div>
                            <div class="result-row"><h5 class="step-title">Інформація про виступ </h5>
                                <ul class="info-list">
                                    <li class="info-item">Назва та автор першого твору: {{registration.data.compositionName + ' ' + registration.data.compositionAuthor}}</li>
                                    <li class="info-item">Хронометраж першого твору: {{ registration.data.timing1 }}</li>
                                    <li class="info-item">Назва та автор другого твору: {{registration.data.compositionName2 + ' ' + registration.data.compositionAuthor2}}</li>
                                    <li class="info-item">Хронометраж другого твору: {{ registration.data.timing2 }}</li>
                                </ul></div>
                            <div class="result-row  file-row" >

                                <div class="d-flex flex-column align-items-center file-item" v-for="(file, index) in registration.files" :key="index"><img src="img/file.png" alt=""><span>{{file.name}}</span></div>
                                <!--<div class="d-flex flex-column file-item"><img src="img/file.png" alt=""><span>2</span></div>-->
                                <!--<div class="d-flex flex-column file-item"><img src="img/file.png" alt=""><span>3</span></div>-->
                            </div>
                            <div class="input-row checkbox-row result-checkbox">
                                <label for="groupCheck2" >
                                    <input @change="checked = !checked" name="groupCheck2" id="groupCheck2" class="d-none" type="checkbox" v-validate="{ required: true }">
                                    <i></i>
                                    <p>Даю згоду на збір <a :href="personal.personal_data" target="_blank">персональних даних та права на використання</a></p>
                                </label>
                            </div>
                            <span class="errors" v-if="!checked">
                                    Для оформлення заявки ви повинні дати згоду на збір даних
                            </span>
                            <div class="d-flex justify-content-between align-items-center mt-5">

                                <span class="prev-step" @click="prevStep($event)"><i class="fa fa-arrow-left"></i> Назад</span>
                                <button type="button" :disabled="!checked" @click="sendApp" class="next-step">Зареєструватися</button>
                            </div>
                        </form>

                        <form class="step-form" v-if="activeStep == 4 && registration.data.appType > 2">

                            <div class="result-row"><h5 class="step-title">Тип заявки: {{appTypes[registration.data.appType]}}</h5></div>
                            <div class="result-row"><h5 class="step-title">Номінація: {{nominations[registration.data.nomination -1].name}}</h5></div>
                            <div class="result-row">
                                <h5 class="step-title">Вікова категорія:
                                    <span v-if="registration.data.ageCategory >= 8 && registration.data.ageCategory <= 10">молодша</span>
                                    <span v-if="registration.data.ageCategory >= 11 && registration.data.ageCategory <= 13">середня</span>
                                    <span v-if="registration.data.ageCategory >= 14 && registration.data.ageCategory <= 19">старша</span>
                                </h5>
                            </div>
                            <div class="result-row"><h5 class="step-title">Інформація про колектив</h5>
                                <ul class="info-list">

                                    <li class="info-item">Назва колективу та кількість учасників: {{registration.data.groupName + ', ' + registration.data.groupCount}}</li>
                                    <li class="info-item">Середній вік учасників: {{registration.data.groupAverage}}</li>
                                </ul></div>
                            <div class="result-row"><h5 class="step-title">Інформація про керівника</h5>
                                <ul class="info-list" v-for="(teacher, index) in registration.data.teachers" :key="index">
                                    <li class="info-item">Прізвище, ім'я, по-батькові керівника: {{teacher.teacher_surname + ' ' + teacher.teacher_name + ' ' + teacher.teacher_patronymic}}</li>
                                    <li class="info-item">Контактний телефон керівника: {{teacher.teacher_phone}}</li>
                                    <li class="info-item">Ідентифікаційний номер керівника: {{teacher.teacher_in}}</li>
                                    <li class="info-item">Електронна пошта керівника: {{teacher.teacher_email}}</li>
                                </ul>
                            </div>
                            <div class="result-row" v-if="concertmaster"><h5 class="step-title">Прізвище, ім'я, по-батькові концертмейстера:  {{registration.data.school.concertmaster_surname + ' ' + registration.data.school.concertmaster_name + ' ' + registration.data.school.concertmaster_patronymic}}</h5></div>
                            <div class="result-row"><h5 class="step-title">Інформація про мистецький заклад </h5>
                                <ul class="info-list">

                                    <li class="info-item">Назва: {{registration.data.school.school_name}}</li>
                                    <li class="info-item">Телефон: {{registration.data.school.school_phone}}</li>
                                    <li class="info-item">Адреса: {{registration.data.school.school_address}}</li>
                                    <li class="info-item">Електронна адреса: {{registration.data.school.school_email}}</li>
                                </ul></div>
                            <div class="result-row"><h5 class="step-title">Інформація про виступ </h5>
                                <ul class="info-list">
                                    <li class="info-item">Назва та автор першого твору: {{registration.data.compositionName + ' ' + registration.data.compositionAuthor}}</li>
                                    <li class="info-item">Хронометраж першого твору: {{ registration.data.timing1 }}</li>
                                    <li class="info-item">Назва та автор другого твору: {{registration.data.compositionName2 + ' ' + registration.data.compositionAuthor2}}</li>
                                    <li class="info-item">Хронометраж другого твору: {{ registration.data.timing2 }}</li>
                                </ul></div>
                            <div class="result-row  file-row" >

                                <div class="d-flex flex-column align-items-center file-item" v-for="(file, index) in registration.files" :key="index"><img src="img/file.png" alt=""><span>{{file.name}}</span></div>
                                <!--<div class="d-flex flex-column file-item"><img src="img/file.png" alt=""><span>2</span></div>-->
                                <!--<div class="d-flex flex-column file-item"><img src="img/file.png" alt=""><span>3</span></div>-->
                            </div>
                            <div class="input-row checkbox-row result-checkbox">
                                <label for="groupCheck3" >
                                    <input @change="checked = !checked" name="groupCheck3" id="groupCheck3" class="d-none" type="checkbox" v-validate="{ required: true }">
                                    <i></i>
                                    <p>Даю згоду на збір <a :href="personal.personal_data" target="_blank">персональних даних та права на використання</a></p>
                                </label>
                            </div>
                            <span class="errors" v-if="!checked">
                                    Для оформлення заявки ви повинні дати згоду на збір даних
                            </span>
                            <div class="d-flex justify-content-between align-items-center mt-5">

                                <span class="prev-step" @click="prevStep($event)"><i class="fa fa-arrow-left"></i> Назад</span>
                                <button type="button" :disabled="!checked" @click="sendApp" class="next-step">Зареєструватися</button>
                            </div>
                        </form>
                    </transition>
                    <div v-if="preloader" class="preloader">
                        <img src="img/JV.gif" alt="">
                    </div>
                </div>
            </div>

        </section>
        </template>
        <template v-else>
            <h1>Сторінка недоступна</h1>
        </template>

    </div>
</template>

<script>
    import DatePicker from 'vue2-datepicker';
    import 'vue2-datepicker/index.css';

    const nowDate = new Date();

    export default {
        components: {
            DatePicker
        },
        data() {
            return {
                checkDate: {
                    date1: true
                },
                steps: [true, false, false, false, false],
                activeStep: 0,
                birthdayFile: 'завантажити файл',
                preloader: false,
                concertmaster: false,
	            checked: false,
                appTypes: ['', 'СОЛІСТ', 'ДУЕТ', 'АНСАМБЛЬ', 'ХОР', 'ОРКЕСТР'],
                nominations: [],
	            personal: {
		            personal_data: ''
                },
                datepicker: {
                    minDate: new Date(nowDate.getFullYear()-18 + '-' + nowDate.getMonth()+1 + '-' + nowDate.getDate()).setHours(0, 0, 0, 0),
                    maxDate: new Date(nowDate.getFullYear()-8 + '-' + nowDate.getMonth()+1 + '-' + nowDate.getDate()).setHours(0, 0, 0, 0),
                    lang: {
                        formatLocale: {
                            months: ['Січень', 'Лютий', 'Березень', 'Квітень', 'Травень', 'Червень', 'Липень', 'Серпень', 'Вересень', 'Жовтень', 'Листопад', 'Грудень'],
                            monthsShort: ['Січень', 'Лютий', 'Березень', 'Квітень', 'Травень', 'Червень', 'Липень', 'Серпень', 'Вересень', 'Жовтень', 'Листопад', 'Грудень'],
                            weekdays: ["Неділя", "Понеділок", "Вівторок", "Середа", "Четвер", "П'ятниця", "Субота"],
                            weekdaysShort: ['ПН', 'ВТ', 'СР', 'ЧТ', 'ПТ', 'СБ', 'НД'],
                            weekdaysMin: ['ПН', 'ВТ', 'СР', 'ЧТ', 'ПТ', 'СБ', 'НД']
                        }
                    },
                    styles: { left: '30%' }
                },
                fileTitle: {
                    memberBirthdayFile: 'завантажити файл',
                    member2BirthdayFile: 'завантажити файл',
                    groupBirthdayFile: 'завантажити файл',
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
                        memberName: 'Миша',
                        memberSurname: 'Отрощенко',
                        memberPatronymic: 'Сергеевич',
                        memberDate: '2002-01-24',
                        memberAddress: 'Суми, село Миколаївка',
                        passportData: 'test',
                        passportData2: '',
	                    memberEmail: 'mishaotroshenko2013@gmail.com',
	                    memberEmail1: '',
	                    memberEmail2: '',
                        groupName: '',
                        groupCount: '',
                        groupAverage: '',
                        idPassportType: 1,
                        idMemberType: 1,
                        parentName: 'Михайло',
                        parentSurname: 'Отрощенко',
                        parentPatronymic: 'Сергійович',
                        idCode: '1234567890',
                        memberName2: '',
                        memberSurname2: '',
                        memberPatronymic2: '',
                        memberDate2: '',
                        memberAddress2: '',
                        idMemberType2: 1,
                        idPassportType2: 1,
                        parentName2: '',
                        parentSurname2: '',
                        parentPatronymic2: '',
                        idCode2: '',

                        school: {
                            school_name: 'Миколаївський НВК',
                            school_address: 'Суми, село Миколаївка',
                            school_phone: '+380994692170',
                            school_email: 'mishaotroshenko2013@gmail.com',
                            concertmaster_name: '',
                            concertmaster_surname: '',
                            concertmaster_patronymic: ''
                        },

                        teachers: [
                            {
                                teacher_name: 'Михайло',
                                teacher_surname: 'Отрощенко',
                                teacher_patronymic: 'Сергійович',
                                teacher_in: '1234567890',
                                teacher_email: 'mishaotroshenko2013@gmail.com',
                                teacher_phone: '+380994692170',
                                teacher_passport_data: 'fdfds',
                                teacher_address: 'Суми, село Миколаївка',
                                id_passport_type: 1,
                                teacher_passport: 'завантажити файл'
                            }
                        ],

                        compositionName: 'gfdfsfds',
                        compositionAuthor: 'fdsfdsf',
                        compositionName2: 'fdsfds',
                        compositionAuthor2: 'fdsfds',
	                    nameAgeCategory: '',
                        ageCategory: 0,
                    },
                    files: {

                    }
                },
                isRegistration: false,
            };
        },

        created () {
            document.title = "Заповнити заявку";
            this.getNominations();
            this.isOpenedRegistration();
	        this.getPersonal();

        },
        methods: {
            addTeacher() {
                this.registration.data.teachers.push({
                    teacher_name: '',
                    teacher_surname: '',
                    teacher_patronymic: '',
                    teacher_in: '',
                    teacher_email: '',
                    teacher_phone: '',
                    teacher_passport_data: '',
                    teacher_address: '',
                    id_passport_type: 1,
                    teacher_passport: 'завантажити файл'
                });
            },
            deleteTeacher(index) {
                this.registration.data.teachers.splice(index, 1);
            },
            rangeDate(date) {
                return date <= this.datepicker.minDate || date >= this.datepicker.maxDate;
            },
            isOpenedRegistration() {
                axios
                    .get('/is-opened-registration')
                    .then( ( response ) => {
                        this.isRegistration = response.data;
                        if ( !this.isRegistration ) {
                           swal("Увага", "На даний момент подача заявок зупинена." ,"info")
                                .then( ( value ) => {
                                    this.$router.push({name: "index"});
                                });
                        }
                    })
                    .catch( ( error ) => console.error(error) )
            },
            getNominations() {
                axios.get('/get-nominations')
                .then((response) => {
                    this.nominations = response.data;
                })
            },
            nextStep(){
                const steps = this.steps;
                this.$validator.validateAll().then((result) => {
                    if (!result) {

                        return
                    }
                    this.activeStep++;
                    steps[this.activeStep] = true;
                    if(this.registration.data.memberDate != '' && this.registration.data.memberDate2 == '') {
                        this.registration.data.ageCategory = this.getAge(this.registration.data.memberDate);

                        if(this.registration.data.ageCategory >= 8 && this.registration.data.ageCategory <= 10) {
	                        this.registration.data.nameAgeCategory = 'молодша';
                        }
                        else if(this.registration.data.ageCategory >= 11 && this.registration.data.ageCategory <= 13) {
	                        this.registration.data.nameAgeCategory = 'середня';
                        }
                        else if(this.registration.data.ageCategory >= 14 && this.registration.data.ageCategory <= 19) {
	                        this.registration.data.nameAgeCategory = 'старша';
                        }
                    }
                    else if(this.registration.data.memberDate != '' && this.registration.data.memberDate2 != '') {
                        this.registration.data.ageCategory = (this.getAge(this.registration.data.memberDate) + this.getAge(this.registration.data.memberDate2)) / 2;

	                    if(this.registration.data.ageCategory >= 8 && this.registration.data.ageCategory <= 10) {
		                    this.registration.data.nameAgeCategory = 'молодша';
	                    }
	                    else if(this.registration.data.ageCategory >= 11 && this.registration.data.ageCategory <= 13) {
		                    this.registration.data.nameAgeCategory = 'середня';
	                    }
	                    else if(this.registration.data.ageCategory >= 14 && this.registration.data.ageCategory <= 19) {
		                    this.registration.data.nameAgeCategory = 'старша';
	                    }
                    }
                    else if(this.registration.data.memberDate == '' && this.registration.data.memberDate2 == '') {
                        this.registration.data.ageCategory = this.registration.data.groupAverage;

	                    if(this.registration.data.ageCategory >= 8 && this.registration.data.ageCategory <= 10) {
		                    this.registration.data.nameAgeCategory = 'молодша';
	                    }
	                    else if(this.registration.data.ageCategory >= 11 && this.registration.data.ageCategory <= 13) {
		                    this.registration.data.nameAgeCategory = 'середня';
	                    }
	                    else if(this.registration.data.ageCategory >= 14 && this.registration.data.ageCategory <= 19) {
		                    this.registration.data.nameAgeCategory = 'старша';
	                    }
                    }
                    console.log(this.registration.data)
                }).catch((err) => {
                    console.log(err);
                });

            },

            getAge(dateString) {
                var today = new Date();
                var birthDate = new Date(dateString);
                var age = today.getFullYear() - birthDate.getFullYear();
                var m = today.getMonth() - birthDate.getMonth();
                if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }
                return age;
            },

	        getPersonal() {
		        axios.get('/get-personal-doc')
			        .then((response) => {
				        response.data.personal.map(item => {
					        Object.assign(this.personal, item);
				        })
			        })
	        },

            prevStep(event){
                event.preventDefault();
                this.checked = false;
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

            getInputTeacherFile(event, index){
                const input = event.target;
                this.registration.data.teachers[index].teacher_passport = input.files[0].name;
                this.registration.data.teachers[index].teacher_passport_index = 'teacher_passport_'+index;
                this.registration.files['teacher_passport_'+index] = input.files[0];
            },

            sendApp(){
                let formData = new FormData();
                formData.append('data', JSON.stringify(this.registration.data));

                for (let key in this.registration.files) {
                    formData.append(key, this.registration.files[key])
                }
                this.preloader = !this.preloader;
                axios.post('/send-app', formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    })
                    .then((response) => {
                        this.preloader = false;
                        if(response.status == 200 ) {
                            swal("“Дякуємо за реєстрацію! Лист з даними\n" + "відправлено на вашу зазначену електронну адресу.”", {
                                icon: "success",
                            });
                            this.$router.push({name: "index"});
                        }
                        else{
                            this.preloader = !this.preloader;
                        }

                    })

                    .catch((error) => {
                        this.preloader = false;
                        swal({
                            icon: "error",
                            title: 'Помилка',
                            text: String(error.response.status)
                        });
                    });
            },
        },
    }
</script>
<style scoped lang="sass">
    .preloader
        display: flex
        justify-content: center
        align-items: center
        width: 100%
        height: 100%
        position: fixed
        top: 0
        left: 0
        background: rgba(0,0,0,0.8)
</style>
<style>
    .mx-icon-calendar {
        display: none;
    }
    .mx-datepicker {
        width: 100%;
    }
    .mx-date-row .active {
        background: #4B0082 !important;
    }
    .mx-input {
        height: 54px;
        border-radius: 0;
    }
</style>
