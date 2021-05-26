@extends('layouts.app', ['activePage' => 'exitapp', 'titlePage' => __('Exit Application')])

@section('content')
 @csrf
<div class="content" id="content">
  <div class="container-fluid">
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

                  @if($tasks != null )
                    <div class="col-sm-12">
                      <div class="alert alert-danger">
                        <div class="row">
                        <div class="col-sm-6">
                          <div class="float-left">
                            <h5>ATTENTION: YOU HAVE PENDING TASK!</h5>
                          </div>
                          
                        </div>
                        <div class="col-sm-6">
                          <div class="float-right">
                        <a class="btn btn-sm btn-info" href="{{route('usertask.index')}}">Go to Tasks</a>
                          </div>
                        </div>
                      </div>
                      </div>
                    </div>
                     @endif
    <div class="row">
      <div class="col-lg-12 col-md-12">
          <div class="card" id="profcard">
            <div class="card-header card-header-tabs" style="background-color: gray; color: white;">
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                    Exit Application
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="tab-content">
            

                <div class="tab-pane active" id="messages">
                  <div class="row">
                  <div class="col-sm-12">
                      <h5 ><strong class="text-danger">REMINDER!</strong> <em >Application will only be available if there are no pending tasks.</em> </h5>
                    <h5>STEPS IN FILING EXIT APPLICATION</h5>
                    <ol>
                      <li>Click on apply and write your exit application letter</li>
                      <li>If application is approved, an online exit interview will be available</li>
                      <li>Your account will be deactivated, after successfully answering the exit interview.</li>
                      <li>You still have to comply with the other institutions exit process (such as processing clearance)</li>
                    </ol>
                  </div>

                  <?php $approved=0; $pending=0; ?>
                   @foreach($exit_app as $exit_ap)
                    @if(isset($exit_ap->approved))
                    <?php $approved++; ?>
                    @elseif(!isset($exit_ap->approved) && $exit_ap->status !=2)
                    <?php $pending++; ?>
                    @endif
                   @endforeach
                  @if($tasks == null && $approved == 0 && $pending==0)
                  <div class="col-sm-6">
                    <div class="card bg-danger">
                      <div class="card-header">
                       <h4> FILE EXIT APPLICATION</h4>
                   
                        <p>Are your thoughts about leaving us, final?</p>
                        <div class="float-right">
                        <a href="{{route('user_exitapplication.create')}}" class="btn btn-sm btn-info">GO</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endif
                  @if($approved >0)
                  <div class="col-sm-6">
                      <div class="card bg-primary">
                      <div class="card-header">
                        <h4>TAKE EXIT INTERVIEW</h4>
                        <p>Before you leave us, please take this exit interview.</p>
                        <div class="float-right">
                        <a href="{{route('exit.take', [Crypt::encrypt($user_id)])}}" class="btn btn-sm btn-info">TAKE</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endif
         
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <h4 class="text-primary">My Exit Applications</h4>
                      <table class="table tablemanager" id="tableexit">
                        <thead>
                          <th>Date Filed</th>
                          <th>Status</th>
                          <th class="td-action text-right">Action</th>
                        </thead>
                        <tbody>
                          @foreach($exit_app as $exit)
                          <tr>
                            <td>
                               <?php echo date('F d, Y H:i', strtotime($exit->created_at))?>
                            </td>
                            <td>
                              @if(isset($exit->approved))
                                Approved
                              @elseif($exit->status==2)
                              Cancelled
                              @else
                                Pending
                              @endif
                            </td>
                            <td class="td-action text-right">
                              <a href="{{route('exit.view_my_application', [Crypt::encrypt($exit->id)])}}" class="btn btn-sm btn-success">View</a>
                              @if($exit->status != 2 && !isset($exit->approved))
                              <a data-toggle="modal" data-target=".cancel" class="btn btn-sm btn-danger" style="color: white;">Cancel</a>
                              @endif
                            </td>
                          </tr>
                          <div class="modal fade cancel" tabindex="-1" id="mymodal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <form action="{{route('exit.cancel', $exit->id)}}" method="">
                                      @csrf
                                      @method('post')
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Cancel Exit Application</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="form-group">
                                      <div class="modal-body">
                                      <p>Are you sure you want to cancel your exit application? 
                                       
                                      </p>
                                    </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                      <button type="submit" class="btn btn-danger" style="color:white;">Cancel</button>
                                      
                                    </div>
                                  </form>
                                  </div>
                                </div>
                </div>
                          @endforeach
                          @if($exit_app == null)
                           <tr><td> You have no exit applications</td></tr>
                          @endif
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
<script>
  setTimeout(function() {
    $('#successMessage').fadeOut('fast');
}, 5000); // <-- time in milliseconds
</script>
<script type="text/javascript">
    // basic usage
    $('.tablemanager').tablemanager({
      firstSort: [[1,'desc']],
      disable: ["last"],
      appendFilterby: false,
      dateFormat: [[4,"mm-dd-yyyy"]],
      debug: true,
      vocabulary: {
    voc_filter_by: 'Filter By',
    // voc_type_here_filter: 'Search...',
    // voc_show_rows: '  Rows'
  },
      pagination: true,
      // showrows: [5,10,15,20],
      disableFilterBy: [7]
    });

    
    // $('.table').tablemanager();
  </script>

@endsection

 