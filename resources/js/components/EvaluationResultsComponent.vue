<template>
    <div>
        <form role="form" class="search">
                <i class="fa fa-search" aria-hidden="true"></i>
                <input v-model="search" type="text" class="form-control">
        </form>
        <div class="row">
            <div class="col-sm">
                <label for="documentType">Тип документу</label>
                <select class="form-control" id="documentType">
                    <option>хз</option>
                    <option>хз хз</option>
                    <option>хз хз хз</option>
                </select>
            </div>
            <div class="col-sm">
                    <label for="member">Учасник (тип)</label>
                    <select class="form-control" id="member">
                        <option>Соліст</option>
                        <option>Дует</option>
                        <option>Група</option>
                    </select>
            </div>
            <div class="col-sm align-self-center">
                <div class="row justify-content-center">
                    <button type="button" class="btn btn-outline-secondary">Згенерувати документ</button>
                </div>
            </div>
        </div>
        <br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="30px">№</th>
                    <th>ПІБ Учасника / Назва групи</th>
                    <th>Тип заявки</th>
                    <th class="text-center">Оцінка</th>
                </tr>
            </thead>
            <tbody v-for="(item, index) in filteredList" v-bind:key="item.id">
                <tr>
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.name }}</td>
                    <td>{{ item.type }}</td>
                    <td class="text-center">{{ item.evaluation }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>

export default {
    data() {
        return {
            members: [],
            search: '',
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
            axios.get('/get-approved-members')
            .then((response) => {
                response.data.forEach(member => {
                   console.log(member); 
                    if(member.solo_duet.length == 0) {
                        this.members.push({
                            id: member.application_id,
                            name: member.group.name, 
                            type: member.app_type.name,
                            evaluation: member.evaluation
                        })
                    }
                    else if(member.solo_duet.length == 1) {
                        this.members.push({
                            name: `${member.solo_duet[0].name} ${member.solo_duet[0].surname} ${member.solo_duet[0].patronymic}`,
                            type: member.app_type.name,
                            evaluation: member.evaluation
                        })
                    }
                    else if(member.solo_duet.length == 2) {
                        this.members.push({
                            name: `${member.solo_duet[0].name} ${member.solo_duet[0].surname} ${member.solo_duet[0].patronymic}, ${member.solo_duet[1].name} ${member.solo_duet[1].surname} ${member.solo_duet[1].patronymic}`,
                            type: member.app_type.name,
                            evaluation: member.evaluation
                        })
                    }
                });
            })
        }
    },
}
</script>