@extends('layouts.adminapp', ['activePage' => 'designation', 'titlePage' => __('Academic Year Setting')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
    
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-danger">
            <h4 class="card-title ">Edit Task</h4>
            <p class="card-category"> </p>
          </div>
          <div class="card-body">
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
            <form method="post" id="myform" action="{{  route('task.update', [$id= Crypt::encrypt($task->id)])}}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')        
               
                   <div class="row">
                  <div class="col-sm-12 ">
                    <label class="col-form-label">{{ __('Designation Title') }}</label>
                    <input class="form-control" type="text"  name="taskname" id="taskname" value="{{$task->name}}">
                  </div><br>
                  <div class="col-sm-12 ">
                    <label for="exampleFormControlTextarea1">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{$task->description}}</textarea>
                  </div>
                  <div class="col-sm-4 ">
                    <label class="col-form-label">{{ __('Due Date') }}</label>
                  <!--   <input class="form-control datetimepicker" type="date"  name="due" id="due"> -->
                    <input class="form-control datetimepicker" type="datetime-local"  name="due" id="due" required onchange='handler(event)'  required value="<?php echo date('Y-m-d\TH:i', strtotime($task->due)) ?>">
           
                  </div><br>
                 <!--   <div class="col-sm-6">
                    <label class="col-form-label">{{ __('Description') }}</label>
                    <input class="form-control" type="text" placeholder="email" name="email">
                  </div> -->
                 </div>
                 </div>
                  <div class="row">
                    <div class="card-footer ml-auto mr-auto">
                      <button type="button" class="btn btn-danger" onclick="checkdate()">{{ __('Save') }}</button>
                    </div>
                    <p id="demo"></p>
                  </div>
                </form>

          </div>
        </div>
      </div>
    
    </div>
  </div>
</div>
<script>
  setTimeout(function() {
    $('#successMessage').fadeOut('fast');
}, 5000); // <-- time in milliseconds
</script>
<!-- <script>
function myFunction() {
  var x = document.getElementById("start_ay").value;
  var st_index= document.getElementById("start_ay").options.selectedIndex;
//  alert(document.getElementById("start_ay").selectedIndex+1);
  document.getElementById("end_ay").value= parseInt(x) + 1;
}
</script> -->
<script>
function handler(e) {
        // alert(e.target.value);
  
  var inputDate = new Date(document.getElementById("due").value);
  var date = new Date();
  if(inputDate < date){
     alert("Please enter valid date and time");
  }

    }
    function checkdate()
{
  if(document.getElementById("taskname").value=='' || document.getElementById("description").value==''){
    alert("Please complete task details");   
  }
  else{
       var inputDate = new Date(document.getElementById("due").value);
          var date = new Date();
          if(inputDate < date){
             alert("Please enter valid date and time");
          }
       
          else{

           $("#myform").submit();


            }
  }
}


</script>
@endsection
