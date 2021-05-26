@extends('layouts.adminapp', ['activePage' => 'evaluations', 'titlePage' => __('Evaluations')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-warning">
              <h4 class="card-title ">Evaluations</h4>
              <p class="card-category"> Here you can manage evaluations</p>
            </div>
            <div class="card-body">
               @if (session()->has('success'))
                   <div class="row" id="successMessage">
                    <div class="col-sm-12">
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>{{ session()->get('success') }}</span>
                      </div>
                    </div>
                  </div>   
               @endif
              <div class="row">
                <div class="col-12 text-right">

                  <a href="{{ route('evaluations.create') }}" class="btn btn-sm btn-warning">Create Evaluation</a>
                  <a href="{{ route('evaluation_kpi.index') }}" class="btn btn-sm btn-warning">Evaluation KPI's</a>

                </div>
              </div>
              <div class="table-responsive">
                <table class="table">
                  <thead class=" text-primary">

                 
                    <tr><th>
                       Evaluation
                    </th>
             <!--        <th>
                      Status
                    </th> -->
                    <th>
                      Date Generated
                    </th>
                    <th class="text-right">
                      Actions
                    </th>
                  </tr></thead>
                  <tbody>
                        @foreach($evaluations as $evaluation)
                        <tr>
                        <td>
                            @foreach($acadyear as $year)
                              @foreach($year->ay_details as $sem_details)
                                @if($evaluation->sem_id == $sem_details->id)
                                  {{$sem_details->name.' '.$year->start_ay.'-'.$year->end_ay}}
                                @endif
                              @endforeach
                            @endforeach
                        </td>
                     <!--    <td>
                      
                        </td> -->
                        <td>
                          @if(isset($evaluation->published))
                          <?php echo date('F d, Y ', strtotime($evaluation->published))?>
                          @endif
                          
                        </td>
                        <td class="td-actions text-right">
                          <?php $count_set=0; ?>
                          @foreach($eval_sets as $eval_set)
                          @if($evaluation->id == $eval_set->eval_id)
                              <?php $count_set++; ?>
                          @endif
                          @endforeach

                            @if($count_set==0)
                            

                            <a rel="tooltip" class="btn btn-success " href="{{route('evaluation.setevaluation', [Crypt::encrypt($evaluation->id)])}}" data-original-title="" title="">
                              <i class="material-icons">settings</i> SET KPI
                              <div class="ripple-container"></div>
                            </a>

                            <a rel="tooltip" class="btn btn-danger btn-link " href="" data-original-title="" title="" data-toggle="modal" data-target=".delete-{{$evaluation->id}}">
                          
                              <i class="material-icons">delete</i>
                              <div class="ripple-container"></div>
                            </a>

                            @else

                           
                            
                          @if($evaluation->status != 1)
                          <a rel="tooltip" class="btn btn-success btn-link " href="{{route('evaluation.view_evaluation', [Crypt::encrypt($evaluation->id)])}}" data-original-title="" title="">
                          
                              <i class="material-icons">visibility</i>
                              <div class="ripple-container"></div>
                            </a>
                            <a rel="tooltip" class="btn btn-warning " href="" data-original-title="" title="" data-toggle="modal" data-target=".reset-{{$evaluation->id}}">
                              <i class="material-icons">restore</i> Reset
                              <div class="ripple-container"></div>
                            </a>
                            <a rel="tooltip" class="btn btn-success " href="" data-original-title="" title="" data-toggle="modal" data-target=".publish-{{$evaluation->id}}">
                          
                              <i class="material-icons"></i>PUBLISH
                              <div class="ripple-container"></div>
                            </a>
                            @else
                            <a rel="tooltip" class="btn btn-info " href="{{route('evaluation.viewpublished_evaluation', [Crypt::encrypt($evaluation->id)])}}" data-original-title="" title="" >
                          
                              <i class="material-icons">visibility</i> VIEW EVALUATIONS
                              <div class="ripple-container"></div>
                            </a>

                            @if(!isset($evaluation->released))
                            <a rel="tooltip" class="btn btn-primary " href="" data-original-title="" title="" data-toggle="modal" data-target=".show-{{$evaluation->id}}">
                          
                              <i class="material-icons">visibility</i> SHOW RESULTS TO EMPLOYEES
                              <div class="ripple-container"></div>
                            </a>
                            @else
                            <a rel="tooltip" class="btn btn-warning " href="" data-original-title="" title="" data-toggle="modal" data-target=".hide-{{$evaluation->id}}">
                          
                              <i class="material-icons">visibility</i> HIDE RESULTS TO EMPLOYEES
                              <div class="ripple-container"></div>
                            </a>
                            @endif

                            @endif


                            @endif

                            <div class="modal fade reset-{{$evaluation->id}}" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" style="">Reset Evaluation</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body" align="left">
                                  <h5>Are you sure you want to reset this? </h5>
                                  <p>All of the KPI's set will be cleared and you have to set again.</p>
                                </div>
                                <form  method="post" action="{{route('evaluation.resetevaluation', [Crypt::encrypt($evaluation->id)])}}">
                                 @csrf
                                 @method('post')
                                <div class="modal-footer">
                                  <button type="submit" class="btn btn-danger">Reset</button>
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                              </form>
                              </div>
                            </div>
                            </div>


                            <div class="modal fade delete-{{$evaluation->id}}" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" style="">Delete Evaluation</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body" align="left">
                                  <h5>Are you sure you want to delete this evaluation? </h5>
                                  
                                </div>
                                <form  method="post" action="{{route('evaluation.delete_evaluation', [Crypt::encrypt($evaluation->id)])}}">
                                 @csrf
                                 @method('post')
                                <div class="modal-footer">
                                  <button type="submit" class="btn btn-danger">Delete</button>
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                              </form>
                              </div>
                            </div>
                            </div>


                             <div class="modal fade publish-{{$evaluation->id}}" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" style="">Publish Evaluation</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body" align="left">
                                  <h5>Are you sure you want to publish this evaluation? </h5>
                                  <p>By publishing this evaluation, it cannot be reset anymore.</p>
                                  <p>Once published, employees may now be evaluated.</p>
                                </div>
                                <form  method="post" action="{{route('evaluation.publish_evaluation', [Crypt::encrypt($evaluation->id)])}}">
                                 @csrf
                                 @method('post')
                                <div class="modal-footer">
                                  <button type="submit" class="btn btn-success">Publish</button>
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                              </form>
                              </div>
                            </div>
                            </div>
                            
                            <div class="modal fade show-{{$evaluation->id}}" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" style="">Show Evaluation to Users</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body" align="left">
                                  <h5>Are you sure you want to show this evaluation to employees? </h5>
                                  
                                  <p>Employees may now be able to see the result of their evaluations.</p>
                                </div>
                                <form  method="post" action="{{route('evaluation.show_evaluation', [Crypt::encrypt($evaluation->id)])}}">
                                 @csrf
                                 @method('post')
                                <div class="modal-footer">
                                  <button type="submit" class="btn btn-success">Show</button>
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                              </form>
                              </div>
                            </div>
                            </div>

                            <div class="modal fade hide-{{$evaluation->id}}" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" style="">Hide Evaluation Results to Users</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body" align="left">
                                  <h5>Are you sure you want to hide this evaluation results to employees? </h5>
                                  
                                  <p>Employees will now be unable to see the result of their evaluations.</p>
                                </div>
                                <form  method="post" action="{{route('evaluation.hide_evaluation', [Crypt::encrypt($evaluation->id)])}}">
                                 @csrf
                                 @method('post')
                                <div class="modal-footer">
                                  <button type="submit" class="btn btn-success">Submit</button>
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                              </form>
                              </div>
                            </div>
                            </div>
                        </td>
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
<script type="text/javascript">
  setInterval(function() {
                  window.location.reload();
                }, 30000); 

</script>
<script>
  setTimeout(function() {
    $('#successMessage').fadeOut('fast');
}, 5000); // <-- time in milliseconds
</script>
@endsection
