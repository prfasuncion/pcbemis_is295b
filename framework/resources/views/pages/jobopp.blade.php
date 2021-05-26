@extends('layouts.app', ['activePage' => 'jobopp', 'titlePage' => __('Job Opportunities')])

@section('content')
 @csrf
<div class="content" id="content">
  <div class="container-fluid">
   <!--  <div class="row">
      <div class="col-lg-12 col-md-12">
          <div class="card" id="profcard">
            <div class="card-header card-header-tabs card-header-primary">
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                    Internal Job Opportunities
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="tab-content">
            

                <div class="tab-pane active" id="">
                  <div class="row">
                  <div class="col-sm-6">
                
                  </div>
                  <div class="col-sm-6">
                    
                  </div>
                  </div>
                  
                  <table class="table" id="jobs">
                  	 <thead class=" text-primary">
                  	  
                      </thead>
                    
                  </table>
                  
                </div>
                
              </div>
            </div>
          </div>
        </div>
    </div> -->

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

    <div class="row">
    @foreach($job_opps as $job)
    <div class=" col-sm-4">
    <div class="card bg-dark" style=" color: white; ">
      
        <img src="https://www.theindependentbd.com/assets/news_images/Recruitment.jpg" class="card-img-top ml-auto mr-auto " alt="..." >
        <div class="card-body " align="center">
           <h5>{{$job->job_title}}</h5>
          
            <a href="{{ route('joboppuser.viewjob', [Crypt::encrypt($job->id)]) }}" class="btn btn-md btn-success"><i class="material-icons"></i>Apply</a>
        </div>
   </div>
   </div>
    @endforeach
 </div>

  <div class="row">
        <div class="col-sm-12">
       @if ($job_opps->total() !==0)
    
  
          <div class="">
            Showing {{ $job_opps->firstItem() }} to {{ $job_opps->lastItem() }} of total {{$job_opps->total()}} entries
          </div>
          @else
          <div class="">
            <p>No Available Job Posting yet</p>
          </div>
          @endif
          <div class="pull-right">
            {{ $job_opps->render("pagination::bootstrap-4") }}
        </div>
        </div>
        
    </div> 
<br>
<!--My Applications-->
    <div class="row">
      <div class="col-lg-12 col-md-12">
          <div class="card" id="profcard">
            <div class="card-header card-header-tabs card-header-primary">
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                    My Applications
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="tab-content">
            

                <div class="tab-pane active" id="">
                  <div class="row">
                  <div class="col-sm-6">
                
                  </div>
                  <div class="col-sm-6">
                    
                  </div>
                  </div>
                  
                  <table class="table" id="myapplications">
                     <thead class=" text-primary">
                      <th>Job Title</th>

                      <th>Date Applied</th>
                      <th class="text-right">Action</th>
                      </thead>
                      <tbody>
                        @foreach($applications as $application)
                        <tr>
                          <td>
                            @foreach($myjobopps as $job)
                              @if($application->job_id==$job->id)
                                {{$job->job_title}}

                              @endif
                            @endforeach

                          </td>
                          <td>
                             <?php echo date('F d, Y H:i', strtotime($application->created_at))?>
                          </td>
                          <td class="text-right">
                            <a class="btn btn-success" href="{{ route('joboppuser.view_application', [Crypt::encrypt($application->job_id)]) }}">
                             <i class="material-icons">visibility</i> View 
                            </a>
                          <!--   <a rel="tooltip" class="btn btn-success" href="" data-original-title="" title="View Task">
                              <i class="material-icons">visibility</i>
                              <div class="ripple-container"></div>
                            </a> -->
                          </td>
                        </tr>
                        @endforeach


                      </tbody>
                    
                  </table>

                </div>
                
              </div>
            </div>
          </div>
        </div>
    </div>
   
  </div>
</div>
<script type="text/javascript">
  setInterval(function() {
                  window.location.reload();
                }, 30000); 

</script>
<script type="text/javascript" src="{{ asset('material') }}/js/tableManager.js"></script>
<script type="text/javascript">
    // basic usage
  //   $('#jobs').tablemanager({
  //     firstSort: [[5,'desc']],
  //     disable: ["last"],
  //     appendFilterby: true,
  //     dateFormat: [[4,"mm-dd-yyyy"]],
  //     debug: true,
  //     vocabulary: {
  //   voc_filter_by: 'Filter By',
  //   voc_type_here_filter: 'Search...',
  //   voc_show_rows: '  Rows Per Page'
  // },
  //     pagination: true,
  //     showrows: [5,10,15,20],
  //     disableFilterBy: [7]
  //   });
    

     $('#myapplications').tablemanager({
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
      disableFilterBy: [3]
    });
  </script>

@endsection

 