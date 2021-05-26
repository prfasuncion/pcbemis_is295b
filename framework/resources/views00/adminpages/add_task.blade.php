@extends('layouts.adminapp', ['activePage' => 'tasks', 'titlePage' => __('Tasks')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-danger">
            <h4 class="card-title ">Create Task</h4>
            <p class="card-category"> </p>
          </div>
          <div class="card-body">
            <form method="post" action="{{  route('tasks.store')}}" autocomplete="off" id="myform" class="form-horizontal">
            @csrf
            @method('post')        
               
                   <div class="row">
                  <div class="col-sm-12 ">
                    <label class="col-form-label">{{ __('Task Name') }}</label>
                    <input class="form-control" type="text"  name="taskname" id="taskname" required>
                  </div><br>
                  <div class="col-sm-12 ">
                    <label for="exampleFormControlTextarea1">Task Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                  </div>
                  <div class="col-sm-4 ">
                    <label class="col-form-label">{{ __('Due Date') }}</label>
                    <input class="form-control datetimepicker" type="datetime-local"  name="due" id="due" required onchange='handler(event)'>
           

                  </div><br>

                
                 </div>
                 </div>
                  <div class="row">
                    <div class="card-footer ml-auto mr-auto">
                      <button type="button" class="btn btn-danger" onclick="checkdate()">{{ __('Save') }}</button>
                    </div>
                
                  </div>
                </form>

          </div>
        </div>
      </div>
    
    </div>
  </div>
</div>
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
  if(document.getElementById("taskname").value=='' || document.getElementById("description").value=='' || document.getElementById("due").value=='' ){
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

