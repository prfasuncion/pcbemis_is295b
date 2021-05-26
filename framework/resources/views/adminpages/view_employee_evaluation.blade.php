@extends('layouts.adminapp', ['activePage' => 'evaluations', 'titlePage' => __('Evaluations')])


@section('content')
 @csrf
<div class="content" id="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 col-md-12">
          <div class="card" id="profcard">
            <div class="card-header card-header-tabs card-header-warning">
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                    @foreach($acadyear as $year)
                              @foreach($year->ay_details as $sem_details)
                                @if($evaluation->sem_id == $sem_details->id)
                                  {{$sem_details->name.' '.$year->start_ay.'-'.$year->end_ay.' Evaluation Result'}}
                                @endif
                              @endforeach
                            @endforeach 
                         
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="tab-content">
            

                <div class="tab-pane active" id="messages">
                	<div class="row">
              			<div class="col-sm-12">
                      <div class="float-right">
                      <a href="{{ URL::previous() }}" class="btn btn-sm btn-warning">Back</a>
                      <a href="{{route('evaluation.print_evaluation_result', [$id = Crypt::encrypt($evaluation->id), $emp_id= Crypt::encrypt($employee->id)])}}" target="_blank" class="btn btn-sm btn-info">PRINT</a>
                    </div>
              			<h5>
              			@if(!isset($employee->image))
                           <img class="card-img-top ml-auto mr-auto " src='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSQJxKGGpPc9-5g25KWwnsCCy9O_dlS4HWo5A&usqp=CAU'  id="img" style="height: 150px; width: 150px; max-height: 150px; border-radius: 50%; "> 
                            @else
                            <img class="card-img-top ml-auto mr-auto " src="<?php echo asset( $employee->image); ?>"  id="img" style="height: 150px; width: 150px; max-height: 150px; border-radius: 50%; ">
                            @endif
              			 <strong><u>{{$employee->user->lname.', '.$employee->user->fname}}</strong></u>
              			</h5>
              			</div>
              		
              		</div>
              		<div class="row">
              		<div class="col-sm-12" align="center"> 
              			<h3>Evaluation Result</h3>
              		</div>
              		
              		</div>
              		<div class="row">
              			<div class="col-sm-12">
              				<table class="table">
              					<thead class="bg-success" style="color: white;">
              						<th width="70%">Category</th>
              						<th>Rating</th>
              					</thead>
              					<tbody>

              						
					                  	<?php $teach_result=0; $t_count=0;  $categ_total=0; ?>
				                        @foreach ($eval_results as $eval_result)

                              				@foreach($eval_sets as $eval_set)
				                         	@if($eval_result->eval_set_id== $eval_set->id)

				                         	@foreach($evaldetails as $detail)

				                            @if($eval_set->kpi_id == $detail->id && $detail->eval_categ_id==1)
				                            <?php $teach_result += $eval_result->score; 
				                            	$t_count++;
				                            ?>
				                     
				                            @endif
				                    		@endforeach

				                         		
				                         	@endif
				                        	@endforeach		
                              					
                              			@endforeach
                              			

                              			@if($t_count==0)
                              				<?php $teach_rating=0;
                              				
                              				 ?>
              							@else
              							<?php $teach_rating= $teach_result/$t_count; 
              							$categ_total+=1; 
              							?>
              								<tr>
              								<td>Teaching</td>
              								<td><?php echo number_format((float)$teach_rating, 2, '.', '');  ?></td>
              								</tr>
              							@endif
              							
              						
              							<?php $pab_result=0; $pab_count=0;  ?>
				                        @foreach ($eval_results as $eval_result)

                              				@foreach($eval_sets as $eval_set)
				                         	@if($eval_result->eval_set_id== $eval_set->id)

				                         	@foreach($evaldetails as $detail)

				                            @if($eval_set->kpi_id == $detail->id && $detail->eval_categ_id==2)
				                            <?php $pab_result += $eval_result->score; 
				                            	$pab_count++;
				                            ?>
				                           
				                            @endif
				                    		@endforeach

				                         		
				                         	@endif
				                        	@endforeach		
                              					
                              			@endforeach
              							
              							@if($pab_count==0)
              								<?php $pab_rating=0;
              								  ?>
              							@else
              							<?php $pab_rating= $pab_result/$pab_count;
              								$categ_total+=1; 
              							 ?>
              							<tr>
              							<td>
              								Personal Attitude and Behavior
              							</td>
              							<td>
              								<?php echo number_format((float)$pab_rating, 2, '.', '');  ?></td>
              							
              								</tr>
              							@endif
              						

              						<?php $oi_result=0; $oi_count=0;  ?>
				                        @foreach ($eval_results as $eval_result)

                              				@foreach($eval_sets as $eval_set)
				                         	@if($eval_result->eval_set_id== $eval_set->id)

				                         	@foreach($evaldetails as $detail)

				                            @if($eval_set->kpi_id == $detail->id && $detail->eval_categ_id==3)
				                            <?php $oi_result += $eval_result->score; 
				                            	$oi_count++;
				                            ?>
				                             
				                            @endif
				                    		@endforeach

				                         		
				                         	@endif
				                        	@endforeach		
                              					
                              			@endforeach
              							
              							@if($oi_count==0)
              								<?php $oi_rating=0;
              								?>
              							@else
              							<?php $oi_rating= $oi_result/$oi_count;
              							 $categ_total+=1;  ?>
              							<tr>
              							<td>
              								Other Involvements
              							</td>
              							<td>
              								<?php echo number_format((float)$oi_rating, 2, '.', '');  ?></td>
              								</td>
              								</tr>
              							@endif
              						
              						<tr>
              							<td class="text-right">Average Rating: 

              							</td>
              							<td><strong>
              								<?php
              								$ave= ($teach_rating + $pab_rating + $oi_rating)/$categ_total;
              								echo number_format((float)$ave, 2, '.', '');
              								
              								?>

                               @if($ave >= 1 && $ave<2)
                                {{' (Needs Improvement)'}}
                              @elseif($ave>=2 && $ave<3)
                                {{' (Fair)'}}
                              @elseif($ave>=3 && $ave<4)
                                {{' (Satisfactory)'}}
                              @elseif($ave>=4 && $ave<5)   
                                {{' (Very Satisfactory)'}}
                              @elseif($ave==5)
                                {{' (Outstanding)'}}
                              @endif
              									</strong>
              								</td>
              						</tr>
              					</tbody>
              				</table>
              			</div>
              		</div>
                 <?php $teach_count=0; ?>
                  @foreach($eval_sets as $eval_set)
                    @foreach($evaldetails as $detail)

                            @if($eval_set->kpi_id == $detail->id && $detail->eval_categ_id==1)
                              <?php $teach_count ++; ?>
                            @endif
                    @endforeach

                  @endforeach

                  <?php $non_teaching=0; ?>
                 
                      @foreach($positions as $position)
                        @if($service_records->pos_id == $position->id)
                          
                              @if ($position->categ_id == 2)
                                
                                  <?php $non_teaching++; ?>
                              @endif
                       
                        @endif
                      @endforeach
                

                  @if($teach_count>0 && $non_teaching == 0)
                  <div class="row">
                  <div class=" col-sm-12">
                    <h4>TEACHING</h4>
                  </div>
                  </div>
                  <table class="table table-bordered">
                    <thead class="bg-info">
                      <th >Key Performance Indicators (KPIs)</th>
                      <th class="text-center">1</th>
                      <th class="text-center">2</th>
                      <th class="text-center">3</th>
                      <th class="text-center">4</th>
                      <th class="text-center">5</th>
                    </thead>
                    <tbody>
                      @foreach($eval_sets as $eval_set)
                      <tr>   
                          @foreach($evaldetails as $detail)

                            @if($eval_set->kpi_id == $detail->id && $detail->eval_categ_id==1)

                            
                              <td width="70%">
                              {{ $detail->kpi}}
                              </td>

                              <td>
                              	<input type="radio" class="form-control" name="teach-kpi-[{{$detail->id}}]" value="1" required disabled
                              	<?php foreach ($eval_results as $eval_result) {
                              		if($eval_result->eval_set_id== $eval_set->id){
                              			if($eval_result->score == 1){
                              			echo "checked";
                              		}
                              		}
                              	}?>
                              	>
                              </td>
                              <td>
                              	<input type="radio" class="form-control" name="teach-kpi-[{{$detail->id}}]" value="2" required disabled
                              	<?php foreach ($eval_results as $eval_result) {
                              		if($eval_result->eval_set_id== $eval_set->id){
                              			if($eval_result->score == 2){
                              			echo "checked";
                              		}
                              		}
                              	}?>
                              	>
                              </td>
                              <td>
                              	<input type="radio" class="form-control" name="teach-kpi-[{{$detail->id}}]" value="3" required disabled
                              	<?php foreach ($eval_results as $eval_result) {
                              		if($eval_result->eval_set_id== $eval_set->id){
                              			if($eval_result->score == 3){
                              			echo "checked";
                              		}
                              		}
                              	}?>
                              	>
                              </td>
                              <td>
                              	<input type="radio" class="form-control" name="teach-kpi-[{{$detail->id}}]" value="4" required disabled
                              	<?php foreach ($eval_results as $eval_result) {
                              		if($eval_result->eval_set_id== $eval_set->id){
                              			if($eval_result->score == 4){
                              			echo "checked";
                              		}
                              		}
                              	}?>
                              	>
                              </td>
                              <td>
                              	<input type="radio" class="form-control" name="teach-kpi-[{{$detail->id}}]" value="5" required disabled
                              	<?php foreach ($eval_results as $eval_result) {
                              		if($eval_result->eval_set_id== $eval_set->id){
                              			if($eval_result->score == 5){
                              			echo "checked";
                              		}
                              		}
                              	}?>
                              	>
                              </td>

                            
                              
                            @endif
                          @endforeach
                      </tr>
                      @endforeach
                    </tbody>
                    
                  </table>
                  @endif

                 
                  <?php $pab_count=0; ?>
                  @foreach($eval_sets as $eval_set)
                    @foreach($evaldetails as $detail)

                            @if($eval_set->kpi_id == $detail->id && $detail->eval_categ_id==2)
                              <?php $pab_count ++; ?>
                            @endif
                    @endforeach

                  @endforeach
                  @if($pab_count>0)
                   <br>
                  <div class="row">
                  <div class="col-sm-12">
                    <h4>PROFESSIONAL ATTITUDE AND BEHAVIOR</h4>
                  </div>
                  </div>
                  <table class="table table-bordered">
                    <thead class="bg-info"><strong>
                      <th  width="70%">Key Performance Indicators (KPIs)</th>
                      <th class="text-center">1</th>
                      <th class="text-center">2</th>
                      <th class="text-center">3</th>
                      <th class="text-center">4</th>
                      <th class="text-center">5</th></strong>
                    </thead>
                    <tbody>
                      @foreach($eval_sets as $eval_set)
                      <tr>   
                          @foreach($evaldetails as $detail)

                            @if($eval_set->kpi_id == $detail->id && $detail->eval_categ_id==2)
                              <td width="70%">
                              {{ $detail->kpi}}
                              </td>

                              <td>
                              	<input type="radio" class="form-control" name="pab-kpi-[{{$detail->id}}]" value="1" required
                              	disabled
                              	<?php foreach ($eval_results as $eval_result) {
                              		if($eval_result->eval_set_id== $eval_set->id){
                              			if($eval_result->score == 1){
                              			echo "checked";
                              		}
                              		}
                              	}?>
                              	>
                              </td>
                              <td>
                              	<input type="radio" class="form-control" name="pab-kpi-[{{$detail->id}}]" value="2" required
                              	disabled
                              	<?php foreach ($eval_results as $eval_result) {
                              		if($eval_result->eval_set_id== $eval_set->id){
                              			if($eval_result->score == 2){
                              			echo "checked";
                              		}
                              		}
                              	}?>
                              	>
                              </td>
                              <td>
                              	<input type="radio" class="form-control" name="pab-kpi-[{{$detail->id}}]" value="3" required
                              	disabled
                              	<?php foreach ($eval_results as $eval_result) {
                              		if($eval_result->eval_set_id== $eval_set->id){
                              			if($eval_result->score == 3){
                              			echo "checked";
                              		}
                              		}
                              	}?>
                              	>
                              </td>
                              <td>
                              	<input type="radio" class="form-control" name="pab-kpi-[{{$detail->id}}]" value="4" required
                              	disabled
                              	<?php foreach ($eval_results as $eval_result) {
                              		if($eval_result->eval_set_id== $eval_set->id){
                              			if($eval_result->score == 4){
                              			echo "checked";
                              		}
                              		}
                              	}?>
                              	>
                              </td>
                              <td>
                              	<input type="radio" class="form-control" name="pab-kpi-[{{$detail->id}}]" value="5" required 
                              	disabled
                              	<?php foreach ($eval_results as $eval_result) {
                              		if($eval_result->eval_set_id== $eval_set->id){
                              			if($eval_result->score == 5){
                              			echo "checked";
                              		}
                              		}
                              	}?>
                              	>
                              </td>

                              
                            @endif
                          @endforeach
                      </tr>
                      @endforeach
                    </tbody>
                    
                  </table>
                  @endif



                  <?php $oi_count=0; ?>
                  @foreach($eval_sets as $eval_set)
                    @foreach($evaldetails as $detail)

                            @if($eval_set->kpi_id == $detail->id && $detail->eval_categ_id==3)
                              <?php $oi_count ++; ?>
                            @endif
                    @endforeach

                  @endforeach
                  @if($oi_count>0)

                  <div class="row">
                  <div class="col-sm-12">
                    <h4 class="text-primary">OTHER INVOLVEMENTS</h4>
                  </div>
                  </div>
                  <table class="table table-bordered">
                    <thead class="bg-info"><strong>
                      <th class="" width="70%">Key Performance Indicators (KPIs)</th>
                      <th class="text-center">1</th>
                      <th class="text-center">2</th>
                      <th class="text-center">3</th>
                      <th class="text-center">4</th>
                      <th class="text-center">5</th></strong>
                    </thead>
                    <tbody>
                      @foreach($eval_sets as $eval_set)
                      <tr>   
                          @foreach($evaldetails as $detail)

                            @if($eval_set->kpi_id == $detail->id && $detail->eval_categ_id==3)
                              <td width="70%">
                              {{ $detail->kpi}}
                              </td>

                              <td>
                              	<input type="radio" class="form-control" name="other-kpi-[{{$detail->id}}]" value="1" required
                              	disabled
                              	<?php foreach ($eval_results as $eval_result) {
                              		if($eval_result->eval_set_id== $eval_set->id){
                              			if($eval_result->score == 1){
                              			echo "checked";
                              		}
                              		}
                              	}?>
                              	>
                              </td>
                              <td>
                              	<input type="radio" class="form-control" name="other-kpi-[{{$detail->id}}]" value="2" required
                              	disabled
                              	<?php foreach ($eval_results as $eval_result) {
                              		if($eval_result->eval_set_id== $eval_set->id){
                              			if($eval_result->score == 2){
                              			echo "checked";
                              		}
                              		}
                              	}?>
                              	>
                              </td>
                              <td>
                              	<input type="radio" class="form-control" name="other-kpi-[{{$detail->id}}]" value="3" required
                              	disabled
                              	<?php foreach ($eval_results as $eval_result) {
                              		if($eval_result->eval_set_id== $eval_set->id){
                              			if($eval_result->score == 3){
                              			echo "checked";
                              		}
                              		}
                              	}?>
                              	>
                              </td>
                              <td>
                              	<input type="radio" class="form-control" name="other-kpi-[{{$detail->id}}]" value="4" required 
                              	disabled
                              	<?php foreach ($eval_results as $eval_result) {
                              		if($eval_result->eval_set_id== $eval_set->id){
                              			if($eval_result->score == 4){
                              			echo "checked";
                              		}
                              		}
                              	}?>
                              	>
                              </td>
                              <td>
                              	<input type="radio" class="form-control" name="other-kpi-[{{$detail->id}}]" value="5" required 
                              	disabled
                              	<?php foreach ($eval_results as $eval_result) {
                              		if($eval_result->eval_set_id== $eval_set->id){
                              			if($eval_result->score == 5){
                              			echo "checked";
                              		}
                              		}
                              	}?>
                              	>
                              </td>
                              
                            @endif
                          @endforeach
                      </tr>
                      @endforeach
                    </tbody>
                    
                  </table>
                  @endif
                
                
                  
                </div>
                  
                </div>
                
              </div>
            </div>
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

@endsection

 