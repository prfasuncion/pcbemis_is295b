@extends('layouts.app', ['activePage' => 'evaluation', 'titlePage' => __('My Evaluations')])

@section('content')
 @csrf
<div class="content" id="content">
  <div class="container-fluid">
    <div class="row">
      @if (Session::has('success'))
                   <div class="row" id="successMessage">
                    <div class="col-sm-12">
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>{{ session('success') }}</span>
                      </div>
                    </div>
                  </div>   
               @endif
      <div class="col-lg-12 col-md-12">
          <div class="card" id="profcard">
            <div class="card-header card-header-tabs card-header-warning">
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                    Evaluations
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="tab-content">
                

                <div class="tab-pane active" id="messages">
                  <div class="row">
                  <div class="col-sm-6">
                
                  </div>
                  <div class="col-sm-6">
                    
                  </div>
                  </div>
                  
                  <table class="table tablemanager" id="educbg">
                  	<thead class=" text-primary">
                  	   <th>Evaluation</th>
                       <th class="td-action text-right">Action</th>   
                    </thead>
                    <tbody>
                       @foreach($evaluations as $evaluation)
                       @if($evaluation->status==1)
                        <tr>
                        <td>
                            @foreach($acadyear as $year)
                              @foreach($year->ay_details as $sem_details)
                                @if($evaluation->sem_id == $sem_details->id)
                                  {{$sem_details->name.' '.$year->start_ay.'-'.$year->end_ay}}
                                @endif
                              @endforeach
                            @endforeach
                        </td>
                        <td class="td-action text-right">
                          <?php $head=0; $depmt_id;?>
                          @foreach($designations as $designation)
                            @if(isset($designation->dept_id_head))
                              @foreach($desig_records as $records)
                           
                                @if($designation->id == $records->desig_id && (!isset($records->until)))
                                    <?php $head=1; $depmt_id=$designation->dept_id_head; ?>
                                @endif
                              @endforeach
                            @endif
                          @endforeach
                          @if ($head ==1)

                        
                          <a rel="tooltip" class="btn btn-success " href="{{route('usereval.evaluations', [$id= Crypt::encrypt($evaluation->id), $dept_id = Crypt::encrypt($depmt_id)])}}" data-original-title="" title="" >
                          
                              <i class="material-icons">visibility</i> VIEW
                              <div class="ripple-container"></div>
                            </a>

                          @else
                            @if(isset($evaluation->released))
                                  <!-- <?php $result_exist=0; ?>
                                  @foreach($eval_results as $result)
                                    @if($result->user_id == $user_id)
                                      <?php $result_exist++; ?>
                                    @else
                                      <?php $result_exist=0; ?>
                                    @endif
                                  @endforeach
 -->
                            <?php $result_exist=0; ?>
                            @foreach($eval_results as $result)
                              @foreach($eval_sets as $set)
                                @if($result->eval_set_id == $set->id && $set->eval_id == $evaluation->id)
                                @if($result->user_id == $user_id)
                                  <?php $result_exist++; ?>
                                @endif
                                @endif

                              @endforeach
                            @endforeach  

                                  @if($result_exist > 0)
                                  <a rel="tooltip" class="btn btn-sm btn-success " href="{{route('usereval.evaluation_myresult', [$id= Crypt::encrypt($evaluation->id)])}}" data-original-title="" title="" >
                                  
                                      <i class="material-icons">visibility</i> View
                                      <div class="ripple-container"></div>
                                    </a>
                                    @else
                                      <p>Not yet available</p>
                                    @endif
                              @else
                              <p>Not yet available</p>
                            @endif
                          @endif

                        </td>
                      </tr>
                      @endif
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
  <script>
  setTimeout(function() {
    $('#successMessage').fadeOut('fast');
}, 5000); // <-- time in milliseconds
</script>

@endsection

 