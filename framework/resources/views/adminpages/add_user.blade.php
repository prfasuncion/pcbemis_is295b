@extends('layouts.adminapp', ['activePage' => 'table', 'titlePage' => __('User Management> Add User')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Add New User</h4>
            <p class="card-category"> </p>
          </div>
          <div class="card-body">
            @if (session()->has('failed'))
                   <div class="row" id="successMessage">
                    <div class="col-sm-12">
                      <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>{{ session()->get('failed') }}</span>
                      </div>
                    </div>
                  </div>   
               @endif
            <form method="post" action="{{  route('users.store')}}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')        
                 <div class="row ">
                  <div class="col-sm-12">
                     <h5> If There are no positions available, please create positions first. <a href="{{route('positions.index')}}"> Click this link to redirect to positions panel.</a></h5>
                  </div>
                  <div class="col-sm-4 ">
                    <label class="col-form-label">{{ __('Employee ID') }}</label>
                    <input class="form-control" type="text" id="empID" name="empID" onkeyup="myFunction()" maxlength="5" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');" required>
                  </div>
                  <div class="col-sm-4">
                    <label class="col-form-label">{{ __('Date Hired') }}</label>
                    <input class="form-control" type="date" placeholder="date hired" name="datehired" required>
                  </div>
                   <div class="col-sm-4">
                    <label class="col-form-label">{{ __('Email') }}</label>
                    <input class="form-control" type="email" placeholder="email" name="email" required>
                  </div>
                 </div>

                 <div class="row ">
                  <div class="col-sm-3 ">
                    <label class="col-form-label">{{ __('Last Name') }}</label>
                    <input class="form-control" type="text" placeholder="Last name" name="lname" required>
                  </div>
                   <div class="col-sm-3">
                    <label class="col-form-label">{{ __('First Name') }}</label>
                    <input class="form-control" type="text" placeholder="First name" name="fname" required>
                  </div>
                  <div class="col-sm-3">
                    <label class="col-form-label">{{ __('Middle Name') }}</label>
                    <input class="form-control" type="text" placeholder="Middle name" name="mname">
                  </div>
                  <div class="col-sm-3">
                    <label class="col-form-label">{{ __('Name Ext.') }}</label>
                    <input class="form-control" type="text" placeholder="Name Ext" name="next">
                  </div>
                   
                 </div>

                  <div class="row ">
                  <div class="col-sm-12 ">
                    <label class="col-form-label">{{ __('Position') }}</label>
                    <select class="selectpicker col-sm-6" data-live-search="true" name="pos">
                      @foreach($positions as $position)

                      <option value="{{$position->id}}">{{$position->position}}
                         @foreach ($position_type as $type)
                            @if ($position->type == $type->id)
                            {{ ' ('.$type->type.')'}}
                            @endif
                          @endforeach
                      </option>
                      @endforeach
                    </select>
                  <!--   <input class="form-control" type="text"  name=""> -->
                  </div>
                  
                   
                 </div>
                  <div class="row">
                    <div class="card-footer ml-auto mr-auto">
                      <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                    </div>
                  </div>
                </form>

          </div>
        </div>
      </div>
    
    </div>
  </div>
</div>
<script type="text/javascript">
  
  function myFunction() {
  var x = document.getElementById("empID").value;
  document.getElementById("empID").value= x.replace(/(\d{2})(\d{3})/, "$1-$2");


}
</script>
<script>
  setTimeout(function() {
    $('#successMessage').fadeOut('fast');
}, 5000); // <-- time in milliseconds
</script>
@endsection