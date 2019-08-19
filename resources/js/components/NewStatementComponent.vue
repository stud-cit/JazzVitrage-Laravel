<template>
    <div>
      <form role="form" class="search">
            <i class="fa fa-search" aria-hidden="true"></i>
            <input v-model="search" type="text" class="form-control">
      </form>
      <table class="table table-bordered accordion" id="accordion">
          <thead>
                <tr>
                    
                    <th>#</th>
                    <th>ПІБ Учасника</th>
                    <th>Тип Заявки</th>
                    
                    <th width="30px"></th>
                    <th width="30px"></th>
                </tr>
          </thead>
          
          <tbody class="card" v-for="(item, index) in filteredList">
                <tr>
                    <td data-toggle="collapse" :data-target="'#collapse'+(index+1)">
                        {{index+1}}
                    </td>
                    <td data-toggle="collapse" :data-target="'#collapse'+(index+1)">
                        {{ item.solo_duet ? item.solo_duet.name + ' ' + item.solo_duet.surname + ' ' + item.solo_duet.patronomic : item.group.name}}
                    </td>
                    <td data-toggle="collapse" :data-target="'#collapse'+(index+1)">
                       {{ item.app_type.name }}
                    </td>
                    <td>
                        <i class="fa fa-2x fa-check-circle btn btn-default p-0"></i>
                                           
                    <td>

                        <i class="fa fa-2x fa-times-circle btn btn-default p-0"  @click="archiveMember(item.application_id)"></i>
                    </td>
                </tr>
                <tr :id="'collapse'+(index+1)" class="collapse "  data-parent="#accordion">
                    <td colspan="5" class="card-body">
                      
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                      
                    </td>
                </tr>
            </tbody>

            

              
          
    
      </table>

    </div>
</template>

<script>
export default {
    data() {
        return {
            keywords: null,
            results: [],
            members: [],
            search: '',
        };
    },

    created () {
        this.getFullList();

    },
    computed: {
        filteredList() {
            return this.members.filter(members => {
                if(!members.group) {
                    return members.solo_duet.name.toLowerCase().includes(this.search.toLowerCase())
                } else {
                    return members.group.name.toLowerCase().includes(this.search.toLowerCase())
                }
            })
        }
    },
    methods: {

        getFullList(){
            axios.get('/get-members')
            .then((response) => {

                this.members = response.data.filter(app =>{

                    return app.status =="created";
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
        archiveMember(id){


            axios.post('/archive-members/'+id)
                .then((response) => {
                    if(response.status == 200 ) {
                        this.getFullList();
                    }
                    swal("Запис був успішно доданий до архіву", {
                        icon: "success",
                    });

                })
                .catch((error) => {
                    swal({
                        icon: "error",
                        title: 'Помилка',
                        text: 'Не вдалося додати заяву до архіву'
                    });
                });
        }
    }
}
</script>