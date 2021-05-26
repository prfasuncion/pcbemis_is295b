@extends('layouts.adminapp', ['activePage' => 'evaluations', 'titlePage' => __('Evaluations')])


@section('content')
 @csrf
<div class="content" id="content">
  <div class="container-fluid">
    <div class="row">

      <div class="col-sm-12">
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
      <h4> 
          @foreach($acadyear as $year)
              @foreach($year->ay_details as $sem_details)
                  @if($evaluation->sem_id == $sem_details->id)
                    {{$sem_details->name.' '.$year->start_ay.'-'.$year->end_ay}}
                  @endif
              @endforeach
          @endforeach
          Evaluation
      </h4>
      </div>
      <div class="col-lg-12 col-md-12">
          <div class="card" id="profcard">
            <div class="card-header card-header-tabs card-header-warning">
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                    {{$departments->code.'-'.$departments->name}}
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="tab-content">
            

                <div class="tab-pane active" id="messages">
                  <div class="row">
                    <div class="col-6">
                    <!-- <h4>Evaluator: {{$designations->desig_title.'- '}}

                         @foreach($desig_records as $records)
                          @foreach ($users as $u)

                               @if($u->id == $records->user_id)
                               <?php $name=$u->user->lname.', '.$u->user->fname;
                               ?>
                               
                              @endif
                          @endforeach
                             
                      
                         @endforeach

                         @if(!isset($name))
                         <p class="text-danger">{{'Please Assign Department Head!'}}</p>
                         @else
                          {{$name}}
                          @endif
                    </h4> -->
                  </div>
                    <div class="col-6 text-right">
                      <a href="{{ url()->previous() }}"  class="btn btn-sm btn-warning">BACK</a>
                      <!--    <a href="{{ route('evaluation_kpi.index') }}" class="btn btn-sm btn-primary">Evaluation KPI's Category</a> -->
                    </div>
                  </div>
                   <div class="table-responsive">
                  <table class="table tablemanager" id="educbg">
                  	 <thead class=" text-primary">
                  	   <th>Employee</th>
                       <th>Evaluator</th>
                       <th>Date Evaluated</th>
                       <th class="td-action text-right">Action</th>
                      </thead>
                      <tbody>
                        
                        @foreach($employees_in_dept as $emp_dept)
                          @foreach($eval_results as $ev_res)
                            @foreach($eval_sets as $set)
                                @if($emp_dept->user_id == $ev_res->user_id && $ev_res->eval_set_id == $set->id)
                                  <?php $evaldate= $ev_res->created_at; 
                                   
                                  ?>
                                @endif

                                @if(!isset($evaldate))
                              <?php $evaldate=now(); ?>
                            @endif
                            @endforeach
                          @endforeach
                            
                          
                        @if(!isset($emp_dept->until) ||  $emp_dept->until > $evaluation->created_at && $evaldate < $emp_dept->until)
                        <tr>
                          <td>

                            @foreach($users as $user)
                              @if($emp_dept->user_id == $user->id)
                                {{$user->user->fname.' '.$user->user->lname}}
                                <?php $employee_id= $user->id; ?>
                              @endif
                            @endforeach

                          </td>
                            <?php $res_exist=0; ?>
                          @foreach($eval_results as $result)
                              @if($result->user_id == $employee_id)
                                  <?php $res_exist++; 
                                  $date_e = $result->created_at; 
                                    $res_evaluator= $result->evaluator;
                                  ?>
                                
                              @else
                                  <!-- <?php $ename=null; $date_eval=null;?> -->
                              @endif

                          @endforeach

                          @if($res_exist>0)
                              @foreach($eval_results as $records)
                                @foreach ($users as $u)

                                     @if($u->id == $res_evaluator)
                                     <?php $ename=$u->user->lname.', '.$u->user->fname;

                                     $date_eval= $date_e;
                                     ?>
                                     
                                    @endif
                                @endforeach
                                @endforeach 

                          @endif
                            <?php $result_exist=0; ?>
                            @foreach($eval_results as $result)
                              @foreach($eval_sets as $set)
                                @if($result->eval_set_id == $set->id && $set->eval_id == $evaluation->id)
                                @if($result->user_id == $employee_id)
                                  <?php $result_exist++; ?>
                                @endif
                                @endif

                              @endforeach
                            @endforeach  

                         
                          <td>
                            @if($result_exist > 0)
                                @if(isset($ename))
                                {{$ename}}
                                @else

                                @endif
                            @endif
                          </td>
                          <td>
                            @if($result_exist > 0)
                                @if(isset($date_eval))
                               <?php echo date('F d, Y H:i', strtotime($date_eval))?>
                                @else

                                @endif
                            @endif
                          </td>
                          <td class="td-action text-right">
                             

                            @if($result_exist==0)
                            <a rel="tooltip" class="btn btn-sm btn-success " href="{{route('evaluation.admin_evaluate_employee', [$id= Crypt::encrypt($evaluation->id), $emp_id=Crypt::encrypt($employee_id)])}}" data-original-title="" title="" >
                              
                              <i class="material-icons"></i>Evaluate
                              <div class="ripple-container"></div>
                            </a>
                            @else
                            <a rel="tooltip" class="btn btn-sm btn-primary " href="{{route('evaluation.employee_evaluation_result', [$id= Crypt::encrypt($evaluation->id), $emp_id=Crypt::encrypt($employee_id)])}}" data-original-title="" title="" >
                          
                              <i class="material-icons">visibility</i> View
                              <div class="ripple-container"></div>
                            </a>
                            @endif
                          </td>
                        </tr>
                        @endif
                        @endforeach
                      </tbody>
                    
                  </table>
                  </div>
                  
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
</script>
@endsection

 