<template>
    <div>
        <form role="form">
            <div style="margin-bottom: -35px;margin-left: 10px; font-size: 24px;"><i class="fa fa-search" aria-hidden="true"></i></div>
            <input style="padding-left: 40px;" type="text" class="form-control">
        </form>
        <br>
        <!-- <div class="accordion" id="accordionExample">
          <div class="card">
            <div class="card-header" id="headingOne">
              <h2 class="mb-0">
                <div class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  <div class="column">#</div>
                  <div class="column">Івченко Юлія Олександрівна</div>
                  <div class="column">соліст</div>                                         
                </div>
                
              </h2>
            </div>
            <a href="#"><i class="fa fa-2x fa-check-circle" aria-hidden="true"></i></i></a>
                <a href="#"><i class="fa fa-2x fa-times-circle" aria-hidden="true"></i></a>
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
              <div class="card-body">
                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
              </div>
            </div>
          </div>
          
          <div class="card">
            <div class="card-header" id="headingThree">
              <h2 class="mb-0">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                  Collapsible Group Item #3
                </button>
              </h2>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
              <div class="card-body">
                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
              </div>
            </div>
          </div>
        </div> -->
      <table class="table table-bordered table-responsive accordion" id="accordion">
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

                        <a href="#"><i class="fa fa-2x fa-times-circle" aria-hidden="true"></i></a>
                    </td>
                </tr>
                <tr id="collapse1" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                    <td colspan="5" class="card-body">
                      
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                      
                    </td>
                </tr>
            </tbody>
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

                        <a href="#"><i class="fa fa-2x fa-times-circle" aria-hidden="true"></i></a>
                    </td>
                </tr>
                <tr id="collapse1" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
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