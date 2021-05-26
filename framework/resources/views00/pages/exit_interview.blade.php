@extends('layouts.app', ['activePage' => 'exitapp', 'titlePage' => __('Exit Application')])

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
    <form action="{{route('exit.take_save')}}" method="post">
      @csrf
      @method('post')
    <div class="row">
      <div class="col-lg-12 col-md-12">
          <div class="card" id="profcard">
            <div class="card-header card-header-tabs" style="background-color: gray; color: white;">
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                    Exit Interview
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
                      @foreach($questions as $question)
                      <?php $count++; ?>
                      <div class="row">
                      <div class="col-sm-12">
                        <h5><strong>{{$count}}. {{$question->question}}</strong>
                        </h5>
                        <textarea class="form-control" width="100%" style="width: 100%;" rows="3" placeholder="Type your answer here." name="answer[{{$question->id}}]" required></textarea>
                      <!--   <input type="text" hidden name="quest_id[]" value="{{$question->id}}"> -->
                      </div>
                    </div>
                      <br>
                      @endforeach
                    </div>
                  </div>

                </div>
                
              </div>
            </div>
            <div class="card-footer">
              <div class="col-sm-12">
              <div class="float-right">
                <a href="" data-toggle="modal" data-target=".submit_exit" class="btn btn-success btn-lg">SUBMIT</a>

                <div class="modal fade submit_exit" tabindex="-1" id="mymodal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                               
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Submit Exit Interview</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="form-group">
                                      <div class="modal-body">
                                      You are about to save your exit interview answers. 

                                      <h4><strong>After submitting you will be logged out of this website and user access will be suspended!.<strong></strong>

                                      <h3>Thank you for becoming part of our family!</h3>

                                    </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <button type="submit" class="btn btn-success" style="color:white;">Submit</button>
                                      
                                    </div>
                             
                                  </div>
                                </div>
                           </div>
              </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    </form>

  


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

 