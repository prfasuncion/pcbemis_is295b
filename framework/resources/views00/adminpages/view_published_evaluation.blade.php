@extends('layouts.adminapp', ['activePage' => 'evaluations', 'titlePage' => __('Evaluations')])

@section('content')
 @csrf
<div class="content" id="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
      <h4> 
          @foreach($acadyear as $year)
              @foreach($year->ay_details as $sem_details)
                  @if($evaluation->sem_id == $sem_details->id)
                    {{$sem_details->name.' '.$year->start_ay.'-'.$year->end_ay}}
                  @endif
              @endforeach
          @endforeach
          Evaluation
      </h4>
      </div>
      @foreach($departments as $department)
      <div class="col-sm-4" >
      <div class="card bg-info" style="height: 230px; max-height: 230px;">
        <div class="card-header bg-primary">
        
          <h3>
            <?php $count_total=0; ?>
            @foreach ( $employees_in_dept as $emp_dept)
                @if($emp_dept->dept_id == $department->id)
                  <?php $count_total++; ?>
                @endif
            @endforeach
            <!-- 0/{{$count_total}} -->
           <!--  <h4> --> {{ $department->code}}<!-- </h4> -->
            <a class="btn btn-primary pull-right" href="{{route('evaluation.department_evaluation',  [$id= Crypt::encrypt($eval_id), $dept_id = Crypt::encrypt($department->id)])}}"><i class="material-icons">visibility</i> View</a></h3>
        
        </div>
        <div class="card-body">
         
         <p>{{$department->name}}</p>
        </div>
        <div class="card-footer">
          
        </div>
        
      </div>
      </div>
      @endforeach
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

 