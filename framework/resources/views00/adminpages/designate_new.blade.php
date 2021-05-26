@extends('layouts.adminapp', ['activePage' => 'deisgnation', 'titlePage' => __('Designations')])

@section('content')
    
<div class="content">
  <div class="container-fluid">
    <form action="{{ route('designation.designate_store', [Crypt::encrypt($designations->id)]) }}" method="post">
                                       @csrf
                                    @method('post')
    <div class="row">
      <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-success">
              <h4 class="card-title ">Designate to Employee</h4>
              <p class="card-category"> </p>
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
               <h4>Designation: {{$designations->desig_title}}</h4>
                </div>
                <div class="col-sm-12">

                                    <label class="">Select Employee to Designate</label><br>
                                     

                                    <select class="selectpicker col-sm-12" data-live-search="true"  id="selemp" name="selectedemp">
                                      <option selected disabled="">Please Select</option>
                                      @foreach($userprofile as $user)
                                      @if($user->id==1)
                                      @else
                                    
                                      <option name="option" id="option" value="{{$user->id}}">

                                        <!-- <?php 
                                        
                                      echo substr($user->empID, 0,2).'-'.substr($user->empID, 2);

                                        ?> -->
                                        {{$user->user->lname.', '.$user->user->fname}}</option>


                                      @endif
                                      @endforeach
                                    </select><br>

                                    <label class="col-form-label">
                                      Date Designated
                                    </label>
                                  <input class="form-control col-sm-3" type="date" id="datePicker" name="date_desig">
                                    
                                  </div>


                <div class="modal fade designate" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header ">
                                  <h5 class="modal-title" >Designate</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  
                                  
                                </div>
                                <form  method="post" action="">
                                 @csrf
                                 @method('post')
                                <div class="modal-footer">
                                  <button type="submit" class="btn btn-primary">Delete</button>
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                              </form>
                              </div>
                            </div>
                      </div>
              </div>
              <div class="row">

                 
                    <div class=" ml-auto mr-auto">
                       <button type="button" class="btn btn-success" data-toggle="modal"  data-backdrop="static" data-keyboard="false" data-target="#myModal">{{ __('Save')  }}</button>
                    </div>
            
                    <div id="myModal" class="modal fade" role="dialog">
                              <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h4 class="modal-title">Warning!</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    
                                  </div>
                                  <div class="modal-body" align="left">
                                    <p id="empname"></p>
                                    <p>You are about to designate an employee as the <strong> {{$designations->desig_title}}.</strong> <br></p>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                                  
                                   

                                      <button type="submit" class="btn btn-success" >Designate</button>
                                    
                                  </div>
                                </div>

                              </div>
                    </div>
                    

                    

                  </div>
              
            </div>
          </div>
               
      </div>
    </div>

    <div class="row float-right">
                  <div class="col-sm-12 text-right">
              
                  </div>
            </div>
            </form>
  </div>
</div>

<script>
  setTimeout(function() {
    $('#successMessage').fadeOut('fast');
}, 5000); // <-- time in milliseconds


document.getElementById('datePicker').valueAsDate = new Date();
 
 function putIt(e) {
    $("#empname").val($('#selpick option:selected').text());
   document.getElementById('empname').value="dfdgdf";
}

$("#selemp").on("change", putIt);

$('#myModal').on('shown', function(){
alert('dfgdfg');
});
</script>


@endsection