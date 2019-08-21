<template>
    
    <div>

        <div class="row">
            <div class="col-5">
                <label for="typeEvent">Тип заходу</label>
                <select class="form-control" id="typeEvent">
                    <option>Джаз-Вітраж</option>
                    <option>хз хз</option>
                    <option>хз хз хз</option>
                </select>
                <label for="yearCompetition">Рік проведення конкурсу</label>
                <select class="form-control" id="yearCompetition">
                    <option>2019</option>
                    <option>2018</option>
                    <option>2017</option>
                </select>
            </div>
            <div class="col-2"></div>
            <div class="col-5">
                <label for="foto">Фото в оригінальній якості</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="foto" multiple>
                    <label class="custom-file-label"></label>
                </div>
                <button type="button" class="btn btn-outline-secondary float-right mt-4 px-5">Додати</button>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-4">
                <div class="border fotoGallery">
                    <i class="fa fa-calendar"> 04.05.08</i>
                    <i class="fa fa-search"></i>
                    <i class="fa fa-share"></i>
                    <i class="fa fa-download"></i>
                </div>
            </div>
            <div class="col-4">
                <div class="border fotoGallery">
                    <i class="fa fa-calendar"> 04.05.08</i>
                    <i class="fa fa-search"></i>
                    <i class="fa fa-share"></i>
                    <i class="fa fa-download"></i>
                </div>
            </div>
            <div class="col-4">
                <div class="border fotoGallery">
                    <i class="fa fa-calendar"> 04.05.08</i>
                    <i class="fa fa-search"></i>
                    <i class="fa fa-share"></i>
                    <i class="fa fa-download"></i>
                </div>
            </div>
        </div>

    </div>

</template>

<script>
export default {
    data() {
        return {

        }
    },
    methods: {

    }
}
</script>