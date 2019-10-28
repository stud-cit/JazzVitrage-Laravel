<template>
    <div class="period">
        <h3>Період проведення конкурсу</h3>
            
        <div class="form-group">
            <label for="startDate">Початок конкурсу</label>
            <input 
                id="startDate"
                class="form-control"
                type="date"
                v-model="startDate"
                v-bind:readonly="readonlyApplicationPeriod" >
        </div>  
            
        <div class="form-group">
            <label for="expirationDate">Закінчення конкурсу</label>
            <input
                name="expiration_date"
                id="expirationDate"
                class="form-control"
                type="date"
                v-model="expirationDate" 
                v-bind:readonly="readonlyApplicationPeriod" >
        </div>

        <div class="form-group form-check">
            
            <input
                name="status"
                id="status"
                class="form-check-input"
                type="checkbox"
                v-model.number="statusApplication"
                v-bind:disabled="readonlyApplicationPeriod" >

            <label class="form-check-label" for="status">
                {{ statusApplication ? 'Прийом заявок для участі в конкурсі відкрито' :  'Прийом заявок закрито'}}
            </label>

        </div>
            <button
                class="btn btn-outline-secondary"
                v-on:click.prevent="editPeriod"
                type="submit"
                >
                {{ readonlyApplicationPeriod ? 'Редагувати' : 'Зберегти' }}
            </button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            // period when open applications
            readonlyApplicationPeriod: true,
            statusApplication: null,
            startDate: null,
            expirationDate: null,
        }
    },
    created () {
        this.getPeriod();
    },
    methods: {
        getPeriod() {
            axios
                .get('/get-period')
                .then( ( response ) => {
                    this.startDate = response.data.start_date;
                    this.expirationDate = response.data.expiration_date;
                    this.statusApplication = response.data.status ? true : false;
                })
                .catch( ( error ) => { 
                    swal('Помилка отримання даних', 'Період заявок', 'error') 
                });
        },
        setData() {
            axios
                .post('/update-period', {
                    start_date: this.startDate,
                    expiration_date: this.expirationDate,
                    status: this.statusApplication
                })
                .then( ( response ) => swal('Операція успішна', 'Дані проведення конкурсу змінені', 'success') )
                .catch( ( error ) =>  swal('Помилка', 'Зверніться до розробника', 'error') )
        },
        editPeriod(event) {
            if (this.readonlyApplicationPeriod == false) {
                this.setData();
            }
            if (event) {
                this.readonlyApplicationPeriod = !this.readonlyApplicationPeriod;
            }
           
             
        }
    }
}
</script>

<style lang="sass" scoped>

</style>