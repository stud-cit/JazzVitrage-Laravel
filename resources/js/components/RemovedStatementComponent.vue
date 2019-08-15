<template>
    <div>
        <form role="form">
            <div style="margin-bottom: -35px;margin-left: 10px; font-size: 24px;"><i class="fa fa-search" aria-hidden="true"></i></div>
            <input style="padding-left: 40px;" type="text" class="form-control">
        </form>
        <br>
        
      <table class="table table-bordered accordion" id="accordion">
          <thead>
                <tr>
                    
                    <th>#</th>
                    <th>Example</th>
                    <th>Example</th>
                    
                    <th width="30px"></th>
                    <th width="30px"></th>
                </tr>
          </thead>
          
          <tbody class="card">
                <tr>
                    <td data-toggle="collapse" data-target="#collapse1">
                        Example
                    </td>
                    <td data-toggle="collapse" data-target="#collapse1">
                        Example
                    </td>
                    <td data-toggle="collapse" data-target="#collapse1">
                        Example
                    </td>
                    <td>
                        <a href="#"><i class="fa fa-2x fa-check-circle" aria-hidden="true"></i></a>
                                           
                    <td>

                        <a href="#"><i class="fa fa-2x fa-trash" aria-hidden="true"></i></a>
                    </td>
                </tr>
                <tr id="collapse1" class="collapse "  data-parent="#accordion">
                    <td colspan="5" class="card-body">
                      
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                      
                    </td>
                </tr>
            </tbody>
            <!-- <tbody class="card">
                <tr>
                    <td data-toggle="collapse" data-target="#collapse1">
                        Example
                    </td>
                    <td data-toggle="collapse" data-target="#collapse1">
                        Example
                    </td>
                    <td data-toggle="collapse" data-target="#collapse1">
                        Example
                    </td>
                    <td>
                        <a href="#"><i class="fa fa-2x fa-check-circle" aria-hidden="true"></i></a>
                                           
                    <td>

                        <a href="#"><i class="fa fa-2x fa-times-circle" aria-hidden="true"></i></a>
                    </td>
                </tr>
                <tr id="collapse1" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                    <td colspan="5" class="card-body">
                      
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                      
                    </td>
                </tr>
            </tbody> -->
            

              
          
    
      </table>
    </div>
</template>

<script>
export default {
    data() {
        return {
            keywords: null,
            results: [],
            members: []
        };
    },

    watch: {
        keywords(after, before) {
            this.fetch();
        }
    },

    methods: {
        fetch() {
            axios.get('/api/search', { params: { keywords: this.keywords } })
                .then(response => this.results = reponse.data)
                .catch(error => {});
        },
        getFullList(){
            axios.get('/get-members')
            .then((response) => {

                this.dataLang = response.data;
                this.dataLoaded.push(true);

            })
            .catch((error) => {
                // swal({
                //     icon: "error",
                //     title: 'Помилка',
                //     text: error.response.status + " " + error.responsestatusText
                // });
            });
        }
    }
}
</script>