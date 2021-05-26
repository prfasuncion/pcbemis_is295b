@extends('layouts.app', ['activePage' => 'jobopp', 'titlePage' => __('Job Opportunities')])

@section('content')
 @csrf
<div class="content" id="content">
  <div class="container-fluid">



    <div class="row">
                <div class="col-sm-12">
                <div class="float-right">
                  <a type="submit" class="btn btn-primary" href="{{ url()->previous() }}">Back</a>
                  </div>
                </div>
      <div class="col-lg-12 col-md-12">

          <div class="card" id="profcard">
            <div class="card-header card-header-tabs card-header-primary">
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                    <h4>{{$job_opp->job_title}}</h4>
                   
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="tab-content">
            
               <h4> {{$job_opp->job_salary}}</h4>
               <h5 class="text-primary">Job Description/Details</h5>
                <div class="tab-pane active" id="messages">
                  <div class="row">
                    <div class="col-sm-12">
                    <?php echo $job_opp->job_description; ?>
                    </div>
                  </div>
                </div>
                
              </div>
            </div>
          </div>
        </div>
    </div>

    <div class="row">
     
      <div class="col-lg-12 col-md-12">
          <div class="card" id="profcard">
            <div class="card-header card-header-tabs card-header-success">
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                    <h4>My Application Intent 
                      <span class="pull-right">
                        Submitted on
                        <?php echo date('F d, Y H:i', strtotime($application->created_at))?>
                      </span>
                    </h4>
                </div>
              </div>
            </div>
             <form action="{{route('user_jobopportunity.store')}}" method="post">
        @csrf
        @method('post')
            <div class="card-body">
              <div class="tab-content">
            
               <?php echo $application->intent; ?>
              </div>
                  
            </div>


               </form>
          </div>
        </div>
   
    </div>
  </div>
</div>
<script type="text/javascript" src="{{ asset('material') }}/js/tableManager.js"></script>
<script type="text/javascript">
    // basic usage
    $('.tablemanager').tablemanager({
      firstSort: [[5,'desc']],
      disable: ["last"],
      appendFilterby: true,
      dateFormat: [[4,"mm-dd-yyyy"]],
      debug: true,
      vocabulary: {
    voc_filter_by: 'Filter By',
    voc_type_here_filter: 'Search...',
    voc_show_rows: '  Rows Per Page'
  },
      pagination: true,
      showrows: [5,10,15,20],
      disableFilterBy: [7]
    });
    // $('.tablemanager').tablemanager();
  </script>

<script src="https://cdn.tiny.cloud/1/mcfgmuwd6krbwezb0gi8mi68jw5flsyd9dwa5hmk6ckodl0j/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>


<script>

    tinymce.init({
        selector:'textarea.intent',
        // width: 900,
        plugins: 'link',
        height: 300,
        setup : function(ed) {
          if($(ed.getBody()).text().length===0){
                $('#applybtn').hide();
               
          }

        ed.on("change", function(e){
          if($(ed.getBody()).text().length===0){
                $('#applybtn').hide();
               
          }
          else{
                $('#applybtn').show();
          
          }
            
        });
        ed.on("keyup", function(){
            if($(ed.getBody()).text().length===0){
                $('#applybtn').hide();
               
          }
          else{
               $('#applybtn').show();
               
          }
        });
        }



         });
</script>
@endsection

 