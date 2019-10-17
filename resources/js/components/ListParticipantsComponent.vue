<template>
    <div>
      <form role="form" class="search">
            <i class="fa fa-search" aria-hidden="true"></i>
            <input v-model="search" type="text" class="form-control">
      </form>
      <table class="table table-bordered">
      <thead>
            <tr>
                <th width="30px">№</th>
                <th>ПІБ Учасника / Назва групи</th>
                <th>Тип заявки</th>
                <th  width="30px"></th>
            </tr>
      </thead>
      <tbody v-for="(item, index) in filteredList" :key="index">
            <tr>
                <td>{{ index + 1 }}</td>
                <td>{{ item.name }}</td>
                <td>{{ item.type }}</td>
                <td><i class="fa fa-2x fa-times-circle btn btn-default p-0" :data-value="item.id" @click="archiveMember"></i></td>
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
            axios.get('/get-all-members')
            .then((response) => {
                this.members = [];
                response.data.forEach(member => {
                    if(member.solo_duet.length == 0) {
                        this.members.push({
                            name: member.group.name, 
                            type: member.app_type.name,
                            id: member.application_id
                        })
                    }
                    else if(member.solo_duet.length == 1) {
                        this.members.push({
                            name: `${member.solo_duet[0].surname} ${member.solo_duet[0].name} ${member.solo_duet[0].patronomic}`, 
                            type: member.app_type.name,
                            id: member.application_id
                        })
                    }
                    else if(member.solo_duet.length == 2) {
                        this.members.push({
                            name: `${member.solo_duet[0].surname} ${member.solo_duet[0].name} ${member.solo_duet[0].patronomic}, ${member.solo_duet[1].surname} ${member.solo_duet[1].name} ${member.solo_duet[1].patronomic}`, 
                            type: member.app_type.name,
                            id: member.application_id
                        })
                    }
                });
            })
        },
        archiveMember(event){
            const id =  event.target.getAttribute('data-value');
            axios.post('/archive-members/'+id)
                .then((response) => {
                    if(response.status == 200) {
                        this.getFullList();
                    }
                })
        }
    },
}
</script>