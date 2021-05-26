@extends('layouts.adminapp', ['activePage' => 'dept', 'titlePage' => __('Departments')])


@section('content')
 @csrf

<div class="content" id="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 col-md-12">
          <div class="card" id="profcard">
            <div class="card-header card-header-tabs card-header-primary">
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                    {{$departments->code.'- '}}  {{$departments->name}}
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="tab-content">
                

                <div class="tab-pane active" id="messages">
                  <div class="row float-right">
                  <div class="col-sm-12">
                    <a href="" class="btn btn-primary btn-sm">
                      Back
                    </a>
                  </div>
                  
                  </div>
                   
                  <table class="table tablemanager" id="educbg">
                  	 <thead class=" text-primary">
                  	  <th>Employee</th>
                      <th>Date Added</th>
                     <!--  <th>Status</th> -->
                      <th class="text-right td-action">Actions</th>
                     <!-- @if(count($designation_records) == 0)
                        @if(!isset($desig_record->until))
                        <th class="td-action text-right">Action</th>
                        @endif
                    @else
                      @foreach($designation_records as $records)
                        @if(!isset($records->until))
                        
                        @endif
                      @endforeach
             
                    @endif -->
                  <!--   @if(count($designation_records) == 0)
                          @if(!isset($desig_record->until))
                          <th class="td-action text-right">Action</th>
                          @endif
                          @endif
 -->
                    
                      </thead>
                      <tbody>
                        @foreach($employees_in_dept as $emp_dept)
                        @if(!isset($emp_dept->until))
                        <tr>
                          <td>

                            @foreach($users as $user)
                              @if($emp_dept->user_id == $user->id)
                                {{$user->user->fname.' '.$user->user->lname}}
                              @endif
                            @endforeach

                          </td>
                          <td>
                              <?php echo date('F d, Y H:i', strtotime($emp_dept->created_at))?>
                       
                          </td>
                          <!-- <td>
                            <i class="material-icons" style="color: green;">
                              check_circle
                            </i>
                          </td> -->
                          <td class="td-action text-right">
                              <a href="" class="btn btn-sm btn-danger" data-toggle="modal" data-target=".remove-{{$emp_dept->user_id}}">
                                Remove
                              </a>
                          </td>

                          <div class="modal fade remove-{{$emp_dept->user_id}}" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header bg-danger">
                                  <h5 class="modal-title" style="color:white; ">Remove Employee from this department?</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <h5>Are you sure you want to remove employee from this department? </h5>

                                  
                                  <p> By clicking remove, this cannot be undone.</p>
                                  <div>
                                   
                                  </div>
                                </div>
                                <form  method="post" action="{{route('dept.remove_employee', [$id=Crypt::encrypt($emp_dept->user_id) , $dept_id= Crypt::encrypt($departments->id)])}}">
                                 @csrf
                                 @method('post')
                                <div class="modal-footer">
                                  <button type="submit" class="btn btn-danger">Remove</button>
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                              </form>
                              </div>
                            </div>
                      </div>
                         <!--  @if(count($designation_records) == 0)
                          @if(!isset($desig_record->until))
                          <td class="td-action text-right">
                            <a class="btn btn-success" style="color: white;"
                            href="{{route('dept.designate', [$id= Crypt::encrypt($departments->id), $emp_id=Crypt::encrypt($user->id)])}}"
                            >
                              Designate as Head
                            </a>
                          </td>
                          @endif
                          @endif -->


                    
                        </tr>
                        @endif
                        @endforeach
                        
                        
                      </div>
                      </tbody>
                      
                  </table>
                  
                </div>

              </div>
            </div>

          </div>

        </div>
    </div>

    <div class="row">
      <div class="col-lg-12 col-md-12">
          <div class="card" id="profcard">
            <div class="card-header card-header-tabs card-header-primary">
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                    ADD EMPLOYEE TO {{$departments->code}} 
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="tab-content">


                <div class="row">
                  <div class="col-sm-12">
                    <label>Selected Employee(s)</label>
                    <textarea id="sel_emp" class="form-control" rows="4" readonly=""></textarea>
                  </div>
                </div>

                <div class="row">
                <div class="col-sm-9">
                <form  method="post" action="{{route('dept.add_employee',  [$id= Crypt::encrypt($departments->id)])}}">
                   @csrf
                   @method('post')
                   <div id="pinili">
                   
                 </div>
                                  
                  <select size="5"  id="selpick" class="selectpicker form-control " multiple="multiple"  data-live-search="true" name="employees[]" style="height: 50px !important;" onchange="showname();">

                  @foreach ($users as $user)
                  <?php $exist=0; ?>
                  @foreach ($dept_records as $dept_record)
                    @if($dept_record->user_id == $user->id && !isset($dept_record->until))
                    <?php $exist++; ?>
                    @endif
                  @endforeach

                  @if($exist==0)
                  <option value="{{$user->id}}" >{{$user->user->lname.', '.$user->user->fname .'           '}}</option>
                  @endif
            
                                  
                  @endforeach
                  </select>
                 
                  </div>
                  <div class="col-sm-3 pull-right">
                    <button type="submit" id="add_emp" class="btn btn-success" disabled style="width: 100%">Add</button>           
  
                 
                  </div>
                </form>
              </div>
              </div>
            </div>  
        </div>
      </div>
    </div>


  </div>
</div>
<script type="text/javascript" src="{{ asset('material') }}/js/tableManager.js"></script>
<script type="text/javascript">
    // basic usage
    $('.tablemanager').tablemanager({
      firstSort: [[5,'desc']],
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
      disableFilterBy: [7]
    });
    // $('.tablemanager').tablemanager();
  </script>
<script>
  setTimeout(function() {
    $('#successMessage').fadeOut('fast');
}, 5000); // <-- time in milliseconds

  function putIt(e) {
    $("#sel_emp").val($('#selpick option:selected').text());
    if (!$("#sel_emp").val()) {
    $("#add_emp").attr('disabled', true);
    }
    else{
      $("#add_emp").attr('disabled', false);
    }
}

$("#selpick").on("change", putIt);


</script>


@endsection

 