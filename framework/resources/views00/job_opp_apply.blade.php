@extends('layouts.job_app', ['class' => 'off-canvas-sidebar', 'activePage' => 'job_opportunity', 'title' => __('PCB EMIS')])

@section('content')
<div class="container" style="height: auto; width: 100%;">
  @if (session()->has('success'))
                   <div class="row" id="successMessage">
                    <div class="col-sm-12">
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>{{ session()->get('success') }}</span>
                      </div>
                    </div>
                  </div>   
               @endif 
               @if (session()->has('failed'))
                   <div class="row" id="failedMessage">
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
 	<div class="row align-items-center">
      <div class="col-sm-12">
        <div class="col-sm-12">
        	
        <div class="card col-sm-12"  >
          <div class="card-header card-header-primary">
            <h4 class="card-title mt-0"> Be a part of our growing community!</h4>
            <p class="card-category"> </p>
          </div>
          <div class="card-body" >
            <div class="row">

               <div class="col-sm-12">
              <h3><strong>{{$job_opp->job_title}}</strong></h3>
              </div>
              <div class="col-sm-12"> <h5>  {{'('}}&#8369;{{$job_opp->job_salary.')'}}</h5></div><br>
              <div class="col-sm-12">
              <h4 class="text-primary">Job Description and Details</h4>
              </div>
              <div class="col-sm-12">
              <?php echo $job_opp->job_description; ?>
              </div>
            </div>

            <div>
              <h3>Apply Now!</h3>
               <form action="{{ route('jobs.apply', [Crypt::encrypt($job_opp->id)]) }}" method="POST" name="myform" id="apply_form" enctype="multipart/form-data">
                                     @csrf
                                      @method('post') 
                <div class="row">
                  <div class="col-sm-12">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSQJxKGGpPc9-5g25KWwnsCCy9O_dlS4HWo5A&usqp=CAU" id="img" style=""><br>
                    <label>Upload Your Image</label>
                  </div>
                  <div class="col-sm-12">
                  
                    <input type="file" name="image" id="image" accept="image/*">
                  </div>
                  
                </div>
                <div class="row">
                <div class="col-sm-4">
                <div class="form-group">
                  <label for="email" class="col-form-label">Email</label><br>
                  <input type="email" class="form-control" value="" id="email" name="email" required >
                </div>
                </div>

                <div class="col-sm-4">
                <div class="form-group">
                  <label for="num" class="col-form-label">Mobile Number</label><br>
                  <input type="text" class="form-control" value="" id="num"name="num" required >
                </div>
                </div>

                <div class="col-sm-4">
                <div class="form-group">
                  <label for="num" class="col-form-label">Birthday</label><br>
                  <input type="date" class="form-control" value="" id="bday" name="bday" required >
                </div>
                </div>

                </div>

                <div class="row">
                  <div class="col-sm-3">
                  <div class="form-group">
                    <label for="lname" class="col-form-label">Last Name</label><br>
                    <input type="text" id="lname" class="form-control" value="" name="lname" required >
                  </div>
                  </div>
                  
                  <div class="col-sm-3">
                  <div class="form-group">
                    <label for="fname" class="col-form-label">First Name</label><br>
                    <input type="text" id="fname" class="form-control" value="" name="fname" required>
                  </div>
                  </div>

                  <div class="col-sm-3">
                  <div class="form-group">
                    <label for="mname" class="col-form-label">Middle Name</label><br>
                    <input type="text" id="mname" class="form-control" value="" name="mname" >
                  </div>
                  </div>

                  <div class="col-sm-3">
                  <div class="form-group">
                    <label for="name_ext" class="col-form-label">Name Extension</label><br>
                    <input type="text" id="name_ext" class="form-control" value="" name="name_ext" >
                  </div>
                  </div>
                </div>
                
                <div class="row">
                  

                  <div class="col-sm-4">
                  <div class="form-group">
                    <label for="province" class="col-form-label">Province</label><br>
                    
                      <select data-live-search="true" name="province" id="province" class="form-control" style="max-height: 200px;" >
                     
                      </select>
                    <input type="text" hidden id="ap_province" name="ap_province">
                  </div>
                  </div>
                  

                  <div class="col-sm-4">
                  <div class="form-group">
                    <label for="municipality" class="col-form-label">City/Municipality</label><br>
                     <select name="city" id="city" class="form-control"  >
                      
                     </select>
                    <input type="text" hidden id="ap_city" name="ap_city">
                  </div>
                  </div>

                  <div class="col-sm-4">
                  <div class="form-group">
                    <label for="barangay" class="col-form-label">Barangay</label><br>
                    <select name="barangay" id="barangay" class="form-control"></select>
                    <input type="text" hidden id="ap_brgy" name="ap_brgy">
                  </div>
                  </div>

                  <div class="col-sm-12">
                  <div class="form-group">
                    <label for="street" class="col-form-label">Street/House No.</label><br>
                    <input type="text" class="form-control" id="street" value="" name="street" required>
                  </div>
                  </div>
                
                  
                </div>

                <h3>Application Intent</h3>
                <div class="row">
                  <div class="col-sm-12 ">
                    <label for="description">
                      Why do you want to work at PCB? Say something about yourself,highlight your experience, expertise and other relevant information.
                    </label>
                     <textarea class="description" id="description" name="description" rows="3"></textarea>
                  </div>
                  
                </div>
                <br>
                <h3>Attach a resume (accepts pdf file only) </h3>
                <div class="row">
                  <div class="col-sm-12">

                  <input type="file" name="resume" id="resume"class="form-control" accept="application/pdf">
                  </div> 
                </div>
             
            </div>
          </div>

          <div class="card-footer ml-auto ">
              <div class="row">
                <div class="col-sm-12">
                  <a class="btn btn-primary" style="color: white;"  id="btn_apply" onclick="validateForm()" >Submit Application</a>
                    <a class="btn btn-primary" style="color: white;" data-toggle="modal" id="btnapply" data-target="#apply" hidden>Submit Application</a>
                
                    
                    <div class="modal fade apply" tabindex="-1" data-backdrop="false" role="dialog" id="apply" style="">
                            <div class="modal-dialog " style="width: 90%; max-width:1200px;" role="document">
                              <div class="modal-content">
                                <div class="modal-header ">
                                  <h5 class="modal-title" >Submit my Application</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body" style="
    overflow-y: auto;">
                                 
                                  <h5 class="text-primary"><em>Please review your details before submitting your application. <br> By Clicking submit it cannot be undone, a copy of your application will be forwarded on your email. </em></h5>

                                  <div align="center" class="ml-auto mr-auto align-items-center">
                                  <h4 >Application for {{$job_opp->job_title}}</h4>
                                  </div>
                                  <div class="row">
                                    <div class="col-sm-23 ml-auto mr-auto" align="enter">
                                      <img src="" id="apply_img" width="200px" height="200px" style="border-radius: 50%;">

                                    </div>

                                 


                                   
                                  </div>
                                  <br>
                                <div class="row">
                                    <div class="col-sm-4">
                                    <label for="apply_email" class="col-form-label">Email</label>
                                    <input type="text" class="form-control" readonly="" id="apply_email" name="">
                                    </div>
                                    <div class="col-sm-4">
                                    <label for="apply_num" class="col-form-label">Contact Number</label>
                                    <input type="text" class="form-control" readonly="" id="apply_num" name="">
                                    </div>
                                    <div class="col-sm-4">
                                    <div class="form-group">
                                      <label for="num" class="col-form-label">Birthday</label><br>
                                      <input type="date" class="form-control" value="" id="apply_bday" name="bday" readonly >
                                    </div>
                                    </div>

                                </div>
                                <div class="row">
                                  <div class="col-sm-3">
                                    <label for="barangay" class="col-form-label">Last Name</label>
                                    <input type="text" class="form-control" readonly="" id="apply_lname" name="">
                                     
                                  </div>
                                  <div class="col-sm-3">
                                    <label for="barangay" class="col-form-label">First Name</label>
                                    <input type="text" class="form-control" readonly="" id="apply_fname" name="">
                                  </div>
                                  <div class="col-sm-3">
                                    <label for="" class="col-form-label">Middle Name</label>
                                    <input type="text" class="form-control" readonly="" id="apply_mname" name="mname">
                                  </div>
                                  <div class="col-sm-3">
                                    <label for="" class="col-form-label">Name Extension</label>
                                    <input type="text" class="form-control" readonly="" id="apply_name_ext" name="">
                                  </div>
                                </div>

                                <div class="row">
                                  
                                  <div class="col-sm-3">
                                    <label for="barangay" class="col-form-label">Barangay</label>
                                    <input type="text" class="form-control" readonly="" id="apply_brgy" name="apply_brgy">
                                  </div>
                                  <div class="col-sm-3">
                                    <label for="" class="col-form-label">Municipality</label>
                                    <input type="text" class="form-control" readonly="" id="apply_city" name="apply_city">
                                  </div>
                                  <div class="col-sm-3">
                                    <label for="" class="col-form-label">Province</label>
                                    <input type="text" class="form-control" readonly="" id="apply_province" name="">
                                  </div>
                                  <div class="col-sm-3">
                                    <label for="barangay" class="col-form-label">Street/House No.</label>
                                    <input type="text" class="form-control" readonly="" id="apply_street" name="apply_street">
                                  </div>

                                </div>

                                <div class="row">
                                  <div class="col-sm-12"> 
                                  <h3>Application Intent</h3>

                                  <textarea id="intent" class="form-control col-sm-12" readonly name="intent" style="height: 400px;" rows="15" hidden>

                                  </textarea>

                                  <div id="intent_val">
                                    
                                  </div>
                                  </div>
                                </div>
                                  
                                </div>
                               
                               
                                <div class="modal-footer">
                                  <button type="submit" class="btn btn-success">Submit</button>
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                                </form>
                              </div>
                            </div>
                      </div>
                </div>
                    
              </div>
          </div>

    
         
          
        </div>
      </div>
      </div>
    	
    	
    </div>
  
 
</div>

<script src="https://cdn.tiny.cloud/1/mcfgmuwd6krbwezb0gi8mi68jw5flsyd9dwa5hmk6ckodl0j/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script type="text/javascript">
            var my_handlers = {




                fill_cities: function(){

                    $('#city').removeAttr('selected').find('option:first').attr('selected', 'selected');


                    var province_code = $('#province').val();
                    $('#city').ph_locations( 'fetch_list', [{"province_code": province_code}]);

                        var city_code = "x";
                    $('#barangay').ph_locations('fetch_list', [{"city_code": city_code}]);


                  
                    
                },


                fill_barangays: function(){
                    

                 
                    var city_code = $('#city').val();
                    $('#barangay').ph_locations('fetch_list', [{"city_code": city_code}]);

                    
 
                  
                    


                }
            };

            $(function(){
                // $('#region').on('change', my_handlers.fill_provinces);
                $('#province').on('change', my_handlers.fill_cities);
                $('#city').on('change', my_handlers.fill_barangays);

                $('#region').ph_locations({'location_type': 'regions'});
                $('#province').ph_locations({'location_type': 'provinces'});
                $('#city').ph_locations({'location_type': 'cities'});
                $('#barangay').ph_locations({'location_type': 'barangays'});

                $('#province').ph_locations('fetch_list');
                

            });
  </script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>

    tinymce.init({
        selector:'textarea.description',
        // width: 900,
        plugins: 'link',
        height: 300



         });

   

$("#image").change(function(e) {

    for (var i = 0; i < e.originalEvent.srcElement.files.length; i++) {
        
        var file = e.originalEvent.srcElement.files[i];
        
        var img = document.getElementById("img");
        var reader = new FileReader();
        reader.onloadend = function() {
             img.src = reader.result;
        }
        reader.readAsDataURL(file);
        $("#img").after(img);
        $("#img").height('200px');
        $("#img").width('200px');
        $("#img").css('border','solid 2px');

    }
});
 

  $("#apply").on('shown.bs.modal', function () {
        document.getElementById('apply_img').src=$('#img').attr('src');
        document.getElementById('apply_email').value= $('#email').val();
        document.getElementById('apply_bday').value= $('#bday').val();
        document.getElementById('apply_num').value= $('#num').val();
        document.getElementById('apply_lname').value= $('#lname').val();
        document.getElementById('apply_fname').value= $('#fname').val();
        document.getElementById('apply_mname').value= $('#mname').val();
        document.getElementById('apply_name_ext').value= $('#name_ext').val();

        document.getElementById('apply_province').value=$( "#province option:selected" ).text();
       

        document.getElementById('apply_city').value=$( "#city option:selected" ).text();
        

        document.getElementById('apply_brgy').value=$( "#barangay option:selected" ).text();
       

        document.getElementById('apply_street').value= $('#street').val();
        document.getElementById('ap_city').value=$( "#city option:selected" ).text();
       document.getElementById('ap_brgy').value=$( "#barangay option:selected" ).text();
       document.getElementById('ap_province').value=$( "#province option:selected" ).text();
        document.getElementById('intent').value= tinymce.get("description").getContent({ format: "html" });

          $("#intent_val").html((tinymce.get("description").getContent({ format: "html" })));
    


  });


  
    
</script>  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script >
  function validateForm() {
     
      var isValid = true;
      // $('#apply_form').each(function() {
        if ( $("#email").val() === '' || $("#num").val() === '' ||
          $("#lname").val() === '' || $("#fname").val() === '' ||
          $("#province").val() === null || $("#city").val() === null || 
          $("barangay").val() === null || $("#street").val() === '' || tinymce.get("description").getContent({ format: "html" })==='' ||  $("#image").val()==='' || $("#resume").val()===''
          ){
            isValid = false;
           alert('Please Fill up the fields!');
         
        }
      // });
else{
      document.getElementById("btnapply").click();

}
      
}
</script> 
  
@endsection
