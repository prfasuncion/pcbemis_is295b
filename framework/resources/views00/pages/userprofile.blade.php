@extends('layouts.app', ['activePage' => 'userprofile', 'titlePage' => __('Profile')])

@section('content')
 @csrf
<div class="content" id="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 col-md-12">
          <div class="card" id="profcard">
            <div class="card-header card-header-tabs card-header-primary">
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                  <ul class="nav nav-tabs" data-tabs="tabs">
                    <li class="nav-item">
                      <a class="nav-link active " href="{{ route('userprofile.index') }}">
                        <i class="material-icons">account_box</i> PERSONAL INFORMATION 
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link " href="{{url('userprofile/eligibility')}}">
                        <i class="material-icons">verified</i> ELIGIBILITY
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{url('userprofile/educ')}}" >
                        <i class="material-icons">school</i> Educational Background
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{url('userprofile/work_experience')}}">
                        <i class="material-icons">work</i> WORK EXPERIENCE
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{url('userprofile/ldi')}}">
                        <i class="material-icons">badge</i> L&D INTERVENTIONS/TRAININGS
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
           
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane active" id="profile">
                  <div class="row">
                  <div class="col-sm-6">
                    <h5><strong>Personal Information</strong></h5>
                    <span><em>(Please click edit to update information)</em></span>
                  </div>
                  <div class="col-sm-6">
                    <a type="button" id="" target="_blank" href="{{route('employee.print_profile', [Crypt::encrypt($userprofile->id)])}}" class="btn btn-info pull-right">{{ __('Print Profile') }}</a>
                    <button type="button" id="editbtn" class="btn btn-warning editbtn pull-right">{{ __('Edit') }}</button>
                  </div>
                  </div>
                  <form id="formprofile" method="post" action="{{route('user_profile.update')}}">
                     @csrf
                     @method('post')
                  <div class="row">
                    <div class="col-sm-3 ">
                    <label class="col-form-label">{{ __('Surname') }}</label>
                    <input class="form-control" type="text"  name="surname" id="surname" value="{{$userprofile->user->lname}}" required>
                    </div>
                    <div class="col-sm-3 ">
                      <label class="col-form-label">{{ __('First Name') }}</label>
                      <input class="form-control" type="text"  name="fname" value="{{$userprofile->user->fname}}" required>
                    </div>
                    <div class="col-sm-3 ">
                      <label class="col-form-label">{{ __('Middle Name') }}</label>
                      <input class="form-control" type="text"  name="mname" id="mname" value="{{$userprofile->user->mname}}">
                    </div>
                    <div class="col-sm-3 ">
                      <label class="col-form-label">{{ __('Name Extension') }}</label>
                      <input class="form-control" type="text"  name="name_ext" value="{{$userprofile->user->name_ext}}" >
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-3 ">
                    <label class="col-form-label">{{ __('Date of Birth') }}</label>
                    <input class="form-control" type="date"  name="date_of_birth" value="{{$userprofile->user->date_of_birth}}"  required>
                    </div>
                    <div class="col-sm-3 ">
                      <label class="col-form-label">{{ __('Place of Birth') }}</label>
                      <input class="form-control" type="text"  name="place_of_birth" value="{{$userprofile->user->place_of_birth}}" required>
                    </div>
                    <div class="col-sm-3 ">
                      <label class="col-form-label">{{ __('Sex') }}</label>
                      <select class="form-control" name="sex" required>
                        <option selected disabled>Please Select</option>
                        <option <?php if($userprofile->user->sex == "Male"){ echo 'selected';}?> value="Male" >Male</option>
                        <option <?php if($userprofile->user->sex == "Female"){ echo 'selected';}?> value="Female">Female</option>
                      </select>
                     <!--  <input class="form-control" type="text"  name="sex" value="{{$userprofile->user->sex}}" required> -->
                    </div>
                    <div class="col-sm-3 ">
                      <label class="col-form-label">{{ __('Civil Status') }}</label>
                      <select class="form-control" name="civil_status" required>
                        <option selected disabled>Please Select</option>
                        <option <?php if($userprofile->user->civil_status == "Single"){ echo 'selected';}?> value="Single" >Single</option>
                        <option <?php if($userprofile->user->civil_status == "Married"){ echo 'selected';}?> value="Married">Single</option>
                        <option <?php if($userprofile->user->civil_status == "Widowed"){ echo 'selected';}?> value="Widowed">Widowed</option>
                        <option <?php if($userprofile->user->civil_status == "Separated"){ echo 'selected';}?> value="Separated">Separated</option>
                      </select>
                     <!--  <input class="form-control" type="text"  name="civil_status" value="{{$userprofile->user->civil_status}}" required> -->
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-3 ">
                    <label class="col-form-label">{{ __('Height (cm)') }}</label>
                    <input class="form-control" type="text"  name="height" value="{{$userprofile->user->height}}" required>
                    </div>
                    <div class="col-sm-3 ">
                      <label class="col-form-label">{{ __('Weight (kg)') }}</label>
                      <input class="form-control" type="text"  name="weight" value="{{$userprofile->user->weight}}" required>
                    </div>
                    <div class="col-sm-3 ">
                      <label class="col-form-label">{{ __('Blood Type') }}</label>
                      <input class="form-control" type="text"  name="blood_type" value="{{$userprofile->user->blood_type}}" required>
                    </div>
                    <div class="col-sm-3 ">
                      <label class="col-form-label">{{ __('Citizenship') }}</label>
                      <input class="form-control" type="text"  name="citizenship" value="{{$userprofile->user->citizenship}}"  required>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-3 ">
                      <label class="col-form-label">{{ __('GSIS ID No.') }}</label>
                      <input class="form-control" type="text"  name="gsis" value="{{$userprofile->user->gsis}}" >
                    </div>
                    <div class="col-sm-3 ">
                    <label class="col-form-label">{{ __('PAG-IBIG ID No.') }}</label>
                    <input class="form-control" type="text"  name="pagibig" value="{{$userprofile->user->pagibig}}"  >
                    </div>
                    <div class="col-sm-3 ">
                      <label class="col-form-label">{{ __('PHILHEALTH No.') }}</label>
                      <input class="form-control" type="text"  name="philhealth" value="{{$userprofile->user->philhealth}}">
                    </div>
                    <div class="col-sm-3 ">
                      <label class="col-form-label">{{ __('SSS No.') }}</label>
                      <input class="form-control" type="text"  name="sss" value="{{$userprofile->user->sss}}"  >
                    </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-3 ">
                      <label class="col-form-label">{{ __('TIN No.') }}</label>
                      <input class="form-control" type="text"  name="tin" value="{{$userprofile->user->tin}}" >
                     </div>
                     <div class="col-sm-3 ">
                      <label class="col-form-label">{{ __('Telephone No.') }}</label>
                      <input class="form-control" type="text"  name="tel_no" value="{{$userprofile->user->tel_no}}" >
                     </div>
                     <div class="col-sm-3 ">
                      <label class="col-form-label">{{ __('Mobile No.') }}</label>
                      <input class="form-control" type="text"  name="mobile" value="{{$userprofile->user->mobile}}"  required>
                     </div>
                  </div>
                  <br>
                  <h5><strong>Residential Address</strong></h5>
                  <div class="row">     
                      <div class="col-sm-4 ">
                        <label class="col-form-label">{{ __('House/Block/Lot No.') }}</label>
                        <input class="form-control" type="text"  name="res_house_no" value="{{$userprofile->user->res_house_no}}" >
                      </div>
                      <div class="col-sm-4 ">
                      <label class="col-form-label">{{ __('Street') }}</label>
                      <input class="form-control" type="text"  name="res_street" value="{{$userprofile->user->res_street}}"  required>
                      </div>
                      <div class="col-sm-4 ">
                        <label class="col-form-label">{{ __('Subdivision/Village') }}</label>
                        <input class="form-control" type="text"  name="res_village" value="{{$userprofile->user->res_village}}" >
                      </div>
                  </div>
                  <div class="row">     
                  <div class="col-sm-4">
                  <div class="form-group">
                    <label for="province" class="col-form-label">Province</label><br>
                    
                      <select data-live-search="true" name="province" id="province" class="form-control" style="max-height: 200px;" >
                      </select>
                      <input class="form-control" type="text" name="r_prov" id="r_prov" readonly value="{{$userprofile->user->res_province}}">
                    
                  </div>
                  </div>
                  

                  <div class="col-sm-4">
                  <div class="form-group">
                    <label for="municipality" class="col-form-label">City/Municipality</label><br>
                     <select name="city" id="city" class="form-control"  ></select>
                     <input class="form-control" type="text" name="r_city" id="r_city" readonly value="{{$userprofile->user->res_municipality}}">
                  
                  </div>
                  </div>

                  <div class="col-sm-4">
                  <div class="form-group">
                    <label for="barangay" class="col-form-label">Barangay</label><br>
                    <select name="barangay" id="barangay" class="form-control"></select>
                    <input class="form-control" type="text" name="r_brgy" id="r_brgy" readonly value="{{$userprofile->user->res_brgy}}">
                  </div>
                  </div>
                     
                  </div>
                  <div class="row">
                     <div class="col-sm-3 ">
                        <div class="form-group">
                        <label for="barangay" class="col-form-label">Zip code</label><br>
                        <input class="form-control" type="text"  name="res_zipcode" value="{{$userprofile->user->res_zipcode}}"   required></div>
                      </div>
                    
                  </div>
                  <br>
                  <h5><strong>Permanent Address</strong></h5>
                <!--   <h5><input type="checkbox"> Same as Residential Address</h5> -->
                  <div class="row">     
                      <div class="col-sm-4 ">
                        <label class="col-form-label">{{ __('House/Block/Lot No.') }}</label>
                        <input class="form-control" type="text"  name="perm_house_no" value="{{$userprofile->user->perm_house_no}}">
                      </div>
                      <div class="col-sm-4 ">
                      <label class="col-form-label">{{ __('Street') }}</label>
                      <input class="form-control" type="text"  name="perm_street" value="{{$userprofile->user->perm_street}}" required>
                      </div>
                      <div class="col-sm-4 ">
                        <label class="col-form-label">{{ __('Subdivision/Village') }}</label>
                        <input class="form-control" type="text"  name="perm_village" value="{{$userprofile->user->perm_village}}">
                      </div>
                  </div>
                   <div class="row">     
                  <div class="col-sm-4">
                  <div class="form-group">
                    <label for="province" class="col-form-label">Province</label><br>
                    
                      <select data-live-search="true" name="perm_province" id="perm_province" class="form-control" style="max-height: 200px;"
                      value="{{$userprofile->user->perm_province}}"   >

                      </select>
                      <input class="form-control" type="text" name="p_prov" id="p_prov" readonly value="{{$userprofile->user->perm_province}}">
                    
                  </div>
                  </div>
                  

                  <div class="col-sm-4">
                  <div class="form-group">
                    <label for="perm_city" class="col-form-label">City/Municipality</label><br>
                     <select name="perm_city" id="perm_city" class="form-control" >
                      
                     </select>
                     <input class="form-control" type="text" name="p_city" id="p_city" readonly value="{{$userprofile->user->perm_municipality}}">
                  
                  </div>
                  </div>

                  <div class="col-sm-4">
                  <div class="form-group">
                    <label for="barangay" class="col-form-label">Barangay</label><br>
                    <select name="perm_barangay" id="perm_barangay" class="form-control" ></select>
                    <input class="form-control" type="text" name="p_brgy" id="p_brgy" value="{{$userprofile->user->perm_brgy}}" readonly>

                  </div>
                  </div>
                     
                  </div>
                  <div class="row">
                     <div class="col-sm-3 ">
                        <div class="form-group">
                        <label for="barangay" class="col-form-label">Zip code</label><br>
                        <input class="form-control" type="text"  name="perm_zipcode" value="{{$userprofile->user->perm_zipcode}}"   required></div>
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
    </div>
  </div>
</div>

<script type="text/javascript">
            var my_handlers = {

                // fill_provinces:  function(){

                //     var region_code = $(this).val();
                //     $('#province').ph_locations('fetch_list', [{"region_code": region_code}]);
                    
                // },

                fill_cities: function(){

                    $('#city').removeAttr('selected').find('option:first').attr('selected', 'selected');
                 

                    var province_code = $('#province').val();
                    $('#city').ph_locations( 'fetch_list', [{"province_code": province_code}]);
               

                        var city_code = "x";
                
                    $('#barangay').ph_locations('fetch_list', [{"city_code": city_code}]);

                    $('#r_prov').val($( "#province option:selected" ).text());
                  
                },

                fill_perm_cities: function(){

                  $('#p_prov').val($( "#perm_province option:selected" ).text());

                    $('#perm_city').removeAttr('selected').find('option:first').attr('selected', 'selected');
                 

                    var perm_province_code = $('#perm_province').val();
                    $('#perm_city').ph_locations( 'fetch_list', [{"province_code": perm_province_code}]);
               

                        var perm_city_code = "x";
                
                    $('#perm_barangay').ph_locations('fetch_list', [{"city_code": perm_city_code}]);
                  
                },


                fill_barangays: function(){
                    

                    var city_code = $('#city').val();
                    $('#barangay').ph_locations('fetch_list', [{"city_code": city_code}]);

                     $('#r_city').val($( "#city option:selected" ).text());

                }, 

                fill_perm_barangays: function(){
                    

                  
                 
                    var perm_city_code = $('#perm_city').val();
                    $('#perm_barangay').ph_locations('fetch_list', [{"city_code": perm_city_code}]);
                    $('#p_city').val($( "#perm_city option:selected" ).text());
                  


                },

                brgy: function(){
                  $('#p_brgy').val($( "#perm_barangay option:selected" ).text());
                },

                r_brgy: function(){
                  $('#r_brgy').val($( "#barangay option:selected" ).text());
                }             




            };

         

            $(function(){
                // $('#region').on('change', my_handlers.fill_provinces);

                 

                $('#province').on('change', my_handlers.fill_cities);
              
                $('#city').on('change', my_handlers.fill_barangays);
                $('#barangay').on('change', my_handlers.r_brgy);
                $('#region').ph_locations({'location_type': 'regions'});
                $('#province').ph_locations({'location_type': 'provinces'});
                $('#city').ph_locations({'location_type': 'cities'});
                $('#barangay').ph_locations({'location_type': 'barangays'});

                $('#province').ph_locations('fetch_list');
                

                $('#perm_province').on('change', my_handlers.fill_perm_cities);
                $('#perm_city').on('change', my_handlers.fill_perm_barangays);
                $('#perm_barangay').on('change', my_handlers.brgy);

                $('#perm_province').ph_locations({'location_type': 'provinces'});
                $('#perm_city').ph_locations({'location_type': 'cities'});
                $('#perm_barangay').ph_locations({'location_type': 'barangays'});
                 $('#perm_province').ph_locations('fetch_list');


              

                

            });

            // var pprovince=document.getElementById('p_prov').value;
              
            //     if(isset(pprovince)){
            //     $('#perm_province').val(pprovince);

            //     }
            //     else{

            //     }

             
  </script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



  


  <script
  src="https://code.jquery.com/jquery-3.6.0.slim.min.js"
  integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI="
  crossorigin="anonymous"></script>

<script >


  function edit(){

  
  if($('#editbtn').text()=="Edit"){
   $("#formprofile :input").prop("disabled", false);
    $('#editbtn').text('Cancel');
      $('#perm_province').show();
      $('#perm_city').show();
      $('#perm_barangay').show();
      $('#province').show();
      $('#city').show();
      $('#barangay').show();
  }
  else{
    location.reload();
    $("#formprofile :input").prop("disabled", true);
    $('#editbtn').text('Edit');
      $('#perm_province').hide();
      $('#perm_city').hide();
      $('#perm_barangay').hide();
      $('#province').hide();
      $('#city').hide();
      $('#barangay').hide();
  }

    

  }
  $(document).ready(function(){
  
      $('#perm_province').hide();
      $('#perm_city').hide();
      $('#perm_barangay').hide();
      $('#province').hide();
      $('#city').hide();
      $('#barangay').hide();

  $("#formprofile :input").prop("disabled", true);
   $(".editbtn").on("click", function(){
         edit();


    });

});

  
</script>
<script type="text/javascript">


   
        function myfunction(){
         // document.body.scrollTop = 0;
 //     // document.body.scrollIntoView({behavior: "smooth"});
   
 //   document.body.scrollTop = 0;

 // document.documentElement.scrollTop = 0
 edit();
 window.location.href="#content";
   document.getElementById('messagelink').click();

}
    
// window.scroll({
//    top: 0,
//    left: 0,
//    behavior: 'smooth'
// });

// document.body.scrollTop = 0;

// document.documentElement.scrollTop = 0;);
// $("#profcard").scrollTop();


</script>

@endsection