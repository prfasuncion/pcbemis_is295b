@extends('layouts.app', ['activePage' => 'request', 'titlePage' => __('Service Record and Document Requests')])

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

      <div class="col-sm-6">
        <div class="card bg-warning">
          <div class="card-header"><h4>Request for Service Record</h4></div>
          <div class="card-body">
            <p>A certified service record document will be issued upon approval.</p>
            <div class="float-right">
            <a class="btn btn-primary btn-sm" data-toggle="modal" data-target=".service_record">Request</a>
          </div>
          </div>
        </div>
      </div>

          <div class="modal fade service_record" tabindex="-1" id="mymodal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Request Service Record</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                               <div class="modal-body">
                              <form  method="post" action="{{route('req.create')}}">
                                 @csrf
                                 @method('post')
                                 <p>Purpose</p>
                                <label>Please provide the purpose for requesting Service Record</label>
                                <textarea class="form-control" name="purpose" required></textarea>
                                <p>A request for <strong>certified service record</strong> will be created by clicking 'request</p>
                                <input type="text" hidden name="document" value="Service Record">
    
                               
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-warning btned">Request</button>
                              </form>
                            </div>
                          </div>
                        </div>
          </div>

          <div class="modal fade employment_cert" tabindex="-1" id="mymodal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Request Certificate of Employment</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                               <div class="modal-body">
                              <form  method="post" action="{{route('req.create')}}">
                                 @csrf
                                 @method('post')
                                <p>Purpose</p>
                                <label>Please provide the purpose for requesting Employment Certificate</label>
                                <textarea class="form-control" name="purpose" required></textarea>
                                <p>A request for <strong>Employment Certificate</strong> will be created by clicking 'request</p>
                                
                                 <input type="text" hidden name="document" value="Employment Certificate">
                               
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-success btned">Request</button>
                              </form>
                            </div>
                          </div>
                        </div>
          </div>

      <div class="col-sm-6">
        <div class="card bg-success">
          <div class="card-header"><h4>Request for Employment Certificate</h4></div>
          <div class="card-body">
            <p>An employment certification will be issued upon request approval.</p>
            <div class="float-right">
            <a class="btn btn-primary btn-sm" data-toggle="modal" data-target=".employment_cert">Request</a>
          </div>
          </div>
        
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 col-md-12">
          <div class="card" id="profcard">
            <div class="card-header card-header-tabs card-header-info">
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                    Service Record
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
                  
                  <table class="table " id="">
                     <thead class=" text-primary">
                          <th>Position</th>
                          <th>Category</th>
                          <th>From</th>
                          <th>To</th>
                      </thead>
                      <tbody>
                        @foreach($service_record as $record)
                        <tr>
                          @foreach($positions as $position)
                              @foreach($position_type as $type)
                                  @if($position->type == $type->id)
                                  <?php $pos= $position->position; 
                                    $postype= $type->type;
                                   ?>
                                  @endif
                              @endforeach
                          @endforeach
                          <td>{{$pos}}</td>
                          <td>{{$postype}}</td>
                          <td>{{$record->started}}</td>
                          <td>
                            @if(isset($record->end))
                              {{$record->end}}
                            @else
                              {{'Present'}}
                            @endif
                          </td>
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
                  	     <th>Document Requested</th>
                         <th>Purpose</th>
                         <th>Date Requested</th>
                         <th>Status</th>

                      </thead>
                      <tbody>
                        @foreach($document_requests as $doc_req)
                          <tr>
                            <td>{{$doc_req->document}}</td>
                            <td>{{$doc_req->purpose}}</td>
                            <td>
                              <?php echo date('F d, Y H:i', strtotime($doc_req->created_at))?>
                            </td>
                            <td>
                              @if(!isset($doc_req->status))
                              In Progress
                              @elseif($doc_req->status==1)
                              {{$doc_req->remarks}}
                              @elseif($doc_req->status==2)
                                Claimed
                               <!--  <?php echo date('F d, Y', strtotime($doc_req->updated_at))?> -->
                              @endif
                              
                            </td>
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

 