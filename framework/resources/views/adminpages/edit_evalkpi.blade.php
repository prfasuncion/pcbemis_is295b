@extends('layouts.adminapp', ['activePage' => 'evaluations', 'titlePage' => __('Edit Evaluation KPI')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
    
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Edit Evaluation KPI</h4>
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

                <form id="editform" method="post" action="{{route('evalkpi.edit_save', [$id= Crypt::encrypt($details->id)])}}">
                                   @csrf
                                   @method('post')

               <label for="recipient-name" class="col-form-label">Category</label><br>
               <select class="form-control selectpicker" name="categ" onchange="transfer()" required id="editSelectBox-{{$details->id}}">
                                      
                                      @foreach ($categ as $category)
                                        
                                           <option <?php if($details->eval_categ_id==$category->id) { echo 'selected'; } ?> value="{{$category->id}}">{{$category->name}}</option>
                                   
                                      @endforeach
                                    </select>
                                    <br><br>
                                    <label for="recipient-name" class="col-form-label">Key Performance Indicator</label><br>
                                    <textarea class="form-control" name="kpi" id="editkpitext-{{$details->id}}"required  text-align="left" rows="4">{{$details->kpi}}</textarea> 

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
