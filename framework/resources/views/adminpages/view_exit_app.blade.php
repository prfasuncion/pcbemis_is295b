@extends('layouts.adminapp', ['activePage' => 'exitapp', 'titlePage' => __('Exit Application')])

@section('content')
 @csrf
<div class="content" id="content">
  <div class="container-fluid">
                @if($tasks != null)
                    <div class="col-sm-12">
                      <div class="alert alert-danger">
                        <div class="row">
                        <div class="col-sm-6">
                          <div class="float-left">
                            <h5>WITH PENDING TASK!</h5>
                          </div>
                          
                        </div>
                        <div class="col-sm-6">
                          <div class="float-right">
                            <a class="btn btn-sm btn-dark" href="{{route('exit.view')}}">Back</a>

                        <a class="btn btn-sm btn-info" href="{{route('tasks.index')}}">Go to Tasks</a>
                          </div>
                        </div>
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
                    <h4 class="card-title ">Exit Application
                      <div class="float-right">
                      <a href="{{route('exit.view')}}" class="btn btn-sm btn-primary">Back</a>
                      <a href="{{route('exit.print_application', [$id= Crypt::encrypt($exit_applicant->id)])}}" target="_blank" class="btn btn-sm btn-info">Print</a>
                      </div>
                    </h4>
                    
                </div>
              </div>
            </div>
            <div class="card-body">
              
             

                 <div class="row">
                  <div class="col-sm-12">
                    
                    {!!$exit_applicant->letter!!}
               
                  </div>
                  
                  <div class="col-sm-12">
                    <br><br>
                   <h5> Sincerely yours, </h5>
                    <br>
                    <h5>
                    {{$user->user->fname}}
                    {{$user->user->lname}}
                    {{$user->user->name_ext}}
                  </h5>
                  </div>
                   
                 </div>
            </div>
            
          </div>
          <div class="row">
            <div class="col-sm-12">   
              <div class="float-right">
                @if($tasks == null && $exit_applicant->status != 2)
                <a class="btn btn-success btn-lg" data-toggle="modal" data-target=".approve" style="color: white;">Approve EXIT APPLICATION</a>
                @endif

                <div class="modal fade approve" tabindex="-1" id="mymodal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <form action="{{route('exit.approve', $exit_applicant->id)}}" method="">
                                      @csrf
                                      @method('post')
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Approve Exit Application</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="form-group">
                                      <div class="modal-body">
                                      <p>Are you sure you want to approve the exit application of 
                                       <strong>
                                        {{$user->user->fname}}
                                        {{$user->user->lname}}
                                        {{$user->user->name_ext}}
                                      </strong>
                                      </p>
                                    </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                      <button type="submit" class="btn btn-success" style="color:white;">Approve</button>
                                      
                                    </div>
                                  </form>
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
      disableFilterBy: [3]
    });
    // $('.tablemanager').tablemanager();
  </script>

@endsection

 