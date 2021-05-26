
@extends('layouts.adminapp', ['activePage' => 'tasks', 'titlePage' => __('Tasks/Assignments')])
@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
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
                  <!--     <th>
                        Task No. 
                      </th> -->
                      <th>
                       Task Name
                    </th>
                    <th>
                       Description
                    </th>
                   <!--  <th>
                      Status
                    </th> -->
                    <!-- <th>
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
                        <!-- <td>
                          {{$task->id}}
                        </td> -->
                        <td>
                         {{$task->name}}
                        </td>
                        <td>
                          {{$task->description}}
                        </td>
                   
                      <!--   <td>
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
                                  <p>Are you sure you want to delete this?</p>
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
            <div class="card-header card-header-info">
      
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                  <span class="nav-tabs-title">Assigned to:</span>
               
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table">
                  <thead class=" text-primary">
                    <th>Employee Name</th>
                    <th>Date Assigned</th>
                    <th>Date Acknowledged</th>
                    <th>Status</th>
                  </thead>
                  <tbody>
                    @foreach ($the_tasks as $the_task)
                    <tr>
                      <?php $name ?>
                      @foreach ($users as $user)
                        @if ($the_task->user_id == $user->id)
                         <?php $name= $user->user->lname.', '.$user->user->fname ?>
                        @endif
                      @endforeach
                      <td>
                        @foreach ($users as $x)
                        @if ($the_task->user_id == $x->id)
                        @if(!isset($x->image))
                           <img class="card-img-top ml-auto mr-auto " src='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSQJxKGGpPc9-5g25KWwnsCCy9O_dlS4HWo5A&usqp=CAU'  id="img" style="height: 50px; width: 50px; max-height: 50px; border-radius: 50%; "> 
                            @else
                            <img class="card-img-top ml-auto mr-auto " src="<?php echo asset( $x->image); ?>"  id="img" style="height: 50px; width: 50px; max-height: 50px; border-radius: 50%; ">
                        @endif
                        @endif
                        @endforeach

                      {{$name}}
                      </td>
                      <td>
                           <?php echo date('F d, Y H:i', strtotime($the_task->created_at))?>
                      </td>
                      <td>
                          <?php echo date('F d, Y H:i', strtotime($the_task->accepted))?>
                      </td>
                      <td ><span style="display: inline-flex; vertical-align: top">
                        @if(isset($the_task->finished))
                        <i class="material-icons" style="color: green" >check_circle</i>
                        {{'Finished on '}}
                        <?php echo date('F d, Y H:i', strtotime($the_task->finished))?>
                        @elseif(isset($the_task->accepted) && !isset($the_task->finished))
                        {{'In Progress'}}
                        @else
                        {{'for acknowledgement'}}
                        @endif
                        </span>
                     
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
            </div>
          </div>

          <div class="card-footer ml-auto mr-auto">
                        <!-- <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                        </form> -->
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
                  <span class="nav-tabs-title">Milestones</span>
               
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table">
                  <thead class=" text-primary">
                    <th>Employee</th>
                    <th>Date</th>
                 <!--    <th>Status</th> -->
                    <th>Details</th>
                    
                  </thead>
                  <tbody>
                     @foreach ($task_milestones as $x)
                    <tr>
                      <td width="20%">
                        <?php $employee;?>
                      @foreach ($users as $user)
                        @if ($x->user_id == $user->id)
                         <?php $employee= $user->user->lname.', '.$user->user->fname; 
                                
                          ?>

                           @if(!isset($user->image))
                           <img class="card-img-top ml-auto mr-auto " src='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSQJxKGGpPc9-5g25KWwnsCCy9O_dlS4HWo5A&usqp=CAU'  id="img" style="height: 50px; width: 50px; max-height: 50px; border-radius: 50%; "> 
                            @else
                            <img class="card-img-top ml-auto mr-auto " src="<?php echo asset( $user->image); ?>"  id="img" style="height: 50px; width: 50px; max-height: 50px; border-radius: 50%; ">
                        @endif
                  
                        @endif
                      @endforeach
                     
                      {{$employee}}
                      </td>
                      <td width="20%">
                          <?php echo date('F d, Y H:i', strtotime($x->created_at))?>
                      </td>
                      <td width="60%"><?php echo $x->remarks; ?></td>
                      
                    </tr>
                    @endforeach
                  </tbody>
                </table>
            </div>
          </div>

          <div class="card-footer ml-auto mr-auto">
                        <!-- <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                        </form> -->
          </div>
          </div>
                             


      </div>
    </div>
<!-- tinymce -->
    <div class="row">
    <div class="col-sm-12">
        <form method="post" action="{{route('task.milestone',  [$id= Crypt::encrypt($task->id)])}}">
           @csrf
          @method('post')
    <textarea class="description" id="description" name="description"></textarea>
    </div>
    <div pu class="col-sm-12 t">
      <button type="submit" name="addmilestone" value="milestone" id="addmilestone"class="btn btn-success pull-right">Add to milestones</button>
      <?php $count_assigned=0; $fin=0; ?>
      @foreach ($the_tasks as $assigned_task)
          <?php $count_assigned++; ?>
          @if (isset($assigned_task->finished))
          <?php $fin++; ?>
          @endif
      @endforeach
      @if($count_assigned !== $fin)
       <button type="submit" name="finish" value="finish" id="finish" class="btn btn-warning pull-right">Submit and Mark task as Finished
       </button>
       @endif
       </form>
    </div>
  </div>
 <!--  tinymce -->



  </div>

 

<script src="https://cdn.tiny.cloud/1/mcfgmuwd6krbwezb0gi8mi68jw5flsyd9dwa5hmk6ckodl0j/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>



    <div class="row float-right">
                  <div class="col-sm-12 text-right">
                 
                  </div>
            </div>
  </div>
</div>

<script>

    tinymce.init({
        selector:'textarea.description',
        // width: 900,
        plugins: 'link',
        height: 300, 
        setup : function(ed) {
          if($(ed.getBody()).text().length===0){
                $('#finish').hide();
                $('#addmilestone').hide();
          }

        ed.on("change", function(e){
          if($(ed.getBody()).text().length===0){
                $('#finish').hide();
                $('#addmilestone').hide();
          }
          else{
                $('#finish').show();
                $('#addmilestone').show();
          }



            
        });
        ed.on("keyup", function(){
            if($(ed.getBody()).text().length===0){
                $('#finish').hide();
                $('#addmilestone').hide();
          }
          else{
                $('#finish').show();
                $('#addmilestone').show();
          }
        });
   }
    });

 
</script>

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