@extends('layouts.adminapp', ['activePage' => 'tasks', 'titlePage' => __('Tasks/Assignments')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-danger">
       <!--        <h4 class="card-title ">Tasks/Assignments</h4>
              <p class="card-category"> Here you can manage tasks</p> -->
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                  <span class="nav-tabs-title">Tasks:</span>
                  <ul class="nav nav-tabs" data-tabs="tabs">
                    <li class="nav-item">
                      <a class="nav-link" href="{{route('tasks.index')}}" >
                        <i class="material-icons">content_paste</i> All
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                    
                    <li class="nav-item">
                      <a class="nav-link" href="{{route('task.forassign')}}" >
                        <i class="material-icons">supervised_user_circle</i> For Assignment
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                    

                    <li class="nav-item">
                      <a class="nav-link" href="{{route('task.in_progress')}}" >
                        <i class="material-icons">trending_up</i> In Progress
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" href="{{route('task.finished')}}" >
                        <i class="material-icons">check_circle</i> Finished
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                 <!--    <li class="nav-item">
                      <a class="nav-link" href="#settings" >
                        <i class="material-icons">block</i> Cancelled
                        <div class="ripple-container"></div>
                      </a>
                    </li> -->
                  </ul>
                </div>
              </div>
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
               <!--  <div class="col-12 text-right">
                  <a href="{{ route('tasks.create') }}" class="btn btn-sm btn-primary">Create a Task</a>
                </div> -->
              </div>
              <div class="table-responsive">
                <table class="table tablemanager">
                  <thead class=" text-primary">
                    <tr>
                    <!--   <th>
                        No. 
                      </th> -->
                      <th>
                       Task Name
                    </th>
                  <!--   <th>
                      Status
                    </th> -->
                   <!--  <th>
                      Semester
                    </th> -->
                    <th>
                      Creation date
                    </th>
                    <th>Sem</th>
                    <th>
                      Due
                    </th>
                    <th class="text-right">
                      Actions
                    </th>
                  </tr></thead>
                  <tbody>
                    <?php $num=0; ?>
                  @foreach($tasks as $task)
                                     

                        <?php $count=0; $accept=0; $fin=0; $created=0; ?>
                            @foreach($assigned as $assign)
                            @if($task->id == $assign->task_id)
                            <?php $count++; ?>
                              @if(isset($assign->accepted))
                              <?php $accept++; ?>
                              @endif
                              @if(isset($assign->finished))
                              <?php $fin++; ?>
                              @endif
                               @if(isset($assign->created_at))
                              <?php $created++; ?>
                              @endif
                            @endif
                            
                            @endforeach
                        @if($count>0 && $count==$fin)
                        <?php $num++;  ?>
                        <tr>
                          
                   <!--      <td>
                            {{$num}}
                        </td> -->
                        <td>
                           {{$task->name}}
                        </td>
                      <!--   <td></td> -->
                      <!--   <td>
                        
                          {{$sem->name}}
                       
                        </td> -->
                        <td>
                        
                           <?php echo date('F d, Y H:i', strtotime($task->created_at))?>
                        </td>
                        <td>
                          <?php $ay = App\Models\AcadYear::where(['id' => $sem->ay_id])->get()->first();
                              $tsem = App\Models\Sem::where(['id' => $task->sem_id ])->get()->first();
                           ?>
                          {{$tsem->name." ".$ay->start_ay."-". $ay->end_ay}}
                       
                        </td>
                            <td>
                
                          <?php echo date('F d, Y H:i', strtotime($task->due))?>
                        </td>
                        <td class="td-actions text-right">
                          @if($count>0)
                            <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('task.task_assigned', [Crypt::encrypt($task->id)]) }}" data-original-title="" title="View Task">
                              <i class="material-icons">visibility</i>
                              <div class="ripple-container"></div>
                            </a>
                           <!--  <a rel="tooltip" class="btn btn-warning btn-link" href="{{ route('task.edit', [Crypt::encrypt($task->id)]) }}" data-original-title="" title="Cancel Task">
                              <i class="material-icons">report_problem</i>
                              <div class="ripple-container"></div>
                            </a> -->
                          @else
                            <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('task.edit', [Crypt::encrypt($task->id)]) }}" data-original-title="" title="Edit Task">
                              <i class="material-icons">edit</i>
                              <div class="ripple-container"></div>
                            </a>

                            <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('task.assign', [Crypt::encrypt($task->id)]) }}" data-original-title="" title="Assign Task">

                              <i class="material-icons">person_add</i>
                              <div class="ripple-container"></div>
                            </a>


                           
                            <a rel="tooltip" class="btn btn-danger btn-link" href="}}" data-original-title="" title="Delete Task">
                              <i class="material-icons">delete</i>
                              <div class="ripple-container"></div>
                            </a>
                            @endif
                            </td>
                      </tr>
                      @endif
                       <div class="modal fade  assignperson" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title">Delete</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <p>Are yoou sure you want to delete this?</p>
                                  <div>
                                   
                                  </div>
                                </div>
                                <form  method="post" action="">
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
             
            @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
               
      </div>
    </div>
    <div class="row float-right">
    
                  <div class="col-12 text-right">
        <!--     <ul class="pagination pagination-lg pager" id="myPager"></ul> -->
                  </div>
            </div>
    
  </div>
</div>

<script>
  setTimeout(function() {
    $('#successMessage').fadeOut('fast');
}, 5000); // <-- time in milliseconds
</script>

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
      disableFilterBy: [5]
    });
    // $('.tablemanager').tablemanager();
  </script>
@endsection