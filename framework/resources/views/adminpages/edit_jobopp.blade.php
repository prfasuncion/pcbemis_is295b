@extends('layouts.adminapp', ['activePage' => 'jobopp', 'titlePage' => __('Job Opportunities')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Edit Job Post</h4>
            <p class="card-category"> </p>
          </div>
          <div class="card-body">
            <form method="post" action="{{  route('job_opportunity.save_edit_jobopp', [$id= Crypt::encrypt($jobopp->id)])}}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')        
               
                   <div class="row">
                    <div class="col-sm-12 ">
                    <label class="col-form-label">{{ __('Job Category') }}</label>
                    <select class="selectpicker" name="category">
                      <option value="internal" 
                      <?php if($jobopp->job_category=='internal') 
                            {
                              echo "selected";
                            }
                        ?>
                      >Internal</option>
                      <option value="external"
                      <?php if($jobopp->job_category=='external') 
                            {
                              echo "selected";
                            }
                        ?>
                      >External</option>
                      
                    </select>
                  <!--   <input class="form-control" type="text"  name="category" id="desigtitle" required> -->
                  </div>
                  <div class="col-sm-12 ">
                    <label class="col-form-label">{{ __('Job Title') }}</label>
                    <input class="form-control" type="text"  name="jobtitle" id="desigtitle" required value="{{$jobopp->job_title}}">
                  </div><br>
       
                  <div class="col-sm-12 ">
                    <label for="exampleFormControlTextarea1">Description</label>
                     <textarea class="description" id="description" name="description" rows="3" >{!!$jobopp->job_description!!}</textarea>

                   
                  </div>
                  <!-- <div class="col-sm-12 ">
                    <label for="exampleFormControlTextarea1">Qualifications/Requirements</label>
                    <textarea class="form-control" id="description" name="qualifications" rows="5" required></textarea>
                    <textarea class="description" id="description" name="qualifications" rows="3"></textarea>
                  </div> -->
                   <br>
                   <div class="col-sm-12 ">
                    <label class="col-form-label">{{ __('Salary') }}</label>
                    <input class="form-control" type="text"  name="salary" id="desigtitle"  value="{{$jobopp->job_salary}}">
                  </div><br>

               
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
<script src="https://cdn.tiny.cloud/1/mcfgmuwd6krbwezb0gi8mi68jw5flsyd9dwa5hmk6ckodl0j/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script>

    tinymce.init({
        selector:'textarea.description',
        // width: 900,
        plugins: 'link',
        height: 300, 
        setup : function(ed) {
          if($(ed.getBody()).text().length===0){
                $('#finish').hide();
                $('#addmilestone').hide();
          }

        ed.on("change", function(e){
          if($(ed.getBody()).text().length===0){
                $('#finish').hide();
                $('#addmilestone').hide();
          }
          else{
                $('#finish').show();
                $('#addmilestone').show();
          }



            
        });
        ed.on("keyup", function(){
            if($(ed.getBody()).text().length===0){
                $('#finish').hide();
                $('#addmilestone').hide();
          }
          else{
                $('#finish').show();
                $('#addmilestone').show();
          }
        });
   }
    });

 
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
