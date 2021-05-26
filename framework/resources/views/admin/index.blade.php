@extends('layouts.adminapp', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <?php
        $userprofile= App\Models\User::with('user')->get()->All();
        $department= App\Models\department::All();
        $dept_records= App\Models\department_records::All();
        $designations= App\Models\Designations::All();
        $desig_records = App\Models\designation_records::All();
        $sem = App\Models\Sem::where(['status' => 1])->get()->first();
        $users= App\Models\User::All();
        $assigned= App\Models\assigned_task::All();
        $tasks= App\Models\Tasks::All();
        $reqs= App\Models\UserSelfService::where('status', null)->get()->All();
        $job_opps= App\Models\JobOpp::All();
        $exit_apps= App\Models\UserExitApplication::where('approved', null)->get()->All();
        ?>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
                <i class="material-icons">move_to_inbox</i>
              </div>
              <p class="card-category">Requests</p>
              <h3 class="card-title">{{count($reqs)}}
              
              </h3>
              <small class="text-dark">Pending</small>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons text-warning">move_to_inbox</i>
                <a href="{{ route('req.view') }}">Go to Requests</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="material-icons">new_releases</i>
              </div>
              <p class="card-category">Tasks</p>
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
                        @if($count>0 && $count>$fin)
                        <?php $num++;  ?>
                        @endif
                  @endforeach
              <h3 class="card-title">{{$num}}</h3>
              <small class="text-dark">In-Progress</small>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons text-danger">new_releases</i>
               <a href="{{ route('tasks.index') }}">Go to Tasks</a>
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
              <p class="card-category">Job Posts</p>
              <?php $published=0; ?>
              @foreach($job_opps as $job_opp)
                @if($job_opp->status==1)
                  <?php $published++; ?>
                @endif
              @endforeach
              <h3 class="card-title">{{$published}}</h3>
              <small class="text-dark">Published</small>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons text-primary">campaign</i>
               <a href="{{ route('job_opportunity.index') }}">Go to Job Opportunities</a>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
                <i class="material-icons">follow_the_signs</i>
              </div>
              <p class="card-category">Exit Applicants</p>
              <?php $exit_pending=0; ?>
              @foreach($exit_apps as $exit_app)
                @if(!isset($exit_app->approved))
                  <?php $exit_pending++; ?>
                @endif
              @endforeach
              <h3 class="card-title">{{$exit_pending}}</h3>
              <small class="text-dark">Pending</small>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons text-info">follow_the_signs</i>
               <a href="{{ route('exit.view') }}">Go to Exit Management</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <!-- <div class="col-md-4">
          <div class="card card-chart">
            <div class="card-header card-header-success">
              <div class="ct-chart" id="dailySalesChart"></div>
            </div>
            <div class="card-body">
              <h4 class="card-title">Daily Sales</h4>
              <p class="card-category">
                <span class="text-success"><i class="fa fa-long-arrow-up"></i> 55% </span> increase in today sales.</p>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time</i> updated 4 minutes ago
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card card-chart">
            <div class="card-header card-header-warning">
              <div class="ct-chart" id="websiteViewsChart"></div>
            </div>
            <div class="card-body">
              <h4 class="card-title">Email Subscriptions</h4>
              <p class="card-category">Last Campaign Performance</p>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time</i> campaign sent 2 days ago
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card card-chart">
            <div class="card-header card-header-danger">
              <div class="ct-chart" id="completedTasksChart"></div>
            </div>
            <div class="card-body">
              <h4 class="card-title">Completed Tasks</h4>
              <p class="card-category">Last Campaign Performance</p>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time</i> campaign sent 2 days ago
              </div>
            </div>
          </div>
        </div> -->
      </div>
      <div class="row">
       <div class="col-lg-8 col-md-12">
          <div class="card">
            <div class="card-header card-header-success">
              <h4 class="card-title">PCB Directory</h4>
              <p class="card-category">Employees List</p>
            </div>
            <div class="card-body table-responsive">
             <table class="table tablemanager">
                  <thead class=" text-primary">
                    <tr><th>
                        Name
                    </th>
                    <th>
                      Department
                    </th>
                    <th>
                      Designation
                    </th>
                    <th class="text-right">
                      Action
                    </th>
                  </tr></thead>
                  <tbody>
                    @foreach ($userprofile as $x)
                        <tr>
                        <td>
                           @if(!isset($x->image))
                           <img class="card-img-top ml-auto mr-auto " src='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSQJxKGGpPc9-5g25KWwnsCCy9O_dlS4HWo5A&usqp=CAU'  id="img" style="height: 50px; width: 50px; max-height: 50px; border-radius: 50%; "> 
                            @else
                            <img class="card-img-top ml-auto mr-auto " src="<?php echo asset( $x->image); ?>"  id="img" style="height: 50px; width: 50px; max-height: 50px; border-radius: 50%; ">
                            @endif

                          
                          {{ $x->user->lname.', '.$x->user->fname }}
                       
                        
                        </td>
                        <?php $emp_dept=''; ?>
                        @foreach($dept_records as $dep_rec)

                          @if($x->id == $dep_rec->user_id && !isset($dep_rec->until))
                            @foreach($department as $dept)
                              @if($dep_rec->dept_id == $dept->id)
                                <?php $emp_dept= $dept->code; ?>
                              @else
                              @endif
                            @endforeach
                          @endif    
                        @endforeach
                        <td>
                          @if(isset($emp_dept))
                            {{$emp_dept}}
                          @else
                            {{''}}
                          @endif
                        </td>

                        
                        
                        <td>
                          <?php $emp_desig=''; ?>
                        @foreach($desig_records as $des_rec)

                          @if($x->id == $des_rec->user_id && !isset($des_rec->until))
                            @foreach($designations as $designation)
                              @if($des_rec->desig_id == $designation->id)
                               <p> {{ $designation->desig_title }} </p>
                              @else
                              @endif
                            @endforeach
                          @endif   

                        @endforeach

                         
                        </td>
                        <td class="td-actions text-right">
                              <!-- <a rel="tooltip" class="btn btn-success btn-link" href="#" data-original-title="" title="">
                              <i class="material-icons">edit</i>
                              <div class="ripple-container"></div>
                            </a> -->
                              @if($x->id == Auth::user()->id)
                            @else
                            <a rel="tooltip" class="btn btn-primary" href="{{ route('employee.view_profile', [Crypt::encrypt($x->id)]) }}" data-original-title="" title="">
                              <i class="material-icons">visibility</i> View Profile
                              <div class="ripple-container"></div>
                            </a>
                            @endif
                        </td>
                      </tr>
                      @endforeach
                                        </tbody>
                </table>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-12">
          <div class="card">
            <div class="card-header card-header-danger">
              <h4 class="card-title">Tasks</h4>
              <p class="card-category">DUE TODAY</p>
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
                  </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<script type="text/javascript">
  setInterval(function() {
                  window.location.reload();
                }, 30000); 

</script>
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
    voc_show_rows: '  Rows Per Page'
  },
      pagination: true,
      showrows: [5,10,15,20],
      disableFilterBy: [4]
    });

    
    // $('.tablemanager').tablemanager();
  </script>
@endsection

