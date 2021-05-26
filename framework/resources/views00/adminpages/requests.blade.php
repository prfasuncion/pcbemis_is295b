@extends('layouts.adminapp', ['activePage' => 'request', 'titlePage' => __('Document Requests')])

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
            <div class="card-header card-header-tabs card-header-primary">
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                    Requests
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="tab-content">
            

                <div class="tab-pane active" id="messages">
                 
                  
                  <table class="table tablemanager" id="educbg">
                  	 <thead class=" text-primary">
                  	 	 <th>Employee</th>
                  	     <th>Document Requested</th>
                  	     <th>Purpose</th>
                         <th>Date Requested</th>
                         <th>Status/Remarks</th>
                         <th>Action</th>

                      </thead>
                      <tbody>
                      	@foreach($document_requests as $doc_req)
                      	<tr>
                      		<td>
                      			@foreach($userprofile as $user)
                      				@if($doc_req->user_id== $user->id)
                      					{{$user->user->lname.', '.$user->user->fname.' '.$user->user->name_ext}}
                      				@endif
                      			@endforeach
                      		</td>
                      		<td>{{$doc_req->document}}</td>
                      		<td>{{$doc_req->purpose}}</td>
                      		<td>
                      			<?php echo date('F d, Y H:i', strtotime($doc_req->created_at))?>
                      		</td>
                      		<td>
                      			@if($doc_req->status==1)
                      		
                            {{$doc_req->remarks}}
                      			@elseif($doc_req->status==2)
                      			Document is released on
                      			<?php echo date('F d, Y', strtotime($doc_req->updated_at))?>
                      			@endif
                      		</td>
                      		<td>
                      			@if($doc_req->status==1)
                      			<a href="" class="btn btn-sm btn-success" title="Request Completed!" data-toggle="modal" data-target=".release-{{$doc_req->id}}"><i class="material-icons"></i>Release</a>
                      			@elseif($doc_req->status==2)

                      			@else
                      			<a href="" class="btn btn-sm btn-success" title="Mark as Request Ready!" data-toggle="modal" data-target=".req_ok-{{$doc_req->id}}"><i class="material-icons">done_outline</i></a>
                      			<!-- <a href="" class="btn btn-sm btn-info"><i class="material-icons">print</i></a> -->
                      			@endif
                      		</td>

                      	<div class="modal fade req_ok-{{$doc_req->id}}" tabindex="-1" id="mymodal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Mark Request as Completed</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                               <div class="modal-body">
                              <form  method="post" action="{{route('req.doc_ready',  [$id= Crypt::encrypt($doc_req->id), $emp_id=Crypt::encrypt($doc_req->user_id)])}}">
                                 @csrf
                                 @method('post')
                                <div class="form-group">
                                <label>Remarks</label>
                                <textarea class="form-control" name="remarks" required width="100%" row=3>{{'Document is ready, please claim it at the Admin Office.'}}</textarea>
                            	</div><br>
                                <p>By clicking save the request will be marked completed and for release.</p>
                                
    
                               
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-success btned">Save</button>
                              </form>
                            </div>
                          </div>
                        </div>
          				</div>


          				<div class="modal fade release-{{$doc_req->id}}" tabindex="-1" id="mymodal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Release Document</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                               <div class="modal-body">
                              <form  method="post" action="{{route('req.doc_release',  [$id= Crypt::encrypt($doc_req->id), $emp_id=Crypt::encrypt($doc_req->user_id)])}}">
                                 @csrf
                                 @method('post')
                                
                                <p>By clicking Release the request will be marked completed and released.</p>
                                
    
                               
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-success btned">release</button>
                              </form>
                            </div>
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
<script type="text/javascript">
  setInterval(function() {
                  window.location.reload();
                }, 30000); 

</script>
<script type="text/javascript" src="{{ asset('material') }}/js/tableManager.js"></script>
<script type="text/javascript">
    // basic usage
    $('.tablemanager').tablemanager({
      firstSort: [[4,'desc']],
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

  document.getElementById("rem").defaultValue = "Fifth Avenue, New York City";
</script>

@endsection
