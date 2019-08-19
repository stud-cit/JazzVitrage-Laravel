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
            <div class="col-9">
                <div class="row">
                    <div class="col-12 evaluationName"><b>ПІП:</b> Івченко Юлія Олександрівна</div>
                    <div class="col-6">
                        <b>Тип:</b> соліст
                        <b class="mt-3">Дата народження:</b> 10.10.2010
                        <b class="mt-3">Адреса:</b> м. Суми, вул. Засумська 3
                    </div>
                    <div class="col-6">
                        <b>ПІП викладача:</b> Иванов Иван Иванович
                        <b class="mt-3">Програма та хронометраж кожного твору:</b> Лорем ипсум долор сит амет
                    </div>
                </div>
            </div>
            <div class="col-3">
                <button type="button" class="btn btn-secondary btn-block">Зберегти</button>
                <button type="button" class="btn btn-outline-secondary btn-block mt-4">Наступний учасник</button>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    
}
</script>