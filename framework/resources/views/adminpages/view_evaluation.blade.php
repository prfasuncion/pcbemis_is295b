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
                                  {{$sem_details->name.' '.$year->start_ay.'-'.$year->end_ay}}
                                @endif
                              @endforeach
                            @endforeach
                </div>
              </div>
            </div>

            <div class="card-body">
              <div class="row float-right">
                    <div class="col-sm-12 ">
                       <a href="{{ route('evaluations.index') }}" class="btn btn-sm btn-warning">Back</a>
                        <a href="{{ route('evaluations.index') }}" class="btn btn-sm btn-success">PUBLISH</a>
                    </div>
                  </div>
                  <br>
               
              <div class="tab-content">

                <div class="tab-pane active" id="messages">
                  
              
                  <?php $teach_count=0; ?>
                  @foreach($eval_sets as $eval_set)
                    @foreach($evaldetails as $detail)

                            @if($eval_set->kpi_id == $detail->id && $detail->eval_categ_id==1)
                              <?php $teach_count ++; ?>
                            @endif
                    @endforeach

                  @endforeach
                  @if($teach_count>0)
                  <div class="row">
                  <div class="">
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

                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              
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

                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              
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
                    <h4>OTHER INVOLVEMENTS</h4>
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

                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              
                            @endif
                          @endforeach
                      </tr>
                      @endforeach
                    </tbody>
                    
                  </table>
                  @endif
                  
                <!--   <table class="table tablemanager" id="educbg">
                  	 <thead class=" text-primary">
                  	  
                      </thead>
                    
                  </table> -->
                  
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

 