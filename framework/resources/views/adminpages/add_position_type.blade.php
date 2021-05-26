@extends('layouts.adminapp', ['activePage' => 'pos', 'titlePage' => __('Positions')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Create Position Type</h4>
            <p class="card-category"> </p>
          </div>
          <div class="card-body">
            <form method="post" action="{{  route('department.store')}}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')        
               <div class="row">
                <div class="col-sm-12 ">
                    <label class="col-form-label">{{ __('Position Type') }}</label>
                    <input class="form-control" type="text"  name="postype" id="postype" required>
                  </div><br>
                 <!--  <div class="col-sm-12 ">
                    <label class="col-form-label">{{ __('Position Type') }}</label>
                    <input class="form-control" type="text"  name="deptname" id="deptname" required>
                  </div> --><br>
                 </div>
                  <div class="row">
                    <div class="card-footer ml-auto mr-auto">
                      <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
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

@endsection
