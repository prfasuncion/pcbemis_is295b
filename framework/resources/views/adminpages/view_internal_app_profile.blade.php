@extends('layouts.adminapp', ['activePage' => 'jobopp', 'titlePage' => __('Job Opportunities')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
      	<div class="card">
            <div class="card-header card-header-primary" style="vertical-align: middle; display: inline-block;">
              <h4 class="card-title ">
              	{{ $userprofile->user->lname}},
              	{{ $userprofile->user->fname}}
              	{{ $userprofile->user->name_ext}}
              	{{ $userprofile->user->mname}}
              	<div class="float-right">
                    <a href="{{route('job_opportunity.view', [Crypt::encrypt($internal_app->job_id)])}}" class="btn btn-dark btn-sm">BACK</a>
              		<a href="{{route('job_opportunity.internal_print_profile', [$id= Crypt::encrypt($internal_app->id)])}}"class="btn btn-info btn-sm" target="_blank">Print</a>
              	</div>
              </h4>
              
              
            </div>
            <div class="card-body">
            	<div class="row">
            		<div class="col-sm-12">
            			<h4 class="text-primary">Profile</h4>
            		</div>
            		<div class="col-sm-4 ml-auto mr-auto">
            			@if(!isset($userprofile->image))
                           <img class="card-img-top ml-auto mr-auto " src='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSQJxKGGpPc9-5g25KWwnsCCy9O_dlS4HWo5A&usqp=CAU'  id="img" style="height: 250px; width: 250px; max-height: 250px;  "> 
                            @else
                            <img class="card-img-top ml-auto mr-auto " src="<?php echo asset( $userprofile->image); ?>"  id="img" style="height: 250px; width: 250px; max-height: 250px;  ">
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
            					<td ><strong>{{$userprofile->user->lname}}</strong></td>
            				
            				</tr>
            				<tr >
            					<td width="30%">First Name</td>
            					<td width="5%">:</td>
            					<td ><strong>{{$userprofile->user->fname}}</strong></td>
            				</tr>
            				<tr>
            					<td width="30%">Middle Name</td>
            					<td width="5%">:</td>
            					<td><strong>{{$userprofile->user->mname}}</strong></td>
            				</tr>
            				<tr>
            					<td width="30%">Name Extension</td>
            					<td width="5%">:</td>
            					<td><strong>{{$userprofile->user->name_ext}}
            							@if(!isset($userprofile->user->name_ext))
            							N/A
            							@endif
            						</strong>
            					</td>
            				</tr>
            				<tr>
            					<td width="30%">Birthday</td>
            					<td width="5%">:</td>
            					<td><strong>{{$userprofile->user->date_of_birth}}</strong></td>
            				</tr>
            				<tr>
            					<td width="30%">Contact Number</td>
            					<td width="5%">:</td>
            					<td ><strong>{{$userprofile->user->mobile}}</strong></td>
            				</tr>
            				<tr>
            					<td width="30%">E-mail</td>
            					<td width="5%">:</td>
            					<td><strong>{{$userprofile->email}}</strong></td>
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
                        {!!$internal_app->intent!!}                    </div>
                </div>
            	<div class="row">
            		<div class="col-sm-12">
            			<h4 class="text-primary">Background Information</h4>
            		</div>
            		<div class="col-sm-12">
						<table class="table table-bordered table-sm" id="bginfo"> 
							<style type="text/css">
								#bginfo td{
									padding: .3em;
								}
							</style>

						<tr>
							<td>Place of Birth</td>
							<td colspan="7">{{$userprofile->user->place_of_birth}}</td>
						</tr>
						<tr>
							<td>Sex</td>
							<td colspan="3">{{$userprofile->user->sex}}</td>
							<td>Civil Status</td>
							<td colspan="3">{{$userprofile->user->civil_status}}</td>
						</tr>
						<tr>
							<td>Height (cm)</td>
							<td>{{$userprofile->user->height}}</td>
							<td>Weight (kg)</td>
							<td>{{$userprofile->user->weight}}</td>
							<td>Blood Type</td>
							<td colspan="">{{$userprofile->user->blood_type}}</td>
							<td>Citizenship</td>
							<td colspan="">{{$userprofile->user->citizenship}}</td>
						</tr>
						<tr>
							<td>GSIS ID No.</td>
							<td colspan="3">{{$userprofile->user->gsis}}</td>
							<td>PAG-IBIG ID No.</td>
							<td colspan="3">{{$userprofile->user->pagibig}}</td>
							
						</tr>	
						<tr>
							<td>PHILHEALTH No.</td>
							<td colspan="3">{{$userprofile->user->philhealth}}</td>
							<td>SSS No.</td>
							<td colspan="3">{{$userprofile->user->sss}}</td>
						</tr>
						<tr>
							<td>TIN</td>
							<td colspan="3">{{$userprofile->user->tin}}</td>
							<td>Telephone No.</td>
							<td colspan="3">{{$userprofile->user->tel_no}}</td>
						</tr>
						<tr>
							<td colspan="8" class="bg-light">Residential Address</td>
						</tr>	
						<tr>
							<td colspan="1">House No.</td>
							<td colspan="1">{{$userprofile->user->res_house_no}}</td>
							<td>Street</td>
							<td colspan="2">
								{{$userprofile->user->res_street}}
							</td>
							<td>Subdivision/Village</td>
							<td colspan="3">
								{{$userprofile->user->res_village}}
							</td>
						</tr>
						<tr>
							<td>Province</td>
							<td colspan="3">{{$userprofile->user->res_province}}</td>
							<td>Municipality</td>
							<td colspan="3">{{$userprofile->user->res_municipality}}</td>
						</tr>
						<tr>
							<td>Barangay</td>
							<td colspan="3">{{$userprofile->user->res_brgy}}</td>
							<td>Zip code</td>
							<td colspan="3">{{$userprofile->user->res_zipcode}}</td>
						</tr>
						<tr>
							<td colspan="8" class="bg-light">Permanent Address</td>
						</tr>	
						<tr>
							<td colspan="1">House No.</td>
							<td colspan="1">{{$userprofile->user->perm_house_no}}</td>
							<td>Street</td>
							<td colspan="2">
								{{$userprofile->user->perm_street}}
							</td>
							<td>Subdivision/Village</td>
							<td colspan="3">
								{{$userprofile->user->perm_village}}
							</td>
						</tr>
						<tr>
							<td>Province</td>
							<td colspan="3">{{$userprofile->user->perm_province}}</td>
							<td>Municipality</td>
							<td colspan="3">{{$userprofile->user->perm_municipality}}</td>
						</tr>
						<tr>
							<td>Barangay</td>
							<td colspan="3">{{$userprofile->user->perm_brgy}}</td>
							<td>Zip code</td>
							<td colspan="3">{{$userprofile->user->perm_zipcode}}</td>
						</tr>

						</table>            				
            		</div>
            	</div>
            	<div class="row">
            		<div class="col-sm-12">
            			<h4 class="text-primary">Eligibility</h4>
            		</div>
            		<div class="col-sm-12">
            		<table class="table table-bordered" id="eligibility_tbl">
            			<style type="text/css">
								#eligibility_tbl th, td{
									padding: .3em;
								}
							</style>
            			<thead class="bg-light">
            				<th>Eligibility</th>
            				<th>Rating</th>
            				<th>Date of Conferment</th>
            				<th>Place of Examination</th>
            				<th>License No.</th>
            				<th>Date of Validity</th>
            			</thead>
            			<tbody>
            				@foreach($eligibilities as $eligibility)
            				<tr>
            					<td>{{$eligibility->eligibility}}</td>
            					<td>{{$eligibility->rating}}</td>
            					<td>{{$eligibility->date_exam}}</td>
            					<td>{{$eligibility->place}}</td>
            					<td>{{$eligibility->license}}</td>
            					<td>{{$eligibility->validity}}</td>
            				</tr>
            				@endforeach
            			</tbody>
            			
            		</table>
            		</div>
            	</div>
            	<div class="row">
            		<div class="col-sm-12">
            			<h4 class="text-primary">Educational Background</h4>
            		</div>
            		<div class="col-sm-12">
            		<table class="table table-bordered" id="educ_tbl">
            			<style type="text/css">
								#educ_tbl th, td{
									padding: .3em;
								}
							</style>
            			<thead class="bg-light">
            				<th>Level</th>
            				<th>School</th>
            				<th>Degree/Course</th>
            				<th>From</th>
            				<th>To</th>
            				<th width="10%">Highest Level/Units Earned</th>
            				<th>Year Graduated</th>
            				<th width="10%">Scholarship/Academic Honors received</th>
            			</thead>
            			<tbody>
            				@foreach($educbg as $educ)
            				<tr>
            					<td>{{$educ->level}}</td>
            					<td>{{$educ->school}}</td>
            					<td>{{$educ->degree}}</td>
            					<td>{{$educ->ed_from}}</td>
            					<td>{{$educ->ed_to}}</td>
            					<td>{{$educ->units_earned}}</td>
            					<td>{{$educ->year_graduated}}</td>
            					<td>{{$educ->award}}</td>
            				</tr>
            				@endforeach
            			</tbody>
            			
            		</table>
            		</div>
            	</div>
            	<div class="row">
            		<div class="col-sm-12">
            			<h4 class="text-primary">Work Experience</h4>
            		</div>
            		<div class="col-sm-12">
            		<table class="table table-bordered" id="workexp_tbl">
            			<style type="text/css">
								#workexp_tbl th, td{
									padding: .3em;
								}
							</style>
            			<thead class="bg-light">
            				<th>Position</th>
            				<th>From</th>
            				<th>To</th>
            				<th>Agency/Company</th>
            				<th>Salary</th>
            				<th width="10%">Salary Grade & Step Inc.</th>
            				<th>Status of Appointment</th>
            				<th>Gov't Service</th>
            			</thead>
            			<tbody>
            				@foreach($workexp as $work)
            				<tr>
            					<td>{{$work->position}}</td>
            					<td>{{$work->from}}</td>
            					<td>{{$work->to}}</td>
            					<td>{{$work->company}}</td>
            					<td>{{$work->salary}}</td>
            					<td>{{$work->sgrade}}</td>
            					<td>{{$work->appointment}}</td>
            					<td>@if($work->gov_service==1)
            						Yes
            						@else
            						No
            						@endif
            					</td>
            				</tr>
            				@endforeach
            			</tbody>
            			
            		</table>
            		</div>
            	</div>
            	<div class="row">
            		<div class="col-sm-12">
            			<h4 class="text-primary">Learning & Development Interventions (LDI)</h4>
            		</div>
            		<div class="col-sm-12">
            		<table class="table table-bordered" id="ldi_tbl">
            			<style type="text/css">
								#ldi_tbl th, td{
									padding: .3em;
								}
							</style>
            			<thead class="bg-light">
            				<th>LD/Training Program</th>
            				<th>From</th>
            				<th>To</th>
            				<th>No. of Hours</th>
            				<th>Type of LD</th>
            				<th>Conducted/Sponsored by</th>
            			
            			</thead>
            			<tbody>
            				@foreach($trainings as $training)
            				<tr>
            					<td>{{$training->training}}</td>
            					<td>{{$training->from}}</td>
            					<td>{{$training->to}}</td>
            					<td>{{$training->hours}}</td>
            					<td>{{$training->type}}</td>
            					<td>{{$training->conducted}}</td>
            				</tr>
            				@endforeach
            			</tbody>
            			
            		</table>
            		</div>
            	</div>
            </div>
         </div>
         <br>
         <div class="card">
         	<div class="card-header card-header-primary">
         		<h4>Service Record
         			<!-- <div class="float-right">
         			<a class="btn btn-success btn-sm" data-toggle="modal" data-target=".add-sr">Add</a>
              		<button class="btn btn-info btn-sm">Print</button>
              		</div> -->
         		</h4>
         	</div>
         			

         	<div class="card-body">
         		<table class="table " id="">
                     <thead class=" text-primary">
                          <th>Position</th>
                          <th>Category</th>
                          <th>From</th>
                          <th>To</th>
                      </thead>
                      <tbody>
                        @foreach($service_record as $record)
                        <tr>
                          @foreach($positions as $position)
                              @foreach($position_type as $type)
                                  @if($position->type == $type->id)
                                  <?php $pos= $position->position; 
                                    $postype= $type->type;
                                   ?>
                                  @endif
                              @endforeach
                          @endforeach
                          <td>{{$pos}}</td>
                          <td>{{$postype}}</td>
                          <td>{{$record->started}}</td>
                          <td>
                            @if(isset($record->end))
                              {{$record->end}}
                            @else
                              {{'Present'}}
                            @endif
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    
                  </table>
         	</div>
         	<div class="card-footer">
         		
         	</div>
         </div>

      </div>
    </div>
  </div>
</div>
@endsection
