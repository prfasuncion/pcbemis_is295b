@extends('layouts.adminapp', ['activePage' => 'acadyear', 'titlePage' => __('Academic Year Setting')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Add Academic Year</h4>
            <p class="card-category"> </p>
          </div>
          <div class="card-body">
            <form method="post" action="{{  route('acadyear.store')}}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')        
               <div class="row">
                <label class="col-sm-2 col-form-label text">{{ __('Start') }}</label>
                  <div class="col-sm-3">
                
                  <select class="form-control" data-style="btn btn-link" id="start_ay" name="start_ay" aria-describedby="roleHelp" required autofocus onchange="myFunction()">
                         {{ $last= 2009 }}
            						 {{ $now = date('Y') }}
            						 {{ $max = 2099 }}
               
						    @for ($i = $last; $i <= $max-1; $i++)
               
						    <option selected="true" style='display: none'></option>
						        <option value="{{ $i }}"
                      @foreach ($acadyear as $acadyr)
		                    @if ($i==$acadyr->start_ay) {{ "disabled" }} @endif
                           @endforeach
						        >{{ $i}}</option>
                 
						    @endfor

                
                    </select>
                  </div>
                   <label class="col-sm-2 col-form-label text">{{ __('End') }}</label>
                  <div class="col-sm-3">
                
                      <select class="form-control" disabled data-style="btn btn-link" id="end_ay" name="end_ay" aria-describedby="roleHelp" required autofocus read-only>
                         {{ $last= 2009 }}
						             {{ $now = date('Y') }}
						              {{ $max = 2099 }}
						    @for ($i = $last; $i <= $max; $i++)
						  	 <option selected="true" style='display: none'></option>
						        <option value="{{ $i }}"
						      
						        >{{ $i }}</option>
						    @endfor
                    </select>
                    <input type="text" hidden  name="end_ay_text" id="end_ay_text" value="">
                  </div>
                  </div>
                   
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
<script>
function myFunction() {
  var x = document.getElementById("start_ay").value;
  var st_index= document.getElementById("start_ay").options.selectedIndex;
//  alert(document.getElementById("start_ay").selectedIndex+1);
  document.getElementById("end_ay").value= parseInt(x) + 1;
  document.getElementById("end_ay_text").value= parseInt(x) + 1;
}
</script>
@endsection
