<template>
    <div>
        <section class="sections main-section members">
            <div class="container">
                <h2 class="title-section">СПИСКИ УЧАСНИКІВ</h2>

                <table class="table-members">
                    <tr class="table-title">
                        <th>N</th>
                        <th>П.І.Б. /<br>
                            НАЗВА КОЛЕКТИВУ </th>
                        <th>АДРЕСА</th>
                        <th>НАЗВА ЗАКЛАДУ</th>
                        <th>ВИКЛАДАЧ</th>
                    </tr>
                    <tr v-for="item in paginatedData" :key="item.index">
                        <td>{{ item.index+1 }}</td>
                        <td>{{ item.name }}</td>
                        <td>{{ item.schoolAddress }}</td>
                        <td>{{ item.schoolName }}</td>
                        <td>{{ item.teacher }}</td>
                    </tr>
                </table>
                <div class="search-block">
                    <input type="text" v-model="searchMember" placeholder="ПОШУК">
                    <select v-model="searchNomination" class="nomination">
                        <option value="" selected="selected">номінація</option>
                        <option v-for="(value, index) in nominations" :value="value.name" :key="index">{{ value.name }}</option>
                    </select>
                    <select name=""  class="category">
                        <option value="" selected="selected" >вік.категорія</option>
                        <option value="1">вік.категорія1</option>
                    </select>
                    <button class="clean" @click="clean">Очистити</button>
                </div>
                <ul class="pagination">
                    <li class="controls active" v-if="pagination.pageNumber !== 0" @click="prevPage"><i class="fa fa-long-arrow-left" aria-hidden="true" v-if="pagination.pageNumber !== 0"></i></li>
                    <li>{{ pagination.pageNumber + 1 }} : {{ pageCount }}</li>
                    <li class="controls active" v-if="pagination.pageNumber <= pageCount -2" @click="nextPage"><i class="fa fa-long-arrow-right" aria-hidden="true" v-if="pagination.pageNumber <= pageCount -2"></i></li>
                </ul>
            </div>
        </section>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                pagination : {
                    pageNumber: 0,
                    size: 4
                },
                members: [],
                nominations: [],
                searchMember: '',
                searchNomination: '',
                name: '',
            };
        },

        created () {
            this.getInfo();
            this.getNominations();
            this.getMembers();

        },
        computed: {
            filteredList() {
                return this.members.filter(members => {
                    return (members.name.toLowerCase().includes(this.searchMember.toLowerCase()) || 
                    members.schoolAddress.toLowerCase().includes(this.searchMember.toLowerCase()) ||
                    members.schoolName.toLowerCase().includes(this.searchMember.toLowerCase())) &&
                    members.nomination.includes(this.searchNomination)
                })
            },
            paginatedData(){
                const start = this.pagination.pageNumber * this.pagination.size;
                const end = start + this.pagination.size;
                return this.filteredList.slice(start, end);
            },
            pageCount(){
                return Math.ceil(this.filteredList.length / this.pagination.size);
            },
        },
        methods: {
            nextPage(){
                this.pagination.pageNumber++;
            },
            prevPage(){
                this.pagination.pageNumber--;
            },
            getInfo() {
                axios.get('/get-all-info')
                    .then((response) => {
                        response.data.info.map(item => {
                            Object.assign(this.info, item);
                        });
                        response.data.contact.map(item => {
                            Object.assign(this.contact[item.caption], item.contacts_items);
                        });
                    })
            },
            getNominations() {
                axios.get('/get-nominations')
                .then((response) => {
                    this.nominations = response.data;
                })
            },
            getMembers() {
                axios.get('/get-members')
                .then((response) => {
                    response.data.forEach((member, index) => {
                        if(member.solo_duet.length == 0) {
                            this.members.push({
                                index,
                                name: member.group.name, 
                                schoolAddress: member.preparation.school_address,
                                schoolName: member.preparation.school_one,
                                teacher: `${member.preparation.teacher_surname} ${member.preparation.teacher_name} ${member.preparation.teacher_patronymic}`,
                                nomination: member.nomination.name
                            })
                        }
                        else if(member.solo_duet.length == 1) {
                            this.members.push({
                                index,
                                name: `${member.solo_duet[0].surname} ${member.solo_duet[0].name} ${member.solo_duet[0].patronymic}`,
                                schoolAddress: member.preparation.school_address,
                                schoolName: member.preparation.school_one,
                                teacher: `${member.preparation.teacher_surname} ${member.preparation.teacher_name} ${member.preparation.teacher_patronymic}`,
                                nomination: member.nomination.name
                            })
                        }
                        else if(member.solo_duet.length == 2) {
                            this.members.push({
                                index,
                                name: `${member.solo_duet[0].surname} ${member.solo_duet[0].name} ${member.solo_duet[0].patronymic}, ${member.solo_duet[1].surname} ${member.solo_duet[1].name} ${member.solo_duet[1].patronymic}`,
                                schoolAddress: member.preparation.school_address,
                                schoolName: member.preparation.school_one,
                                teacher: `${member.preparation.teacher_surname} ${member.preparation.teacher_name} ${member.preparation.teacher_patronymic}`,
                                nomination: member.nomination.name
                            });
                        }
                    });
                });
            },
            clean() {
                this.searchMember = '',
                this.searchNomination = ''
            },

        },

    }
</script>