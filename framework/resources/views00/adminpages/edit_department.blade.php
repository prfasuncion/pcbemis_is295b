@extends('layouts.adminapp', ['activePage' => 'dept', 'titlePage' => __('Edit Department')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
    
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Edit Department</h4>
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
            <form method="post" action="{{route('dept.update', [$id= Crypt::encrypt($department->id)])}}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')        
               
                   <div class="row">
                  <div class="col-sm-12 ">
                    <label class="col-form-label">{{ __('Department Code') }}</label>
                    <input class="form-control" type="text"  name="deptcode" id="desigtitle" value="{{$department->code}}">
                  </div><br>
                  <div class="col-sm-12 ">
                    <label for="exampleFormControlTextarea1">Department Name</label>
                    <input class="form-control" type="text"  name="deptname" id="desigtitle" value="{{$department->name}}">
                  </div>
                 <!--   <div class="col-sm-6">
                    <label class="col-form-label">{{ __('Description') }}</label>
                    <input class="form-control" type="text" placeholder="email" name="email">
                  </div> -->
                 </div>
                 </div>
                  <div class="row">
                    <div class="card-footer ml-auto mr-auto">
                      <button type="submit" class="btn btn-success">{{ __('Save') }}</button>
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
@endsection
