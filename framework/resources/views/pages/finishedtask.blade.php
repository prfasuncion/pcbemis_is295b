@extends('layouts.app', ['activePage' => 'usertask', 'titlePage' => __('My Tasks>Finished Task')])

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
            <div class="card-header card-header-primary">
      
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
                        <td>
                          {{$task->id}}
                        </td>
                        <td>
                         {{$task->name}}
                        </td>
                        <td>
                          {{$task->description}}
                        </td>
                   
                       <!--  <td>
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
    <?php $count=0;  ?>
@foreach ($the_tasks as $a)

                          <?php $count++;?>     
                 <!--  <?php echo $a->user_id; ?> -->
@endforeach


@if ($count>1)
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
                      <?php $name;?>
                      @foreach ($users as $user)
                        @if ($the_task->user_id == $user->id)
                         <?php $name= $user->user->lname.', '.$user->user->fname; 
                       
                          ?>
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
                      <td>
                        @if(isset($the_task->finished))
                        {{'Task Finished on '}}
                        <?php echo date('F d, Y H:i', strtotime($the_task->finished))?>
                        @endif
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
@endif
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
                    @foreach ($task_milestones as $x)
                    <?php $ad=0;?>
                      @foreach ($users as $user)
                        @if ($x->user_id != $user->id)
                        <?php $ad++; ?>
                        @endif
                      @endforeach
                    @endforeach

                    @if($count>1 || $ad>0)
                    <th>Posted by</th>
                    @endif
                    <th>Date</th>
                    <!-- <th>Status</th> -->
                    <th>Remarks</th>
                    @if($count>1)
                    
                    @endif
                  </thead>
                  <tbody>
                    @foreach ($task_milestones as $x)
                    <tr>
                      <td width="20%">
                         <?php $employee; ?>
                      @foreach ($users as $user)
                        @if ($x->user_id == $user->id)
                         <?php $employee= $user->user->lname.', '.$user->user->fname; ?>
                         @if(!isset($user->image))
                           <img class="card-img-top ml-auto mr-auto " src='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSQJxKGGpPc9-5g25KWwnsCCy9O_dlS4HWo5A&usqp=CAU'  id="img" style="height: 50px; width: 50px; max-height: 50px; border-radius: 50%; "> 
                            @else
                            <img class="card-img-top ml-auto mr-auto " src="<?php echo asset( $user->image); ?>"  id="img" style="height: 50px; width: 50px; max-height: 50px; border-radius: 50%; ">
                        @endif
                        
                        @else  
                            <?php $ad++;?>
                        @endif
                      @endforeach
                      @if($count>1 || $ad>0)
                      
                      {{$employee}}
                      </td>
                      @endif
                      <td width="20%">

                        <?php echo date('F d, Y H:i', strtotime($x->created_at))?>

                      </td>
                      <!-- <td>
                        @if(isset($assigned_accepted->finished ))
                        {{'Finished'}}
                        @else
                        {{'In Progress'}}
                        @endif
                      </td> -->
                      <td width="60%"><?php echo($x->remarks) ?></td>
                      @if($count>1)
                      
                      @endif
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
    </div> <!-- closing milestone -->
    <!-- <div class="row">
    <div class="col-sm-12">
        <form method="post" action="{{route('utask.milestone',  [$id= Crypt::encrypt($task->id)])}}">
           @csrf
          @method('post')
    <textarea class="description" name="description"></textarea>
    </div>
    <div pu class="col-sm-12 t">
      <button type="submit" name="addmilestone" value="milestone" class="btn btn-success pull-right">Add to milestones</button>
       <button type="submit" name="finish" value="finish"  class="btn btn-warning pull-right">Submit and Mark task For validation</button>
       </form>
    </div>
  </div> -->

<script src="https://cdn.tiny.cloud/1/mcfgmuwd6krbwezb0gi8mi68jw5flsyd9dwa5hmk6ckodl0j/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script>
    tinymce.init({
        selector:'textarea.description',
        // width: 900,
        height: 300
    });
</script>

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