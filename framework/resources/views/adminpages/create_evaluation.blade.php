@extends('layouts.adminapp', ['activePage' => 'evaluations', 'titlePage' => __('Evaluations')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-warning">
              <h4 class="card-title ">Create Evaluation</h4>
              <p class="card-category"></p>
            </div>
            <div class="card-body">
              <form action="{{route('evaluations.store')}}" method="post">
                @csrf
                @method('post')  
               @if (!empty($successmsg))
                   <div class="row" id="successMessage">
                    <div class="col-sm-12">
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>{{ $successmsg }}</span>
                      </div>
                    </div>
                  </div>   
               @endif
              <div class="row">
                <div class="col-12 text-right">

                  <a href="{{ url()->previous() }}" class="btn btn-sm btn-warning">Back</a>

                </div>
              </div>

              <div class="row">
             <!--    <div class="col-sm-12"> -->
                  <!-- <div class="col-sm-6">
                      <label class="col-form">Select Academic Year</label><br>
                      <select class="selectpicker form-control">
                      @foreach($acadyear as $year)
                        <option>{{$year->start_ay.'-'.$year->end_ay}}</option>
                      @endforeach
                      </select>
                  </div> -->
                  <div class="col-sm-12">
                      <label class="col-form">Select Academic Year and Semester </label><br>
                      <select class="selectpicker form-control " name="sem_selected">
                        <?php
                        $ay_id; $sem_id;

                        ?>
                      @foreach($acadyear as $year)
                        @foreach($year->ay_details as $sem)
                          @if($sem->name != 'Mid Year')
                            <?php $count_eval_exist=0; ?>
                            @foreach($evaluations as $evaluation)
                            @if($evaluation->sem_id == $sem->id)
                              <?php $count_eval_exist++; ?>
                            @endif
                            @endforeach

                            @if($count_eval_exist==0)
                             <option value="{{$sem->id}}">{{$year->start_ay.'-'.$year->end_ay.' '. $sem->name}}</option>
                            @endif
                          @endif
                        @endforeach
                       
                      @endforeach
                      </select>
                  </div>
          <!--       </div> -->
              </div>
              <div class="card-footer float-right">
                <div class="row">
                  <div class="float-right">
                    <button type="submit" class="btn btn-warning">Save</button>
                  </div>
                </div>
            </div>
             </form>
            </div>
          </div>
               
      </div>
    </div>
    <div class="row float-right">
                  <div class="col-sm-12 text-right">
                  
                  </div>
            </div>
  </div>
</div>
<script>
  setTimeout(function() {
    $('#successMessage').fadeOut('fast');
}, 5000); // <-- time in milliseconds
</script>
@endsection
