@extends('layouts.adminapp', ['activePage' => 'evaluations', 'titlePage' => __('Evaluations')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-warning">
              <h4 class="card-title ">Evaluation KPI's</h4>
              <p class="card-category"> Here you can manage evaluation Key Performance Indicators</p>
            </div>
            <div class="card-body">
               @if (Session::has('success'))
                   <div class="row" id="successMessage">
                    <div class="col-sm-12">
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>{{ session('success') }}</span>
                      </div>
                    </div>
                  </div>   
               @endif
              <div class="row">
                <div class="col-12 text-right">
                  <a href="" data-toggle="modal" data-target=".bd-example-modal-lg" class="btn btn-sm btn-warning">ADD Evaluation KPI</a>
                  <!--    <a href="{{ route('evaluation_kpi.index') }}" class="btn btn-sm btn-primary">Evaluation KPI's Category</a> -->
                </div>
              </div>
                    <div class="modal fade bd-example-modal-lg" tabindex="-1" id="mymodal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Evaluation KPI</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                               <div class="modal-body">
                              <form id="myform" method="post" action="{{route('evaluation_kpi.store')}}">
                                 @csrf
                                 @method('post')
                                 <div class="form-group" id="empname">
                                  <label for="recipient-name" class="col-form-label">Category</label><br>
                                  
                                  <select class="form-control selectpicker" name="categ" required id="mySelectBox">
                                    <option disabled selected value="0">Please select</option>
                                    @foreach ($categ as $category)
                                      
                                         <option value="{{$category->id}}">{{$category->name}}</option>
                                 
                                    @endforeach
                                  </select>
                                </div>

                                <div class="form-group">
                                  <p id="error"></p>
                                  <label for="recipient-name" class="col-form-label">Key Performance Indicator</label><br>
                                 <textarea class="form-control" name="kpi" id="kpitext" required rows="4"></textarea> 
                                </div>
                                
                               
                                
                                
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="button" onclick="checkselect()" id="insert" class="btn btn-primary btned">Save</button>
                               </form>
                            </div>
                          </div>
                        </div>
                      </div>

              <div class="table-responsive">
                <table class="table tablemanager">
                  <thead class=" text-primary">

                 
                    <tr><th>
                       Evaluation KPI
                    </th>
                    <th>
                      Category
                    </th>
                 <!--    <th>
                      Creation date
                    </th> -->
                    <th class="text-right">
                      Actions
                    </th>
                  </tr></thead>
                  <tbody>
                        @foreach ($eval_details as $details)
                        <tr>
                        <td width="60%">
                          {{$details->kpi}}
                        </td>
                        <?php $cat; ?>
                        @foreach ($categ as $category)
                          @if($details->eval_categ_id == $category->id)
                          <?php $cat = $category->name ?>
                          @endif
                        @endforeach
                        <td width="20%">
                          {{$cat}}
                        </td>
                        <!-- <td>
           
                        </td> -->
                        <td class="td-actions text-right" width="20%">
                              <a rel="tooltip" class="btn btn-success btn-link" href="{{route('evalkpi.edit_kpi', [$id= Crypt::encrypt($details->id)])}}" data-original-title="" title="Edit"  >
                              <i class="material-icons">edit</i>
                              <div class="ripple-container"></div>
                            </a>

                            <a rel="tooltip" class="btn btn-danger btn-link" href="" data-toggle="modal" data-target="#deletemodal-{{$details->id}}" data-original-title="" title="Delete KPI">
                              <i class="material-icons">delete</i>
                              <div class="ripple-container"></div>
                            </a>
                           </td>
                          <!--  <div class="modal fade bd-example-modal-lg" tabindex="-1" id="editmodal-{{$details->id}}" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Edit Evaluation KPI</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                 <div class="modal-body">
                                <form id="editform" method="post" action="{{route('evalkpi.edit_kpi', [$id= Crypt::encrypt($details->id)])}}">
                                   @csrf
                                   @method('post')
                                   <div class="form-group" id="empname">
                                    <label for="recipient-name" class="col-form-label">Category</label><br>
                                    <input type="text" id="seltex"  name="sel" value="{{$category->id}}">

                                    <script type="text/javascript">
                                      function transfer(){
  document.getElementById('seltex').value= $('#editSelectBox-{{$details->id}} :selected').val();
}
                                    </script>
                                    <select class="form-control selectpicker" name="categ" onchange="transfer()" required id="editSelectBox-{{$details->id}}">
                                      
                                      @foreach ($categ as $category)
                                        
                                           <option <?php if($details->eval_categ_id==$category->id) { echo 'selected'; } ?> value="{{$category->id}}">{{$category->name}}</option>
                                   
                                      @endforeach
                                    </select>
                                  </div>

                                  <div class="form-group">
                                    <p id="error"></p>
                                    <label for="recipient-name" class="col-form-label">Key Performance Indicator</label><br>
                                    <textarea class="form-control" name="kpi" id="editkpitext-{{$details->id}}"required  text-align="left" rows="4">{{$details->kpi}}</textarea> 
                                  </div>
                                  
                                 
                                  
                                  
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit"  id="insert" class="btn btn-primary btned">Save</button>
                                 </form>
                                 
                              </div>
                            </div>
                          </div>
                          </div> -->

                          <div class="modal fade bd-example-modal-lg" tabindex="-1" id="deletemodal-{{$details->id}}" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header ">
                                  <h5 class="modal-title" id="exampleModalLabel">Delete Evaluation KPI</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                 <div class="modal-body">
                                <form id="editform" method="post" action="{{route('evalkpi.delete', [$id= Crypt::encrypt($details->id)])}}">
                                   @csrf
                                   @method('post')
                                  <div class="form-group" id="empname">
                                    <label for="recipient-name" class="col-form-label">Category</label><br>
                                    
                                    <select disabled class="form-control selectpicker" name="categ" required id="editSelectBox">
                                      
                                      @foreach ($categ as $category)
                                        
                                           <option <?php if($details->eval_categ_id==$category->id) { echo 'selected'; } ?> value="{{$category->id}}">{{$category->name}}</option>
                                   
                                      @endforeach
                                    </select>
                                  </div>

                                  <div class="form-group">
                                    <p id="error"></p>
                                    <label for="recipient-name" class="col-form-label">Key Performance Indicator</label><br>
                                    <textarea readonly class="form-control" name="kpi" id="editkpitext-{{$details->id}}"required  text-align="left" rows="4">{{$details->kpi}}</textarea> 
                                  </div>
                                  <p>By Clicking Delete, this cannot be undone.</p>
                                </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit"  id="insert" class="btn btn-danger btned">Delete</button>
                                 </form>
                                 
                              </div>
                            </div>
                          </div>


                          </div>
                      </tr>
                      @endforeach
           
            
                                        </tbody>
                </table>
              </div>
            </div>
          </div>
               
      </div>
    </div>
    <div class="row float-right">
                  <div class="col-sm-12 text-right">
                  
                  </div>
            </div>
  </div>

</div>
<script type="text/javascript" src="{{ asset('material') }}/js/tableManager.js"></script>
<script type="text/javascript">
    // basic usage
    $('.tablemanager').tablemanager({
      firstSort: [[2,'desc']],
      disable: ["last"],
      appendFilterby: true,
      dateFormat: [[4,"mm-dd-yyyy"]],
      debug: true,
      vocabulary: {
    voc_filter_by: 'Filter By',
    voc_type_here_filter: 'Search...',
    voc_show_rows: '  Rows Per Page'
  },
      pagination: true,
      showrows: [5,10,15,20],
      disableFilterBy: [3]
    });
    // $('.tablemanager').tablemanager();
  </script>
<script>

   function checkselect(){
   var sel = document.getElementById('mySelectBox').value;
   var kpi = document.getElementById('kpitext').value;

   if(sel == 0){
    alert('Please select category');
   }
    if(kpi == ''){
    alert('Please fill KPI');
   }

  if (kpi != '' && sel !=0){

    myform.submit();
   }
   else{


   }

  }
  
  setTimeout(function() {
    $('#successMessage').fadeOut('fast');
}, 5000); // <-- time in milliseconds



</script>
@endsection
