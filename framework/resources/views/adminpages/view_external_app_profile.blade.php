@extends('layouts.adminapp', ['activePage' => 'jobopp', 'titlePage' => __('Job Opportunities')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
      	<div class="card">
            <div class="card-header card-header-primary" style="vertical-align: middle; display: inline-block;">
              <h4 class="card-title ">
              	{{ $external_app->lname}},
              	{{ $external_app->fname}}
              	{{ $external_app->name_ext}}
              	{{ $external_app->mname}}
              	<div class="float-right">
                    <a href="{{route('job_opportunity.view', [Crypt::encrypt($external_app->job_id)])}}" class="btn btn-dark btn-sm">BACK</a>
              		<a target="_blank" href="{{route('job_opportunity.external_print_profile', [$id=Crypt::encrypt($external_app->id)])}}" class="btn btn-info btn-sm">Print</a>
              	</div>
              </h4>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-sm-12">
                  <h4 class="text-primary">Profile</h4>
                </div>
                <div class="col-sm-4 ml-auto mr-auto">

                         @if(!isset($external_app->image))
                           <img class="card-img-top ml-auto mr-auto " src='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSQJxKGGpPc9-5g25KWwnsCCy9O_dlS4HWo5A&usqp=CAU'  id="img" style="height: 250px; width: 250px; max-height: 250px;  "> 
                            @else
                            <img class="card-img-top ml-auto mr-auto " src="<?php echo asset($external_app->image); ?>"  id="img" style="height: 250px; width: 250px; max-height: 250px;  ">
                            @endif
                </div>
                <div class="col-sm-8">
                  <!-- <p>Last Name:</p>
                  <p>First Name:</p>
                  <p>Middle Name:</p>
                  <p>Name Extension:</p> -->
                  <table class="table table-condensed" id="profiletbl">
                    <style type="text/css">
                #profiletbl td{
                  padding: .3em;
                }
                  </style>
                    <thead></thead>
                    <tbody>
                    <tr>
                      <td width="30%">Last Name</td>
                      <td width="5%">:</td>
                      <td ><strong>{{$external_app->lname}}</strong></td>
                    
                    </tr>
                    <tr >
                      <td width="30%">First Name</td>
                      <td width="5%">:</td>
                      <td ><strong>{{$external_app->fname}}</strong></td>
                    </tr>
                    <tr>
                      <td width="30%">Middle Name</td>
                      <td width="5%">:</td>
                      <td><strong>{{$external_app->mname}}</strong></td>
                    </tr>
                    <tr>
                      <td width="30%">Name Extension</td>
                      <td width="5%">:</td>
                      <td><strong>{{$external_app->name_ext}}
                          @if(!isset($external_app->name_ext))
                          N/A
                          @endif
                        </strong>
                      </td>
                    </tr>
                    <tr>
                      <td width="30%">Birthday</td>
                      <td width="5%">:</td>
                      <td><strong>{{$external_app->bday}}</strong></td>
                    </tr>
                    <tr>
                      <td width="30%">Contact Number</td>
                      <td width="5%">:</td>
                      <td ><strong>{{$external_app->contact}}</strong></td>
                    </tr>
                    <tr>
                      <td width="30%">E-mail</td>
                      <td width="5%">:</td>
                      <td><strong>{{$external_app->email}}</strong></td>
                    </tr>
                    <tr>
                      <td width="30%">Attachment</td>
                      <td width="5%">:</td>
                      <td>
                        @if(isset($external_app->email))
                        <a class="btn btn-sm btn-primary" href="{{route('job_opportunity.download', $external_app->id)}}" style="color: white;">VIEW RESUME</a>
                     <!--    <a class="btn btn-sm btn-primary" href='{{ asset($external_app->resume) }}' style="color: white;">VIEW RESUME</a> -->
                        @else
                        No Attachment
                        @endif

                      </td>
                    </tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-sm-12">
                  <h4 class="text-primary">Application Intent</h4>
                </div>
                <div class="col-sm-12">
                  {!!$external_app->intent!!}
                </div>
              </div>
            </div>
              


        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  
  function printImg(url) {
  
  if (url.indexOf('.pdf')>-1){
    var win = window.open(url);
   win.print();
   
  }
  // else{
  //     var win = window.open('');
  //     win.document.write('<title>PCB OAS</title><img src="' + url + '" onload="window.print();window.close()" />');
  // win.focus();
  // }
 
}
</script>
@endsection