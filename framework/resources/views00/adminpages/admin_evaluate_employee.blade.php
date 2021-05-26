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
                                  {{$sem_details->name.' '.$year->start_ay.'-'.$year->end_ay.' Evaluation'}}
                                @endif
                              @endforeach
                            @endforeach
                </div>
              </div>
            </div>
            <form class="" method="post" action="{{route('evaluation.admin_save_evaluation', [$id= Crypt::encrypt($eval_id), $emp_id=Crypt::encrypt($employee->id)])}}">
            	@csrf
            	@method('post')
            <div class="card-body">
              <div class="row float-right">
                    <div class="col-sm-12 ">
                       <a href="{{ url()->previous() }}" class="btn btn-sm btn-warning">Back</a>
                        
                    </div>
                  </div>
                  <br>
               
              <div class="tab-content">

                <div class="tab-pane active" id="messages">
                  
              	<div class="row">
              		
              			<h5>
              			@if(!isset($employee->image))
                           <img class="card-img-top ml-auto mr-auto " src='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSQJxKGGpPc9-5g25KWwnsCCy9O_dlS4HWo5A&usqp=CAU'  id="img" style="height: 150px; width: 150px; max-height: 150px; border-radius: 50%; "> 
                            @else
                            <img class="card-img-top ml-auto mr-auto " src="<?php echo asset( $employee->image); ?>"  id="img" style="height: 150px; width: 150px; max-height: 150px; border-radius: 50%; ">
                            @endif
              			 <strong><u>{{$employee->user->lname.', '.$employee->user->fname}}</strong></u>
              			</h5>

              		
              	</div>
              	<div class="row">
              		<div class="col-sm-12">
              			<strong>Direction:</strong> this questionnaire seeks your objective and honest evaluation of the ratee’s performance. Please indicate your rating on the different items by clicking on the button corresponding to your rating, using the scale below:
              			
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
                  @foreach($service_records as $records)

                    @if(!isset($records->end))
                      @foreach($positions as $position)
                        @if($records->pos_id == $position->id)
                          @foreach ($category as $categ)
                              @if ($position->categ_id == $categ->id)
                              
                                  <?php $non_teaching++; ?>
                              @endif
                          @endforeach
                        @endif
                      @endforeach
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
                              	<input type="radio" class="form-control" name="teach-kpi-[{{$detail->id}}]" value="1" required>
                              </td>
                              <td>
                              	<input type="radio" class="form-control" name="teach-kpi-[{{$detail->id}}]" value="2" required>
                              </td>
                              <td>
                              	<input type="radio" class="form-control" name="teach-kpi-[{{$detail->id}}]" value="3" required>
                              </td>
                              <td>
                              	<input type="radio" class="form-control" name="teach-kpi-[{{$detail->id}}]" value="4" required>
                              </td>
                              <td>
                              	<input type="radio" class="form-control" name="teach-kpi-[{{$detail->id}}]" value="5" required>
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
                              	<input type="radio" class="form-control" name="pab-kpi-[{{$detail->id}}]" value="1" required>
                              </td>
                              <td>
                              	<input type="radio" class="form-control" name="pab-kpi-[{{$detail->id}}]" value="2" required>
                              </td>
                              <td>
                              	<input type="radio" class="form-control" name="pab-kpi-[{{$detail->id}}]" value="3" required>
                              </td>
                              <td>
                              	<input type="radio" class="form-control" name="pab-kpi-[{{$detail->id}}]" value="4" required>
                              </td>
                              <td>
                              	<input type="radio" class="form-control" name="pab-kpi-[{{$detail->id}}]" value="5" required>
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
                              	<input type="radio" class="form-control" name="other-kpi-[{{$detail->id}}]" value="1" required>
                              </td>
                              <td>
                              	<input type="radio" class="form-control" name="other-kpi-[{{$detail->id}}]" value="2" required>
                              </td>
                              <td>
                              	<input type="radio" class="form-control" name="other-kpi-[{{$detail->id}}]" value="3" required>
                              </td>
                              <td>
                              	<input type="radio" class="form-control" name="other-kpi-[{{$detail->id}}]" value="4" required>
                              </td>
                              <td>
                              	<input type="radio" class="form-control" name="other-kpi-[{{$detail->id}}]" value="5" required>
                              </td>
                              
                            @endif
                          @endforeach
                      </tr>
                      @endforeach
                    </tbody>
                    
                  </table>
                  @endif
                
                
                  
                </div>
                <div class="card-footer float-right">
                <div class="row ">
                
                		<button type="submit" class="btn btn-success">SAVE AND FINISH EVALUATION</button>
               
                </div>
            	</div>
            	</form>
                
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

 