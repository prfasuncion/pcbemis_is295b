@extends('layouts.adminapp', ['activePage' => 'exitapp', 'titlePage' => __('Exit Application > Exit Interview')])

@section('content')
 @csrf
<div class="content" id="content">
  <div class="container-fluid">
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

      @csrf
      @method('post')
    <div class="row">
      <div class="col-lg-12 col-md-12">
          <div class="card" id="profcard">
            <div class="card-header card-header-tabs" style="background-color: gray; color: white;">
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                   <h4> Exit Interview: {{ $user->user->lname.', '.$user->user->fname.' '.$user->user->name_ext}}
                      <div class="float-right">
                        <a href="{{route('exit.view')}}" class="btn btn-sm btn-primary">Back</a>
                        <a href="{{route('exit.print_exit_interview', [$id= Crypt::encrypt($user->id)])}}" target="_blank" class="btn btn-sm btn-info">PRINT</a>
                      </div>
                   </h4>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane active" id="messages">
                  <div class="row">
                    <div class="col-sm-12">
                      <h4 class="text-primary">Before you begin your new journey outside the institution, please take time to asnwer this exit interview. </h4>

                    </div>
                    
                      <div class="col-sm-12">
                      <?php $count=0; ?>
                      @foreach($exit_answers as $answers)

                      @foreach($questions as $question)
                      @if($answers->question_id== $question->id)
                      <?php $count++; ?>
                      <div class="row">
                      <div class="col-sm-12">
                        <h5><strong>{{$count}}. {{$question->question}}</strong>
                        </h5>

                        <h6>Answer:</h6>
                        <div class="col-sm-12">{{$answers->answer}}</div>
                        <!-- <textarea class="form-control" width="100%" style="width: 100%;" rows="3" placeholder="Type your answer here." name="answer[{{$question->id}}]" required></textarea> -->
                      <!--   <input type="text" hidden name="quest_id[]" value="{{$question->id}}"> -->
                      </div>
                    </div>
                      <br>
                      @endif
                      @endforeach

                      @endforeach
                    </div>
                  </div>

                </div>
                
              </div>
            </div>
            <div class="card-footer">
              <div class="col-sm-12">
             
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
      appendFilterby: false,
      dateFormat: [[4,"mm-dd-yyyy"]],
      debug: true,
      vocabulary: {
    voc_filter_by: 'Filter By',
    // voc_type_here_filter: 'Search...',
    // voc_show_rows: '  Rows'
  },
      pagination: true,
      // showrows: [5,10,15,20],
      disableFilterBy: [7]
    });

    
    // $('.table').tablemanager();
  </script>

@endsection

 