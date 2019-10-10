<template>
    <div>
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
                                <button type="submit"  class="next-step">Далі</button>
                            </div>
                        </form>
                    </transition>

                    <!--step2-->

                    <transition name="fade">
                        <form class="step-form" v-if="activeStep == 1 && registration.data.appType == 1">
                        <!--<form class="step-form" v-if="activeStep == 1" >-->


                            <h3 class="step-title">Інформація про учасника 222</h3>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/step2-user.png" alt="" class="input-img">
                                    <input type="text" name="memberSurname" placeholder="ПРІЗВИЩЕ" v-model="registration.data.memberSurname" required
                                           v-validate="{ regex: /^([a-zа-яіїє']+){2,}$/i }"
                                           data-vv-as="ПРІЗВИЩЕ">
                                </div>

                                <div class="input-container ml-4">
                                    <input type="text" name="memberName" placeholder="ІМ'Я" v-model="registration.data.memberName" required
                                           v-validate="{ regex: /^([a-zа-яіїє']+){2,}$/i }"
                                           data-vv-as="ІМ'Я">
                                </div>
                                <div class="input-container ml-4">
                                    <input type="text" name="memberPatronymic" placeholder="ПО-БАТЬКОВІ" v-model="registration.data.memberPatronymic" required
                                           v-validate="{ regex: /^([a-zа-яіїє']+){5,}$/i }"
                                           data-vv-as="ПО-БАТЬКОВІ">
                                </div>

                            </div>
                            <span class="errors" v-if="errors.has('memberSurname')">
                                    Поле "прізвище" повинно бути заповнене
                            </span>
                            <span class="errors" v-if="errors.has('memberName')">
                                    Поле "ім’я" повинно бути заповнене
                            </span>
                            <span class="errors" v-if="errors.has('memberPatronymic')">
                                    Поле "по-батькові" повинно бути заповнене
                            </span>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/step2-data.png" alt="" class="input-img">
                                    <input type="text" name="memberDate" placeholder="ЧИСЛО, МІСЯЦЬ, РІК НАРОДЖЕННЯ у форматі 01-12-2000" v-model="registration.data.memberDate" required pattern="[0-9]{2}.[0-9]{2}.[0-9]{4}"
                                           v-validate="{ regex: /[0-9]{2}-[0-9]{2}-[0-9]{4}/ }"
                                           data-vv-as="ЧИСЛО, МІСЯЦЬ, РІК НАРОДЖЕННЯ у форматі 01-12-2000">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('memberDate')">
                                    Введіть дані у форматі ХХ-ХХ-ХХХХ
                            </span>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/input-mail.png" alt="" class="input-img">
                                    <input type="text" name="memberEmail" placeholder="Електронна пошта" v-model="registration.data.memberEmail" required pattern="^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$"
                                        v-validate="{ regex: /^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/ }"
                                        data-vv-as="Електронна пошта">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('memberEmail')">
                                    Введіть дані у форматі name@email.com
                            </span>
                            <h3 class="step-title">Відскановане свідоцтво про народження або паспорт за наявністю <i class="hint"></i></h3>
                            <div class="input-row">
                                <div class="input-container">

                                    <img src="img/file-image.png" alt="" class="input-img">

                                    <input @change="getInputFile" name="memberBirthdayFile" id="memberBirthdayFile" class="d-none" type="file"
                                           v-validate="{ required: true}"
                                           data-vv-as="Відскановане свідоцтво про народження або паспорт за наявністю">
                                    <label for="memberBirthdayFile">
                                        <span>{{fileTitle.memberBirthdayFile}}</span>
                                    </label>

                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('memberBirthdayFile')">
                                    Файл не обрано
                            </span>

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
                                    <input type="text" name="parentSurname" placeholder="ПРІЗВИЩЕ " v-model="registration.data.parentSurname" required
                                           v-validate="{ regex: /^([a-zа-яіїє']+){2,}$/i }"
                                           data-vv-as="ПРІЗВИЩЕ">
                                </div>
                                <div class="input-container ml-4">
                                    <input type="text" name="parentName" placeholder="ІМ'Я  " v-model="registration.data.parentName" required
                                           v-validate="{ regex: /^([a-zа-яіїє']+){2,}$/i }"
                                           data-vv-as="ІМ'Я">
                                </div>
                                <div class="input-container ml-4">
                                    <input type="text" name="parentPatronymic" placeholder="ПО-БАТЬКОВІ  " v-model="registration.data.parentPatronymic" required
                                           v-validate="{ regex: /^([a-zа-яіїє']+){5,}$/i }"
                                           data-vv-as="ПО-БАТЬКОВІ">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('parentSurname')">
                                    Поле "прізвище" повинно бути заповнене
                            </span>
                            <span class="errors" v-if="errors.has('parentName')">
                                    Поле "ім’я" повинно бути заповнене
                            </span>
                            <span class="errors" v-if="errors.has('parentPatronymic')">
                                    Поле "по-батькові" повинно бути заповнене
                            </span>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/step2-data.png" alt="" class="input-img">
                                    <input type="text" name="idCode" :placeholder="registration.data.idMemberType == 1 ? 'ІДЕНТИФІКАЦІЙНИЙ НОМЕР ОДНОГО З БАТЬКІВ' : 'ІДЕНТИФІКАЦІЙНИЙ НОМЕР УЧНЯ'" v-model="registration.data.idCode" required
                                           v-validate="{ regex: /[0-9]{10}/ }"
                                           data-vv-as="ІДЕНТИФІКАЦІЙНИЙ НОМЕР">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('idCode')">
                                    Ідентифікаційний номер повинен містити 10 цифр
                            </span>
                            <h3 class="step-title">Копія документа <i class="hint"></i></h3>
                            <div class="input-row">
                                <div class="input-container">

                                    <img src="img/file-image.png" alt="" class="input-img">

                                    <input @change="getInputFile" name="idFile" id="idFile" class="d-none" type="file"
                                           v-validate="{ required: true}"
                                           data-vv-as="КОПІЯ ДОКУМЕНТА">
                                    <label for="idFile">
                                        <span>{{fileTitle.idFile}}</span>
                                    </label>

                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('idFile')">
                                    Файл не обрано
                            </span>
                            <div class="d-flex justify-content-between align-items-center mt-5">
                                <span class="prev-step" @click="prevStep">Назад</span>
                                <button type="button" @click="nextStep" class="next-step">Далі</button>
                            </div>

                        </form>

                        <!--duet-->

                        <form class="step-form" v-else-if="activeStep == 1 && registration.data.appType == 2">
                            <h3 class="step-title">Перший учасник дуету 22222</h3>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/step2-user.png" alt="" class="input-img">
                                    <input type="text" name="memberSurname" placeholder="ПРІЗВИЩЕ" v-model="registration.data.memberSurname" required
                                        v-validate="{ regex: /^([a-zа-яіїє']+){2,}$/i }"
                                            data-vv-as="ПРІЗВИЩЕ">
                                </div>
                                <div class="input-container ml-4">
                                    <input type="text" name="memberName" placeholder="ІМ'Я" v-model="registration.data.memberName" required
                                        v-validate="{ regex: /^([a-zа-яіїє']+){2,}$/i }"
                                            data-vv-as="ІМ'Я">
                                </div>
                                <div class="input-container ml-4">
                                    <input type="text" name="memberPatronymic" placeholder="ПО-БАТЬКОВІ" v-model="registration.data.memberPatronymic" required
                                        v-validate="{ regex: /^([a-zа-яіїє']+){5,}$/i }"
                                            data-vv-as="ПО-БАТЬКОВІ">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('memberSurname')">
                                    Поле "прізвище" повинно бути заповнене
                            </span>
                            <span class="errors" v-if="errors.has('memberName')">
                                    Поле "ім’я" повинно бути заповнене
                            </span>
                            <span class="errors" v-if="errors.has('memberPatronymic')">
                                    Поле "по-батькові" повинно бути заповнене
                            </span>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/step2-data.png" alt="" class="input-img">
                                    <input type="text" name="memberDate" placeholder="ЧИСЛО, МІСЯЦЬ, РІК НАРОДЖЕННЯ у форматі 01-12-2000" v-model="registration.data.memberDate" required pattern="[0-9]{2}.[0-9]{2}.[0-9]{4}"
                                        v-validate="{ regex: /[0-9]{2}-[0-9]{2}-[0-9]{4}/ }"
                                           data-vv-as="ЧИСЛО, МІСЯЦЬ, РІК НАРОДЖЕННЯ у форматі 01-12-2000">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('memberDate')">
                                    Введіть дані у форматі ХХ-ХХ-ХХХХ
                            </span>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/input-mail.png" alt="" class="input-img">
                                    <input type="text" name="memberEmail1" placeholder="Електронна пошта" v-model="registration.data.memberEmail1" required pattern="^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$"
                                           v-validate="{ regex: /^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/ }"
                                           data-vv-as="Електронна пошта">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('memberEmail1')">
                                    Введіть дані у форматі name@email.com
                            </span>
                            <h3 class="step-title">Відскановане свідоцтво про народження або паспорт за наявністю <i class="hint"></i></h3>
                            <div class="input-row">
                                <div class="input-container">

                                    <img src="img/file-image.png" alt="" class="input-img">

                                    <input @change="getInputFile" name="memberBirthdayFile" id="memberBirthdayFile" class="d-none" type="file" 
                                         v-validate="{ required: true }"
                                           data-vv-as="Відскановане свідоцтво про народження або паспорт за наявністю">
                                    <label for="memberBirthdayFile">
                                        <span>{{fileTitle.memberBirthdayFile}}</span>
                                    </label>

                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('memberBirthdayFile')">
                                    Файл не обрано
                            </span>
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
                                    <input type="text" name="parentSurname" placeholder="ПРІЗВИЩЕ " v-model="registration.data.parentSurname" required
                                           v-validate="{ regex: /^([a-zа-яіїє']+){2,}$/i }"
                                           data-vv-as="ПРІЗВИЩЕ">
                                </div>
                                <div class="input-container ml-4">
                                    <input type="text" name="parentName" placeholder="ІМ'Я  " v-model="registration.data.parentName" required
                                           v-validate="{ regex: /^([a-zа-яіїє']+){2,}$/i }"
                                           data-vv-as="ІМ'Я">
                                </div>
                                <div class="input-container ml-4">
                                    <input type="text" name="parentPatronymic" placeholder="ПО-БАТЬКОВІ  " v-model="registration.data.parentPatronymic" required
                                           v-validate="{ regex: /^([a-zа-яіїє']+){5,}$/i }"
                                           data-vv-as="ПО-БАТЬКОВІ">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('parentSurname')">
                                    Поле "прізвище" повинно бути заповнене
                            </span>
                            <span class="errors" v-if="errors.has('parentName')">
                                    Поле "ім’я" повинно бути заповнене
                            </span>
                            <span class="errors" v-if="errors.has('parentPatronymic')">
                                    Поле "по-батькові" повинно бути заповнене
                            </span>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/step2-data.png" alt="" class="input-img">
                                    <input type="text" name="idCode" :placeholder="registration.data.idMemberType == 1 ? 'ІДЕНТИФІКАЦІЙНИЙ НОМЕР ОДНОГО З БАТЬКІВ' : 'ІДЕНТИФІКАЦІЙНИЙ НОМЕР УЧНЯ'" v-model="registration.data.idCode" required
                                        v-validate="{ regex: /[0-9]{10}/ }"
                                            data-vv-as="ІДЕНТИФІКАЦІЙНИЙ НОМЕР">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('idCode')">
                                    Ідентифікаційний номер повинен містити 10 цифр
                            </span>
                            <h3 class="step-title">Копія документа <i class="hint"></i></h3>
                            <div class="input-row">
                                <div class="input-container">

                                    <img src="img/file-image.png" alt="" class="input-img">

                                    <input @change="getInputFile" name="idFile" id="idFile" class="d-none" type="file" 
                                        v-validate="{ required: true }"
                                            data-vv-as="КОПІЯ ДОКУМЕНТА">
                                    <label for="idFile">
                                        <span>{{fileTitle.idFile}}</span>
                                    </label>

                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('idFile')">
                                    Файл не обрано
                            </span>
                            <h3 class="step-title">Другий учасник дуету</h3>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/step2-user.png" alt="" class="input-img">
                                    <input type="text" name="memberSurname2" placeholder="ПРІЗВИЩЕ" v-model="registration.data.memberSurname2" required
                                        v-validate="{ regex: /^([a-zа-яіїє']+){2,}$/i }"
                                            data-vv-as="ПРІЗВИЩЕ">
                                </div>
                                <div class="input-container ml-4">
                                    <input type="text" name="memberName2" placeholder="ІМ'Я" v-model="registration.data.memberName2" required
                                        v-validate="{ regex: /^([a-zа-яіїє']+){2,}$/i }"
                                            data-vv-as="ІМ'Я">
                                </div>
                                <div class="input-container ml-4">
                                    <input type="text" name="memberPatronymic2" placeholder="ПО-БАТЬКОВІ" v-model="registration.data.memberPatronymic2" required
                                        v-validate="{ regex: /^([a-zа-яіїє']+){5,}$/i }"
                                            data-vv-as="ПО-БАТЬКОВІ">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('memberSurname2')">
                                    Поле "прізвище" повинно бути заповнене
                            </span>
                            <span class="errors" v-if="errors.has('memberName2')">
                                    Поле "ім’я" повинно бути заповнене
                            </span>
                            <span class="errors" v-if="errors.has('memberPatronymic2')">
                                    Поле "по-батькові" повинно бути заповнене
                            </span>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/step2-data.png" alt="" class="input-img">
                                    <input type="text" name="memberDate2" placeholder="ЧИСЛО, МІСЯЦЬ, РІК НАРОДЖЕННЯ у форматі 01-12-2000" v-model="registration.data.memberDate2" required pattern="[0-9]{2}.[0-9]{2}.[0-9]{4}"
                                        v-validate="{ regex: /[0-9]{2}-[0-9]{2}-[0-9]{4}/ }"
                                           data-vv-as="ЧИСЛО, МІСЯЦЬ, РІК НАРОДЖЕННЯ у форматі 01-12-2000">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('memberDate2')">
                                    Введіть дані у форматі ХХ-ХХ-ХХХХ
                            </span>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/input-mail.png" alt="" class="input-img">
                                    <input type="text" name="memberEmail2" placeholder="Електронна пошта" v-model="registration.data.memberEmail2" required pattern="^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$"
                                           v-validate="{ regex: /^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/ }"
                                           data-vv-as="Електронна пошта">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('memberEmail2')">
                                    Введіть дані у форматі name@email.com
                            </span>
                            <h3 class="step-title">Відскановане свідоцтво про народження або паспорт за наявністю <i class="hint"></i></h3>
                            <div class="input-row">
                                <div class="input-container">

                                    <img src="img/file-image.png" alt="" class="input-img">

                                    <input @change="getInputFile" name="member2BirthdayFile" id="member2BirthdayFile" class="d-none" type="file" 
                                        v-validate="{ required: true }"
                                           data-vv-as="Відскановане свідоцтво про народження або паспорт за наявністю">
                                    <label for="member2BirthdayFile">
                                        <span>{{fileTitle.member2BirthdayFile}}</span>
                                    </label>

                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('member2BirthdayFile')">
                                    Файл не обрано
                            </span>
                            <div class="d-flex align-items-center justify-content-between">
                                <h3 class="step-title title-left">ІДЕНТИФІКАЦІЙНИЙ НОМЕР: <i class="hint"></i></h3>
                                <div class="input-group input-group-right">
                                    <label><input type="radio" name="id-code-type2" class="app-type" v-model="registration.data.idMemberType2" value="0"><i></i>УЧНЯ</label>
                                    <label><input type="radio" name="id-code-type2" class="app-type" v-model="registration.data.idMemberType2" value="1"><i></i>ОДНОГО З БАТЬКІВ</label>
                                </div>
                            </div>
                            <div class="input-row" v-if="registration.data.idMemberType2 == 1">
                                <div class="input-container">
                                    <img src="img/step2-user.png" alt="" class="input-img">
                                    <input type="text" name="parentSurname2" placeholder="ПРІЗВИЩЕ " v-model="registration.data.parentSurname2" required
                                           v-validate="{ regex: /^([a-zа-яіїє']+){2,}$/i }"
                                           data-vv-as="ПРІЗВИЩЕ">
                                </div>
                                <div class="input-container ml-4">
                                    <input type="text" name="parentName2" placeholder="ІМ'Я  " v-model="registration.data.parentName2" required
                                           v-validate="{ regex: /^([a-zа-яіїє']+){2,}$/i }"
                                           data-vv-as="ІМ'Я">
                                </div>
                                <div class="input-container ml-4">
                                    <input type="text" name="parentPatronymic2" placeholder="ПО-БАТЬКОВІ  " v-model="registration.data.parentPatronymic2" required
                                           v-validate="{ regex: /^([a-zа-яіїє']+){5,}$/i }"
                                           data-vv-as="ПО-БАТЬКОВІ">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('parentSurname2')">
                                    Поле "прізвище" повинно бути заповнене
                            </span>
                            <span class="errors" v-if="errors.has('parentName2')">
                                    Поле "ім’я" повинно бути заповнене
                            </span>
                            <span class="errors" v-if="errors.has('parentPatronymic2')">
                                    Поле "по-батькові" повинно бути заповнене
                            </span>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/step2-data.png" alt="" class="input-img">
                                    <input type="text" name="idCode2" :placeholder="registration.data.idMemberType2 == 1 ? 'ІДЕНТИФІКАЦІЙНИЙ НОМЕР ОДНОГО З БАТЬКІВ' : 'ІДЕНТИФІКАЦІЙНИЙ НОМЕР УЧНЯ'" v-model="registration.data.idCode2" required
                                        v-validate="{ regex: /[0-9]{10}/ }"
                                           data-vv-as="ІДЕНТИФІКАЦІЙНИЙ НОМЕР">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('idCode2')">
                                    Ідентифікаційний номер повинен містити 10 цифр
                            </span>
                            <h3 class="step-title">Копія документа <i class="hint"></i></h3>
                            <div class="input-row">
                                <div class="input-container">

                                    <img src="img/file-image.png" alt="" class="input-img">

                                    <input @change="getInputFile" name="idFile2" id="idFile2" class="d-none" type="file" 
                                        v-validate="{ required: true }"
                                           data-vv-as="КОПІЯ ДОКУМЕНТА">
                                    <label for="idFile2">
                                        <span>{{fileTitle.idFile2}}</span>
                                    </label>

                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('idFile2')">
                                    Файл не обрано
                            </span>
                            <div class="d-flex justify-content-between align-items-center mt-5">
                                <span class="prev-step" @click="prevStep">Назад</span>
                                <button type="button" @click="nextStep" class="next-step">Далі</button>
                            </div>
                        </form>

                        <!--group-->

                        <form class="step-form" v-else-if="activeStep == 1 && registration.data.appType > 2">
                            <h3 class="step-title">Інформація про колектив</h3>

                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/step2-user.png" alt="" class="input-img">
                                    <input type="text" name="groupName" placeholder="НАЗВА КОЛЕКТИВУ" v-model="registration.data.groupName"
                                        v-validate="{ required: true }"
                                           data-vv-as="НАЗВА КОЛЕКТИВУ">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('groupName')">
                                    Поле повинно бути заповнене
                            </span>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/step2-data.png" alt="" class="input-img">
                                    <input type="text" name="groupCount" placeholder="КІЛЬКІСТЬ УЧАСНИКІВ" v-model="registration.data.groupCount" required
                                        v-validate="{ regex: /^[0-9]+$/ }"
                                           data-vv-as="КІЛЬКІСТЬ УЧАСНИКІВ">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('groupCount')">
                                    Введіть корректні дані
                            </span>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/step2-data.png" alt="" class="input-img">
                                    <input type="text" name="groupAverage" placeholder="СЕРЕДНІЙ ВІК УЧАСНИКІВ" v-model="registration.data.groupAverage" required
                                        v-validate="{ regex: /^[0-9]{1,2}(?:[.,][0-9]{1,})?\r?$/ }"
                                           data-vv-as="СЕРЕДНІЙ ВІК УЧАСНИКІВ">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('groupAverage')">
                                    Введіть корректні дані
                            </span>
                            <h3 class="step-title">Документ с датами народження учасників <i class="hint"></i></h3>
                            <div class="input-row">
                                <div class="input-container">

                                    <img src="img/file-image.png" alt="" class="input-img">

                                    <input @change="getInputFile" name="groupBirthdayFile" id="groupBirthdayFile" class="d-none" type="file" placeholder="../birthdays.jpg "
                                        v-validate="{ required: true }"
                                           data-vv-as="Документ с датами народження учасників">
                                    <label for="groupBirthdayFile">
                                        <span>{{fileTitle.groupBirthdayFile}}</span>
                                    </label>

                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('groupBirthdayFile')">
                                    Файл не обрано
                            </span>
                            <div class="d-flex justify-content-between align-items-center mt-5">
                                <span class="prev-step" @click="prevStep">Назад</span>
                                <button type="button" @click="nextStep" class="next-step">Далі</button>
                            </div>

                        </form>

                    </transition>

                    <!--step3-->

                    <transition name="fade" >
                        <form class="step-form" v-if="activeStep == 2">
                            <h3 class="step-title">Інформація про УЧБОВИЙ ЗАКЛАД </h3>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/input-castle.png" alt="" class="input-img" >
                                    <input name="schoolName" type="text" placeholder="НАЗВА" v-model="registration.data.schoolName"
                                        v-validate="{ required: true }"
                                            data-vv-as="НАЗВА">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('schoolName')">
                                    Введіть корректні дані
                            </span>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/input-map.png" alt="" class="input-img">
                                    <input name="schoolAddress" type="text" placeholder="АДРЕСА" v-model="registration.data.schoolAddress"
                                        v-validate="{ required: true }"
                                           data-vv-as="АДРЕСА">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('schoolAddress')">
                                    Введіть корректні дані
                            </span>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/step2-data.png" alt="" class="input-img">
                                    <input type="text" name="schoolPhone" placeholder="ТЕЛЕФОН" v-model="registration.data.schoolPhone" required
                                        v-validate="{ regex: /^(?:[+])?[0-9]+$/ }"
                                           data-vv-as="ТЕЛЕФОН">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('schoolPhone')">
                                    Введіть дані у форматі +380
                            </span>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/step2-data.png" alt="" class="input-img">
                                    <input type="text" name="schoolEmail" placeholder="E-MAIL" v-model="registration.data.schoolEmail" required
                                        v-validate="{ regex: /^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/ }"
                                           data-vv-as="E-MAIL">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('schoolEmail')">
                                    Введіть дані у форматі name@email.com
                            </span>
                            <h3 class="step-title">Інформація про ВИКЛАДАЧА  </h3>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/step2-user.png" alt="" class="input-img">
                                    <input name="teacherSurname" type="text" placeholder="ПРІЗВИЩЕ" v-model="registration.data.teacherSurname" required
                                        v-validate="{ regex: /^([a-zа-яіїє']+){2,}$/i }"
                                            data-vv-as="ПРІЗВИЩЕ">
                                </div>
                                <div class="input-container ml-4">
                                    <input name="teacherName" type="text" placeholder="ІМ'Я" v-model="registration.data.teacherName" required
                                        v-validate="{ regex: /^([a-zа-яіїє']+){2,}$/i }"
                                            data-vv-as="ІМ'Я">
                                </div>
                                <div class="input-container ml-4">
                                    <input name="teacherPatronymic" type="text" placeholder="ПО-БАТЬКОВІ" v-model="registration.data.teacherPatronymic" required
                                        v-validate="{ regex: /^([a-zа-яіїє']+){5,}$/i }"
                                            data-vv-as="ПО-БАТЬКОВІ">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('teacherSurname')">
                                    Введіть корректні дані
                            </span>
                            <span class="errors" v-if="errors.has('teacherName')">
                                    Введіть корректні дані
                            </span>
                            <span class="errors" v-if="errors.has('teacherPatronymic')">
                                    Введіть корректні дані
                            </span>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/input-mail.png" alt="" class="input-img">
                                    <input name="teacherEmail" type="text" placeholder="E-MAIL" v-model="registration.data.teacherEmail" required
                                        v-validate="{ regex: /^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/ }"
                                           data-vv-as="E-MAIL">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('teacherEmail')">
                                    Введіть дані у форматі name@email.com
                            </span>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/step2-data.png" alt="" class="input-img">
                                    <input name="teacherIdCode" type="text" placeholder="ІДЕНТИФІКАЦІЙНИЙ НОМЕР КЕРІВНИКА" v-model="registration.data.teacherIdCode" required
                                        v-validate="{ regex: /[0-9]{10}/ }"
                                           data-vv-as="ІДЕНТИФІКАЦІЙНИЙ НОМЕР КЕРІВНИКА">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('teacherIdCode')">
                                    Ідентифікаційний номер повинен містити 10 цифр
                            </span>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/input-phone.png" alt="" class="input-img">
                                    <input type="text" name="teacherPhone" placeholder="КОНТАКТНИЙ ТЕЛЕФОН ВИКЛАДАЧА" v-model="registration.data.teacherPhone" required
                                        v-validate="{ regex: /^(?:[+])?[0-9]+$/ }"
                                           data-vv-as="КОНТАКТНИЙ ТЕЛЕФОН ВИКЛАДАЧА">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('teacherPhone')">
                                    Введіть дані у форматі +380
                            </span>
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
                                    <input type="text" name="concertSurname" placeholder="ПРІЗВИЩЕ" v-model="registration.data.concertSurname" required
                                        v-validate="{ regex: /^([a-zа-яіїє']+){2,}$/i }"
                                           data-vv-as="ПРІЗВИЩЕ">
                                </div>
                                <div class="input-container ml-4">
                                    <input type="text" name="concertName" placeholder="ІМ'Я" v-model="registration.data.concertName" required
                                        v-validate="{ regex: /^([a-zа-яіїє']+){2,}$/i }"
                                           data-vv-as="ІМ'Я">
                                </div>
                                <div class="input-container ml-4">
                                    <input type="text" name="concertPatronymic" placeholder="ПО-БАТЬКОВІ" v-model="registration.data.concertPatronymic" required
                                        v-validate="{ regex: /^([a-zа-яіїє']+){5,}$/i }"
                                           data-vv-as="ПО-БАТЬКОВІ">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('concertSurname')">
                                    Введіть корректні дані
                            </span>
                            <span class="errors" v-if="errors.has('concertName')">
                                    Введіть корректні дані
                            </span>
                            <span class="errors" v-if="errors.has('concertPatronymic')">
                                    Введіть корректні дані
                            </span>
                            <div class="d-flex justify-content-between align-items-center mt-5">
                                <span class="prev-step" @click="prevStep">Назад</span>
                                <button type="button" @click="nextStep" class="next-step">Далі</button>
                            </div>
                        </form>
                    </transition>

                    <!--step4-->

                    <transition name="fade" >
                        <form class="step-form" v-if="activeStep == 3">
                            <h3 class="step-title">Інформація про ВИСТУП</h3>
                            <h3 class="step-title">перший твір</h3>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/input-composition.png" alt="" class="input-img">
                                    <input type="text" name="compositionName" placeholder="НАЗВА" v-model="registration.data.compositionName"
                                        v-validate="{ required: true }"
                                           data-vv-as="НАЗВА">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('compositionName')">
                                    Введіть корректні дані
                            </span>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/input-author.png" alt="" class="input-img">
                                    <input type="text" name="compositionAuthor" placeholder="АВТОР" v-model="registration.data.compositionAuthor"
                                        v-validate="{ required: true }"
                                           data-vv-as="АВТОР">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('compositionAuthor')">
                                    Введіть корректні дані
                            </span>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/input-composition.png" alt="" class="input-img">
                                    <input type="text" name="timing1" placeholder="ХРОНОМЕТРАЖ" v-model="registration.data.timing1"
                                        v-validate="{ required: true }"
                                            data-vv-as="ХРОНОМЕТРАЖ">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('timing1')">
                                    Введіть корректні дані
                            </span>
                            <h3 class="step-title">Другий твір</h3>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/input-composition.png" alt="" class="input-img">
                                    <input type="text" name="compositionName2" placeholder="НАЗВА" v-model="registration.data.compositionName2"
                                        v-validate="{ required: true }"
                                           data-vv-as="НАЗВА">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('compositionName2')">
                                    Введіть корректні дані
                            </span>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/input-author.png" alt="" class="input-img">
                                    <input type="text" name="compositionAuthor2" placeholder="АВТОР" v-model="registration.data.compositionAuthor2"
                                        v-validate="{ required: true }"
                                           data-vv-as="АВТОР">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('compositionAuthor2')">
                                    Введіть корректні дані
                            </span>
                            <div class="input-row">
                                <div class="input-container">
                                    <img src="img/input-composition.png" alt="" class="input-img">
                                    <input type="text" name="timing2" placeholder="ХРОНОМЕТРАЖ" v-model="registration.data.timing2"
                                           v-validate="{ required: true }"
                                           data-vv-as="ХРОНОМЕТРАЖ">
                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('timing2')">
                                    Введіть корректні дані
                            </span>
                            <h4 class="step-title">ВИ ПОВИННІ ЗАВАНТАЖИТИ ОДИН ФАЙЛ, ЯКИЙ БУДЕ МІСТИТИ 2 ВІДЕО<i class="hint"></i></h4>
                            <div class="input-row">
                                <div class="input-container">

                                    <img src="img/input-video.png" alt="" class="input-img">

                                    <input @change="getInputFile" name="compositionVideo" id="compositionVideo" class="d-none" type="file" placeholder="../birthdays.jpg "
                                        v-validate="{ required: true }"
                                           data-vv-as="ВИ ПОВИННІ ЗАВАНТАЖИТИ ОДИН ФАЙЛ, ЯКИЙ БУДЕ МІСТИТИ 2 ВІДЕО">
                                    <label for="compositionVideo">
                                        <span>{{fileTitle.compositionVideo}}</span>
                                    </label>

                                </div>
                            </div>
                            <span class="errors" v-if="errors.has('compositionVideo')">
                                    Файл не обрано
                            </span>
                            <div class="d-flex justify-content-between align-items-center mt-5">
                                <span class="prev-step" @click="prevStep">Назад</span>
                                <button type="button" @click="nextStep" class="next-step">Далі</button>
                            </div>
                        </form>
                    </transition>

                    <!--step5-->

                    <transition name="fade" >

                        <form class="step-form" v-if="activeStep == 4 && registration.data.appType == 1">

                            <div class="result-row"><h5 class="step-title">Тип заявки: {{appTypes[registration.data.appType]}}</h5></div>
                            <div class="result-row"><h5 class="step-title">Номінація: {{nominations[registration.data.nomination].name}}</h5></div>
                            <div class="result-row">
                                <h5 class="step-title">Вікова категорія: 
                                    <span v-if="registration.data.ageCategory >= 8 && registration.data.ageCategory <= 10">молодша</span>
                                    <span v-if="registration.data.ageCategory >= 11 && registration.data.ageCategory <= 13">середня</span>
                                    <span v-if="registration.data.ageCategory >= 14 && registration.data.ageCategory <= 17">старша</span>
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
                        </form>

                        <form class="step-form" v-if="activeStep == 4 && registration.data.appType == 2">

                            <div class="result-row"><h5 class="step-title">Тип заявки: {{appTypes[registration.data.appType]}}</h5></div>
                            <div class="result-row"><h5 class="step-title">Номінація: {{nominations[registration.data.nomination].name}}</h5></div>
                            <div class="result-row">
                                <h5 class="step-title">Вікова категорія: 
                                    <span v-if="registration.data.ageCategory >= 8 && registration.data.ageCategory <= 10">молодша</span>
                                    <span v-if="registration.data.ageCategory >= 11 && registration.data.ageCategory <= 13">середня</span>
                                    <span v-if="registration.data.ageCategory >= 14 && registration.data.ageCategory <= 17">старша</span>
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
                        </form>

                        <form class="step-form" v-if="activeStep == 4 && registration.data.appType > 2">

                            <div class="result-row"><h5 class="step-title">Тип заявки: {{appTypes[registration.data.appType]}}</h5></div>
                            <div class="result-row"><h5 class="step-title">Номінація: {{nominations[registration.data.nomination].name}}</h5></div>
                            <div class="result-row">
                                <h5 class="step-title">Вікова категорія: 
                                    <span v-if="registration.data.ageCategory >= 8 && registration.data.ageCategory <= 10">молодша</span>
                                    <span v-if="registration.data.ageCategory >= 11 && registration.data.ageCategory <= 13">середня</span>
                                    <span v-if="registration.data.ageCategory >= 14 && registration.data.ageCategory <= 17">старша</span>
                                </h5>
                            </div>
                            <div class="result-row"><h5 class="step-title">Інформація про колектив</h5>
                                <ul class="info-list">
                                    <li class="info-item">Назва колективу та кількість учасників:</li>
                                    <li class="info-item">Середній вік учасників: {{registration.data.memberDate}}</li>
                                </ul></div>
                            <div class="result-row"><h5 class="step-title">Інформація про керівника</h5>
                                <ul class="info-list">
                                    <li class="info-item">Прізвище, ім'я, по-батькові керівника: {{registration.data.teacherSurname + ' ' + registration.data.teacherName + ' ' + registration.data.teacherPatronymic}}</li>
                                    <li class="info-item">Контактний телефон керівника: {{registration.data.teacherPhone}}</li>
                                    <li class="info-item">Ідентифікаційний номер керівника: {{registration.data.idCode}}</li>
                                    <li class="info-item">Електронна пошта керівника: {{registration.data.teacherEmail}}</li>
                                </ul></div>
                            <div class="result-row"><h5 class="step-title">Прізвище, ім'я, по-батькові концертмейстера:  {{registration.data.concertSurname + ' ' + registration.data.concertName + ' ' + registration.data.concertPatronymic}}</h5></div>
                            <div class="result-row"><h5 class="step-title">Інформація про мистецький заклад </h5>
                                <ul class="info-list">

                                    <li class="info-item">Назва: {{registration.data.schoolName}}</li>
                                    <li class="info-item">Телефон: {{registration.data.schoolPhone}}</li>
                                    <li class="info-item">Адреса: {{registration.data.schoolAddress}}</li>
                                    <li class="info-item">Електронна адреса: {{registration.data.schoolEmail}}</li>
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
                        </form>
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
                nominations: [],

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
                        memberName: '',
                        memberSurname: '',
                        memberPatronymic: '',
                        memberDate: '',
	                    memberEmail: '',
	                    memberEmail1: '',
	                    memberEmail2: '',
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
                        ageCategory: 0
                    },
                    files: {

                    }
                }
            };
        },

        created () {
            document.title = "Заповнити заявку";
            this.getNominations();
        },
        computed: {

        },
        methods: {
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
                    }
                    else if(this.registration.data.memberDate != '' && this.registration.data.memberDate2 != '') {
                        this.registration.data.ageCategory = (this.getAge(this.registration.data.memberDate) + this.getAge(this.registration.data.memberDate2)) / 2;
                    }
                    else if(this.registration.data.memberDate == '' && this.registration.data.memberDate2 == '') {
                        this.registration.data.ageCategory = this.registration.data.groupAverage;
                    }
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
	                    swal("“Дякуємо за реєстрацію! Лист з даними\n" + "відправлено на вашу зазначену електронну адресу.”", {
		                    icon: "success",
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
        },
    }
</script>