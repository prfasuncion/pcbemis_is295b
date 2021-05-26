@extends('layouts.adminapp', ['activePage' => 'jobopp', 'titlePage' => __('Job Opportunities')])

@section('content')


<div class="content">
  <div class="container-fluid">

  	<div class="row">
        <div class="col-sm-12">
        	
        <div class="card col-sm-12"  style=" background-color: rgba(255,255,255,0.85);" >
          <div class="card-header card-header-primary">
            <h4 class="card-title mt-0">{{$job->job_title}}
           
            <div class="float-right">
              <a href="{{route('job_opportunity.index')}}" class="btn btn-dark btn-sm">BACK</a>
              <a href="{{route('job_opportunity.print_jobopp', [$id= Crypt::encrypt($job->id)])}}" target="_blank" class="btn btn-sm btn-info">PRINT</a>
            </div>
            </h4>
          </div>
          <div class="card-body" >
          	<div class="row">
          		<div class="col-sm-12">
          			<h4>{{$job->job_salary}}</h4>
          		</div>
          		
          	</div>

          	<div class="row">
          		<div class="col-sm-12">
          			<h4 class="text-primary">Job Description/Details</h4>
          			<?php echo $job->job_description; ?>
          			
          		</div>
          		
          	</div>
         
         
          </div>
      
        </div>
      </div>
      </div>
	


  	<div class="row">

  		<div class="col-sm-12">
  		<h3>Applicants 
        @if($job->job_category=="external")
        ({{$external_applicants->total()}})
        @else
         ({{$internal_applicants->total()}})

        @endif

      </h3>
  		</div>
  	</div>
  	<div class="row">
      @if($job->job_category=="external")
  	@foreach($external_applicants as $y)
  	<div class=" col-sm-4">
  	<div class="card bg-dark" style=" color: white; ">
  		
        <img src="<?php echo asset( $y->image); ?>" class="card-img-top ml-auto mr-auto " alt="..." style="height: 225px; width: 225px; max-height: 225px; border-radius: 50%; margin-top:25px">
        <div class="card-body " align="center">
            <h5 class="card-title"><strong>{{ $y->fname}}</strong></h5>
            	<h5><strong>{{$y->lname }}</strong></h5>
            <p class="card-text">{{$y->email }}</p>
            <p class="card-text">{{$y->contact }}</p>
       <!--       <a href="" class="btn btn-md btn-success"><i class="material-icons">mail</i></a> -->
            <a href="{{route('job_opportunity.external_app_profile', [Crypt::encrypt($y->id)])}}" class="btn btn-primary">View details</a>
       <!--      <a href="" class="btn btn-md btn-info"><i class="material-icons">print</i></a> -->
        </div>
   </div>
   </div>
 @endforeach 
 @else
  @foreach($internal_applicants as $z)
    <div class=" col-sm-4">
    <div class="card bg-dark" style=" color: white; ">
      @foreach($users as $user)
            @if($z->user_id==$user->id)
       <!--  <img src="<?php echo asset( $z->image); ?>" class="card-img-top ml-auto mr-auto " alt="..." style="height: 225px; width: 225px; max-height: 225px; border-radius: 50%; margin-top:25px"> -->

                @if(!isset($user->image))
                   <img class="card-img-top ml-auto mr-auto " src='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSQJxKGGpPc9-5g25KWwnsCCy9O_dlS4HWo5A&usqp=CAU'  id="img" style="height: 225px; width: 225px; max-height: 225px; border-radius: 50%; margin-top:25px"> 
                    @else
                    <img class="card-img-top ml-auto mr-auto " src="<?php echo asset( $user->image); ?>"  id="img" style="height: 225px; width: 225px; max-height: 225px; border-radius: 50%; margin-top:25px">
                    @endif


        <div class="card-body " align="center">
          
              <h5 class="card-title"><strong>{{ $user->user->fname}}</strong></h5>
              <h5><strong>{{$user->user->lname }}</strong></h5>
              <p class="card-text">{{$user->email }}</p>
            <p class="card-text">{{$user->user->mobile }}</p>
            @endif
          @endforeach
            
            
       <!--       <a href="" class="btn btn-md btn-success"><i class="material-icons">mail</i></a> -->
            <a href="{{route('job_opportunity.internal_app_profile',  [$id= Crypt::encrypt($z->id)])}}" class="btn btn-primary">View details</a>
         <!--    <a href="" class="btn btn-md btn-info"><i class="material-icons">print</i></a> -->
        </div>
   </div>
   </div>
 @endforeach     

 @endif
 </div>
        @if($job->job_category=="external")
        <div class="row">
        <div class="col-sm-12">
       @if ($external_applicants->total() !==0)
    
  
        <div class="">
          Showing {{ $internal_applicants->firstItem() }} to {{ $external_applicants->lastItem() }} of total {{$external_applicants->total()}} entries
        </div>
        @else
        <div class="">
          <p>No Applications for this Job Posting yet</p>
        </div>
        @endif
         <div class="ml-auto">
            {{ $external_applicants->render("pagination::bootstrap-4") }}
        </div>
        </div>
        
      </div> 
        @else
        <div class="row">
        <div class="col-sm-12">
       @if ($internal_applicants->total() !==0)
    
  
        <div class="">
          Showing {{ $internal_applicants->firstItem() }} to {{ $internal_applicants->lastItem() }} of total {{$internal_applicants->total()}} entries
        </div>
        @else
        <div class="">
          <p>No Applications for this Job Posting yet</p>
        </div>
        @endif
         <div class="ml-auto">
            {{ $internal_applicants->render("pagination::bootstrap-4") }}
        </div>
        </div>
        
      </div> 

        @endif
<!--   		<div class="row">
  			<div class="col-sm-12">
       @if ($internal_applicants->total() !==0)
		
	
        <div class="">
        	Showing {{ $internal_applicants->firstItem() }} to {{ $internal_applicants->lastItem() }} of total {{$internal_applicants->total()}} entries
    		</div>
    		@else
    		<div class="">
    			<p>No Applications for this Job Posting yet</p>
    		</div>
    		@endif
    		 <div class="ml-auto">
            {{ $internal_applicants->render("pagination::bootstrap-4") }}
        </div>
        </div>
        
      </div>   --> 

  </div>
</div>
@endsection