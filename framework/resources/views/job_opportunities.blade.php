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
        	
        <div class="card col-sm-12"  style=" background-color: rgba(255,255,255,0.85);" >
          <div class="card-header card-header-primary">
            <h4 class="card-title mt-0"> Be a part of our growing community!</h4>
            <p class="card-category"> </p>
          </div>
          <div class="card-body" >
         
            <div class="table-responsive">
              <table class="table table-hover ">
                <thead class="">
                  
                  <th>
                    Job Posting
                  </th>
                  <th></th>
                  <th class="action text-right">
                <!--     Action -->
                  </th>
                	
                </thead>
                <tbody>
                  
                 <?php $count_job=0; ?>
               	@foreach ($job_opps as $jobs)
               	@if($jobs->job_category=="external" && $jobs->status==1)
               	<?php $count_job++;?>
                  <tr>
                    <td width="20%">
                    	<img src="{{ asset('material') }}/img/hiring.png" width="150px" height="80px">
                     
                    </td>
                    <td align="left">

                    	<h5>
                    		<strong>
                     {{ $jobs->job_title }}
                     </strong>
                     </h5>
                    </td>
                    <td class="action text-right">
                     
                     		
                     	 <a rel="tooltip" class="btn btn-primary" href="{{ route('jobs.view', [Crypt::encrypt($jobs->id)]) }}" data-original-title="" >
                     	 	APPLY NOW!
                     	</a>

                    </td>
                   
                  </tr>
                  @else
                  
                  @endif
                  @endforeach
                  @if($count_job==0)
                  <tr>
                  	<td>
                  		No Job Postings as of the moment
                  	</td>
                  </tr>
                  @endif
                  
                </tbody>
              </table>

            </div>
          </div>
          <div class="card-footer ml-auto ">
          	<div class="row ">
                  <div class="col-12 text-right">
                  
                
                  </div>
                </div>
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
  setTimeout(function() {
    $('#failedMessage').fadeOut('fast');
}, 5000);
</script>
@endsection
