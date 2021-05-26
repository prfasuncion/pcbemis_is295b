@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <h3>Welcome, {{ $user->user->fname.' '.$user->user->lname.' '.$user->user->name_ext.'!' }}</h3>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="material-icons">new_releases</i>
              </div>
              <?php $new=0; $ongoing=0; $finished=0; ?>
                    @foreach ($task as $a)
                      @foreach ($a->assigned_details as $b)
                        @if(!isset($b->accepted))
                        <?php $new++; ?>
                        @endif
                        @if(isset($b->accepted) && !isset($b->finished))
                        <?php $ongoing++; ?>
                        @endif
                        @if(isset($b->accepted))
                        <?php $finished++; ?>
                        @endif
                      @endforeach
                    @endforeach
              <p class="card-category">NEW Tasks</p>
              <h3 class="card-title">{{$new}}</h3>
              <small class="text-dark">For Acknowledgement</small>
             
            </div>
            <div class="card-footer">
              <div class="stats">
                 <i class="material-icons text-danger">new_releases</i>
               <a href="{{ route('usertask.index') }}">Go to Tasks</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-primary card-header-icon">
              <div class="card-icon">
                <i class="material-icons">campaign</i>
              </div>
              <p class="card-category">Job Opportunitiess</p>
              <h3 class="card-title">{{count($joboppor)}}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons text-primary">campaign</i>
               <a href="{{ route('user_jobopportunity.index') }}">Go to Job Opportunities</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
                <i class="material-icons">fact_check</i>
              </div>
              <p class="card-category">Evaluation Records</p>

              <h3 class="card-title">{{count($evaluations)}}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons text-warning">fact_check</i>
               <a href="{{ route('user_evaluation.index') }}">Go to Job Evaluations</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
                <i class="material-icons">move_to_inbox</i>
              </div>
              <?php $pending_req=0; ?>
              @foreach($document_requests as $doc_req)
                @if(!isset($doc_req->status))
                  <?php $pending_req++; ?>
                @endif
              @endforeach
              <p class="card-category">Requests</p>
              <h3 class="card-title">{{$pending_req}}</h3>
              <small class="text-dark">Pending Document Request</small>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons text-info">move_to_inbox</i>
               <a href="{{ route('request.index') }}">Go to Self-Services</a>
              </div>
            </div>
          </div>
        </div>
      
      </div>

      
      <div class="row">
        <div class="col-lg-6 col-md-12">
          <div class="card">
            <div class="card-header card-header-tabs card-header-success">
              <h4 class="card-title">TASKS</h4>
              <p class="card-category">In-Progress</p>
            </div>
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane active" id="profile">
                <table class="table tablemanager">
                     <thead class=" text-primary">
                      <th>Task</th>
                  
                    
                      <th>Due</th>
                      <!-- <th>Date Acknowledged</th> -->
                      <th class="text-right">Action</th>
                      </thead>
                      <tbody>
                        @foreach ($task as $x)
                        @foreach ($x->assigned_details as $y)
                        @if(isset($y->accepted) && !isset($y->finished))
                        <tr>
                          <td>{{$x->name}}</td>
                         
                          <td>
                            <?php echo date('F d, Y H:i', strtotime($y->created_at))?>
                          </td>
                          
                        
                          <td class="text-right">

                       
                           <a rel="tooltip" class="btn btn-success btn-sm" href="{{ route('utask.ongoing', [Crypt::encrypt($x->id)]) }}" data-original-title="" title="View Task">
                                <i class="material-icons">visibility</i>
                                <div class="ripple-container"></div>
                              </a>
                          </td>
                        </tr>
                        @endif
                        @endforeach
                        @endforeach
                      </tbody>
                  </table>
                </div>
              
                
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-12">
          <div class="card">
            <div class="card-header card-header-danger">
              <h4 class="card-title">TASKS</h4>
              <p class="card-category">Due Today</p>
            </div>
            <div class="card-body table-responsive">
              <table class="table tblmngr" style="max-height: 400px;  overflow-y: auto;">
                  <thead class=" text-primary">
                    <tr>
                   <!--    <th>
                        No. 
                      </th> -->
                      <th>
                       Task Name
                    </th>

                
                    
                   
                    <th class="text-right">
                      Action
                    </th>
                   
                  </tr></thead>
                  <tbody id="myTable">
                    <?php $num=0; $tday= date("Y-m-d"); ?>
                  @foreach($tasks as $task)
                   @foreach ($task->assigned_details as $y)

                      <?php $due= date('Y-m-d', strtotime($task->due)); ?>
                    @if($due == $tday)
                      <?php $num++; ?>
                        <tr>
                      <!--   <td>
                  {{$num}}
                        </td> -->
                        <td>
                           {{$task->name}}
                        </td>
                     
                       <td class="text-right td-actions">
                         <a rel="tooltip" class="btn btn-success btn-sm" href="{{ route('task.task_assigned', [Crypt::encrypt($task->id)]) }}" data-original-title="" title="View Task">
                              <i class="material-icons">visibility</i>
                              <div class="ripple-container"></div>
                            </a>
                       </td>
                       
                        
                       
                      </tr>

                      
                      @endif
                      @endforeach
                       @endforeach
                       @if($num==0)
                       <tr>
                        <td>
                         There are no tasks due today
                       </td>
                       </tr>
                       @endif
                  </tbody>
                </table>
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
      firstSort: [[3,'desc']],
      disable: ["last"],
      appendFilterby: true,
      dateFormat: [[4,"mm-dd-yyyy"]],
      debug: true,
      vocabulary: {
    voc_filter_by: 'Filter By',
    voc_type_here_filter: 'Search...',
    voc_show_rows: '  Rows/Page'
  },
      pagination: true,
      // showrows: [5,10,15,20],
      disableFilterBy: [3]
    });

    
    // $('.tablemanager').tablemanager();
  </script>
<script type="text/javascript">
  setInterval(function() {
                  window.location.reload();
                }, 30000); 

</script>
@endsection
