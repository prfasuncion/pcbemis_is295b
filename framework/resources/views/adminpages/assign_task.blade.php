
@extends('layouts.adminapp', ['activePage' => 'tasks', 'titlePage' => __('Tasks/Assignments')])
@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
<style type="text/css">

</style>
@endsection
@section('content')
 @csrf
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-danger">
      
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                  <span class="nav-tabs-title">Tasks:</span>
               
                </div>
              </div>
            </div>
            <div class="card-body">
               @if (!empty($successmsg))
                   <div class="row" id="successMessage">
                    <div class="col-sm-12">
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>{{ $successmsg }}</span>
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
                <table class="table">
                  <thead class=" text-primary">

                 
                    <tr>
                      <th>
                        Task No. 
                      </th>
                      <th>
                       Task Name
                    </th>
                    <th>
                       Description
                    </th>
                   <!--  <th>
                      Status
                    </th> -->
                 <!--    <th>
                      Semester
                    </th> -->
                    <th>
                      Creation date
                    </th>
                    <th>
                      Due
                    </th>
                    
                  </tr></thead>
                  <tbody>
                
                        <tr>
                        <td>
                          {{$task->id}}
                        </td>
                        <td>
                         {{$task->name}}
                        </td>
                        <td>
                          {{$task->description}}
                        </td>
                   
                     <!--    <td>
                          {{$task->semester}}
                        </td> -->
                        <td>
                      
                            <?php echo date('F d, Y H:i', strtotime($task->created_at))?>
                        </td>
                      <td>
                       
                         <?php echo date('F d, Y H:i', strtotime($task->due))?>
                      </td>
                      </tr>
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
            
                  </tbody>
                </table>
              </div>
            </div>
          </div>
               
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-success">
      
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                  <span class="nav-tabs-title">Assign</span>
               
                </div>
              </div>
            </div>
            <div class="card-body">
               @if (!empty($successmsg))
                   <div class="row" id="successMessage">
                    <div class="col-sm-12">
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>{{ $successmsg }}</span>
                      </div>
                    </div>
                  </div>   
               @endif

                 <div class="row">
                            <div class="col-sm-12">
                              <p>Here you can assign employee(s) for a task</p>
                              <label>You may select one or more employees to be assigned for this task</label><br>
                              <div class="col-sm-12">
                                <label>Selected Employee(s)</label>
                                <textarea id="sel_emp" class="form-control" rows="4" readonly="">
                                  
                                </textarea>
                              </div>
                                <label><strong>Select Employee:</strong></label><br/>
                                <form method="POST" action="{{route('task.assign_task_user', [Crypt::encrypt($task->id)]) }}">
                                @csrf
                                 @method('post')
                                <select size="5"  id="selpick" class="selectpicker form-control" multiple="multiple"  data-live-search="true" name="employees[]" style="height: 50px !important;">
                                  @foreach ($users as $user)
                                  <option value="{{$user->id}}" >{{$user->user->lname.', '.$user->user->fname .'           '}}</option>
                                  
                                  @endforeach
                                </select>
                               
                            </div>
                             <br>
                             <br>
                          
                              <div class="row">
                     


          </div>
           <div class="card-footer ml-auto mr-auto">
                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                        </form>
                      </div>
                    </div>
                             


            </div>
            <div>
   
       
          
          </div>
               
      </div>
    </div>
    <div class="row float-right">
                  <div class="col-sm-12 text-right">
                 
                  </div>
            </div>
  </div>
</div>
<script>
  setTimeout(function() {
    $('#successMessage').fadeOut('fast');
}, 5000); // <-- time in milliseconds

  function putIt(e) {
    $("#sel_emp").val($('#selpick option:selected').text());
}

$("#selpick").on("change", putIt);
</script>

@endsection