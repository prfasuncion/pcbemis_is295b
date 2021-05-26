@extends('layouts.adminapp', ['activePage' => 'exitapp', 'titlePage' => __('Exit Application')])

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
    <div class="row">
      <div class="col-lg-12 col-md-12">
          <div class="card" id="profcard">
            <div class="card-header card-header-tabs" style="background-color: gray; color: white;">
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                    <h4 class="card-title ">Exit Interview Questions</h4>
                    <p class="card-category">Here you can manage exit interview questions</p>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-sm-12">
                  <div class="float-right">
                    <a class="btn btn-sm btn-dark" href="{{route('exit.view')}}" style="color: white;">BACK</a>
                  <a class="btn btn-sm btn-primary" style="color: white;" data-toggle="modal" data-target=".add_question">ADD</a>
                  </div>
                  <div class="modal fade add_question" tabindex="-1" id="mymodal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <form action="{{route('exit.store')}}" method="">
                              @csrf
                              @method('post')
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add New Question</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                              <label class="form-label">Question</label>
                              <textarea class="form-control" placeholder="Type your question here" rows="5" name="question" required></textarea> 
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-success" style="color:white;">Submit</button>
                              
                            </div>
                          </form>
                          </div>
                        </div>
                   </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="table-responsive">
                    <table class="table tablemanager">                
                      <thead>
                        <th>Question</th>
                        <th class="td-action text-right">Action</th>
                      </thead>
                      <tbody>
                        @foreach($questions as $question)
                        <tr>
                          <td>{{$question->question}}</td>
                          <td class="td-action text-right">
                            <a href="" class="btn btn-sm btn-warning" data-toggle="modal" data-target=".edit_question-{{$question->id}}"><i class="material-icons">edit</i></a>
                            <a href="" class="btn btn-sm btn-danger"
                            data-toggle="modal" data-target=".delete_question-{{$question->id}}"
                            ><i class="material-icons">delete</i></a>
                          </td>

                          <div class="modal fade edit_question-{{$question->id}}" tabindex="-1" id="mymodal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <form action="{{route('exit.update', $question->id)}}" method="">
                                      @csrf
                                      @method('post')
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Question</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="form-group">
                                      <div class="modal-body">
                                      <label class="form-label">Question</label>
                                      <textarea class="form-control" placeholder="Type your question here" rows="5" name="question">{{$question->question}}</textarea>
                                    </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <button type="submit" class="btn btn-success" style="color:white;">Submit</button>
                                      
                                    </div>
                                  </form>
                                  </div>
                                </div>
                           </div>

                           <div class="modal fade delete_question-{{$question->id}}" tabindex="-1" id="mymodal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <form action="{{route('exit.delete', $question->id)}}" method="">
                                      @csrf
                                      @method('post')
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Delete Question</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="form-group">
                                      <div class="modal-body">
                                        <p>Are you sure you want to delete this question?</p>
                                      <label class="form-label">Question</label>
                                      <textarea class="form-control" placeholder="Type your question here" rows="5" name="question" readonly>{{$question->question}}</textarea>
                                    </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <button type="submit" class="btn btn-success" style="color:white;">Submit</button>
                                      
                                    </div>
                                  </form>
                                  </div>
                                </div>
                           </div>
                        </tr>
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
</div>

<script type="text/javascript" src="{{ asset('material') }}/js/tableManager.js"></script>
<script type="text/javascript">
    // basic usage
    $('.tablemanager').tablemanager({
      firstSort: [[2,'desc']],
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
      disableFilterBy: [2]
    });
    // $('.tablemanager').tablemanager();
  </script>
  <script>
  setTimeout(function() {
    $('#successMessage').fadeOut('fast');
}, 5000); // <-- time in milliseconds
</script>
@endsection
