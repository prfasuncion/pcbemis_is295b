@extends('layouts.app', ['activePage' => 'usertask', 'titlePage' => __('My Tasks')])

@section('content')
 @csrf
<div class="content" id="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 col-md-12">
          <div class="card" id="profcard">
            <div class="card-header card-header-tabs card-header-danger">
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                  <ul class="nav nav-tabs" data-tabs="tabs">
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
                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('usertask.index') }}">
                        <i class="material-icons">account_box</i> NEW TASKS <span class="notification">{{'('.$new.')'}}</span>
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('utask.task_ongoing')}}">
                        <i class="material-icons">verified</i> IN-PROGRESS <span class="notification">{{'('.$ongoing.')'}}</span>
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" href="{{route('utask.task_finished')}}" >
                        <i class="material-icons">school</i> FINISHED TASKS
                        <span class="notification">{{'('.$finished.')'}}</span>
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                   
                  </ul>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="tab-content">
            

                <div class="tab-pane active" id="messages">
                  <div class="row">
                  <div class="col-sm-6">
                    <h5><strong>Finished Tasks</strong></h5>
                  </div>
                  <div class="col-sm-6">
                    
                  </div>
                  </div>
                  <div class="table-responsive">
                  <table class="table tablemanager" id="educbg">
                    <tr>
                  	 <thead class=" text-primary">
                  	  <th>Task</th>
                  <!--     <th>Description</th> -->
                      <th>Date Assigned</th>
                      <th>Semester</th>
                      <th>Due</th>
                      <th>Date Finished</th>
                      <th>Action</th>
                      </thead>
                    </tr>
                    <tbody>
                      @foreach ($task as $x)
                      @foreach ($x->assigned_details as $y)
                      @if(isset($y->finished))
                      <tr>
                        <td>{{$x->name}}</td>
                        <!-- <td>{{$x->description}}</td> -->
                        <td>
                          <?php echo date('F d, Y H:i', strtotime($y->created_at))?>
                        </td>
                        <td>
                          <?php 
                              $tsem = App\Models\Sem::where(['id' => $x->sem_id ])->get()->first();
                              $ay = App\Models\AcadYear::where(['id' => $tsem->ay_id])->get()->first();
                           ?>
                          {{$tsem->name." ".$ay->start_ay."-". $ay->end_ay}}
                        </td>
                        <td>
                          <?php echo date('F d, Y H:i', strtotime($x->due))?>
                        </td>
                        <td>
                          <?php echo date('F d, Y H:i', strtotime($y->finished))?>
                        </td>
                        <td >

                        <!--    <a rel="tooltip" class="btn btn-success " href="{{ route('utask.ongoing', [Crypt::encrypt($x->id)]) }}" data-original-title="" title="View Task">
                              Acknowledge
                              
                            </a> -->
                         <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('utask.finished', [Crypt::encrypt($x->id)]) }}" data-original-title="" title="View Task">
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
      disableFilterBy: [6]
    });
    // $('.tablemanager').tablemanager();
  </script>
@endsection

