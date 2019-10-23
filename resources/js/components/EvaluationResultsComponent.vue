<template>
    <div>
        <h1 v-if="hasError" class='text-center'>Ой лишенько... виникли проблеми</h1>
        <template v-else>
            <form role="form" class="search">
                    <i class="fa fa-search" aria-hidden="true"></i>
                    <input v-model="search" type="text" class="form-control">
            </form>
            <div class="row justify-content-between">
                <!--<div class="col-sm">-->
                    <!--<label for="documentType">Тип документу</label>-->
                    <!--<select class="form-control" id="documentType">-->
                        <!--<option>хз</option>-->
                        <!--<option>хз хз</option>-->
                        <!--<option>хз хз хз</option>-->
                    <!--</select>-->

            <!--</div>-->
            <div class="col-sm">

                    <label for="member">Учасник (тип)</label>
                    <select class="form-control w-50" id="member" @change="searchMembers">
                        <option value="" selected="selected">всі учасники</option>
                        <option value="Соліст">Соліст</option>
                        <option value="Дует">Дует</option>
                        <option value="Група">Група</option>
                    </select>

            </div>
            <div class="col-sm align-self-end">
                <div class="row justify-content-end mr-2">
                    <button type="button" class="btn btn-outline-secondary" @click="printData">Згенерувати документ</button>

                </div>
            </div>
        </div>
        <br>
        <table class="table table-bordered" ref="printTable" id="allMembers">
            <thead>
                <tr>
                    <th width="30px">№</th>
                    <th>ПІБ Учасника / Назва групи</th>
                    <th>Тип заявки</th>
                    <th class="text-center">Оцінка</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in filteredList" v-bind:key="item.id">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.name }}</td>
                    <td>{{ item.type }}</td>
                    <td class="text-center">{{ item.evaluation }}</td>
                </tr>
            </tbody>
        </table>
        

        </template>

    </div>
</template>
<script>

export default {
    data() {
        return {
            members: [],
            search: '',
            hasError: false

        }
    },
    created() {
        this.getFullList();
    },
    computed: {
        filteredList() {
            return this.members.filter(members => {
                return members.name.toLowerCase().includes(this.search.toLowerCase()) || members.type.toLowerCase().includes(this.search.toLowerCase())
            })
        }
    },
    methods: {
        getFullList() {
            axios.get('/get-rating')
            .then((response) => {
                response.data.forEach(member => {
                    if(member.solo_duet.length == 0) {
                        this.members.push({
                            id: member.application_id,
                            name: member.group.name, 
                            type: member.app_type.name,
                            evaluation: member.rating
                        })
                    }
                    else if(member.solo_duet.length == 1) {
                        this.members.push({
                            id: member.application_id,
                            name: `${member.solo_duet[0].surname} ${member.solo_duet[0].name} ${member.solo_duet[0].patronomic}`, 
                            type: member.app_type.name,
                            evaluation: member.rating
                        })
                    }
                    else if(member.solo_duet.length == 2) {
                        this.members.push({
                            id: member.application_id,
                            name: `${member.solo_duet[0].surname} ${member.solo_duet[0].name} ${member.solo_duet[0].patronomic}, ${member.solo_duet[1].surname} ${member.solo_duet[1].name} ${member.solo_duet[1].patronomic}`, 
                            type: member.app_type.name,
                            evaluation: member.rating
                        })
                    }
                });
            }).catch( error => {
                this.hasError = true;
            })

        },

        searchMembers(){
            var input, filter, table, tr, td, i;
            input = document.getElementById("member");
            filter = input.value.toLowerCase();
            table = document.getElementById("allMembers");
            tr = table.getElementsByTagName("tr");
            for (i = 1; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[2];
                if (td.innerHTML.toLowerCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                }
                else {
                    if (filter=="група" && td.innerText!="соліст" && td.innerText!="дует"){
                        tr[i].style.display = "";
                    } 
                    else{
                        tr[i].style.display = "none";
                    }
                }       
            }
        },

        printData()
        {
            var mywindow = window.open('', 'new div');
            mywindow.document.write('<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" type="text/css" />');
            mywindow.document.write(this.$refs.printTable.outerHTML);
            mywindow.document.close();
            mywindow.focus();
                setTimeout(
                    function(){
                        mywindow.print();
                    },10
                );
            return true;
        },

    },
}
</script>