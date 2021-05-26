@extends('layouts.adminapp', ['activePage' => 'jobopp', 'titlePage' => __('Job Opportunities')])

@section('content')
<div class="content">
  <div class="container-fluid">
    @if (session()->has('success'))
                   <div class="row" id="successMessage">
                    <div class="col-sm-12">
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>{{ session()->get('success') }}</span>
                      </div>
                    </div>
                  </div> 
    @elseif (session()->has('success_un'))
              <div class="row" id="successMessage">
                    <div class="col-sm-12">
                      <div class="alert alert-warning">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>{{ session()->get('success_un') }}</span>
                      </div>
                    </div>
                  </div> 
    @endif 
    <div class="row">
      <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">Job Opportunities</h4>
              <p class="card-category"> Here you can manage job postings</p>
            </div>
            <div class="card-body">
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
                  <a href="{{ route('job_opportunity.create') }}" class="btn btn-sm btn-primary">Add Job Post</a>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table tablemanager">
                  <thead class=" text-primary">

                 
                    <tr><th>
                       Job Title
                    </th>
                    <th>
                      Category
                    </th>
                    <th>
                      Status
                    </th>
                    <th>
                      Applicants
                    </th>
                    <th>
                      Creation date
                    </th>
                    <th class="text-right">
                      Actions
                    </th>
                  </tr></thead>
                  <tbody>
                      @foreach($job_opps as $jobopp)
                        <tr>
                        <td>
                          {{$jobopp->job_title}}
                        </td>
                        <td>
                          {{$jobopp->job_category}}
                        </td>
                        <td>
                          @if($jobopp->status==0)
                            @elseif($jobopp->status==1)
                            Published
                            @endif
                      
                        </td>
                        <td align="center">
                          <?php $ex_appcount=0; $in_appcount=0; ?>
                          @if($jobopp->job_category=="internal")
                          @foreach($internal_app as $in_ap)
                            @if($jobopp->id==$in_ap->job_id)
                              <?php $in_appcount++; ?>
                            @endif
                          @endforeach
                          @else
                          @foreach($external_app as $ex_ap)
                            @if($jobopp->id==$ex_ap->job_id)
                              <?php $ex_appcount++; ?>
                            @endif
                          @endforeach
                          @endif

                          @if($jobopp->job_category=="internal")
                          {{$in_appcount}}
                          @else
                          {{$ex_appcount}}
                          @endif
                          
                          
                        </td>
                        <td>
                          <?php echo date('F d, Y H:i', strtotime($jobopp->created_at))?>
          <!--       {{$jobopp->created_at}} -->
                        </td>

                        <td class="td-actions text-right">
                           
                            @if($jobopp->status==0 )
                          <button type="button" data-toggle="modal" data-target=".publish-{{$jobopp->id}}" class="btn btn-success">
                              PUBLISH
                            </button>
                            @else
                            <a rel="tooltip" class="btn btn-primary btn-link" href="{{route('job_opportunity.view',  [$id= Crypt::encrypt($jobopp->id)])}}" data-original-title="" title="">
                              <i class="material-icons">visibility</i>
                              <div class="ripple-container"></div>
                            </a>
                            <button type="button" data-toggle="modal" data-target=".unpublish-{{$jobopp->id}}" class="btn btn-warning">
                              UNPUBLISH
                            </button>
                            @endif

                            @if($jobopp->status==0 && $ex_appcount ==0)

                            <a rel="tooltip" class="btn btn-primary btn-link" href="{{route('job_opportunity.edit_jobopp', [$id=Crypt::encrypt($jobopp->id)])}}" data-original-title="" title="">
                              <i class="material-icons">edit</i>
                              <div class="ripple-container"></div>
                            </a>
                            
                            <a rel="tooltip" class="btn btn-danger btn-link" href="" data-toggle="modal" data-target=".delete-{{$jobopp->id}}" data-original-title="" title="">
                              <i class="material-icons">delete</i>
                              <div class="ripple-container"></div>
                            </a>
                            @endif
                              
                        </td>
                        
                      </tr>
                      <div class="modal fade delete-{{$jobopp->id}}" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header ">
                                  <h5 class="modal-title">Delete Job Post</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <h5>Are you sure you want to delete this job posting?</h5>
                                  <p>By deleting this post, this will be no longer available in Job Opportunity section and cannot be undone</p>

                                  <br>
                                  <h3> {{$jobopp->job_title}}</h3>
                                

                                  <br>
                                  <p> By clicking 'Delete', this cannot be undone.</p>
                                  <div>
                                   
                                  </div>
                                </div>
                                <form  method="post" action="{{route('job_opportunity.delete',  [$id= Crypt::encrypt($jobopp->id)])}}">
                                 @csrf
                                 @method('post')
                                <div class="modal-footer">
                                  <button type="submit" class="btn btn-danger">Delete</button>
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                              </form>
                              </div>
                            </div>
                      </div>

                      <div class="modal fade publish-{{$jobopp->id}}" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header ">
                                  <h5 class="modal-title">Publish Job Post</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <h5>Are you sure you want to publish this job posting?</h5>
                                  <p>By publishing this post, this will be available in Job Opportunity section (user access will vary according to category)</p>

                                  <br>
                                  <h3> {{$jobopp->job_title}}</h3>
                                

                                  <br>
                                  <p> By clicking 'Publish', this cannot be undone.</p>
                                  <div>
                                   
                                  </div>
                                </div>
                                <form  method="post" action="{{route('job_opportunity.publish',  [$id= Crypt::encrypt($jobopp->id)])}}">
                                 @csrf
                                 @method('post')
                                <div class="modal-footer">
                                  <button type="submit" class="btn btn-success">Publish</button>
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                              </form>
                              </div>
                            </div>
                      </div>

                      <div class="modal fade unpublish-{{$jobopp->id}}" tabindex="-1" role="dialog">
                            <div class="modal-dialog " role="document">
                              <div class="modal-content">
                                <div class="modal-header bg-warning">
                                  <h5 class="modal-title">Unpublish Job Post</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <h5>Are you sure you want to unpublish this job posting?</h5>
                                  <p>By publishing this post, this will no longer be available in Job Opportunity section</p>

                                  <br>
                                  <h3> {{$jobopp->job_title}}</h3>
                                

                                  <br>
                                  <p> By clicking 'Unpublish', this cannot be undone.</p>
                                  <div>
                                   
                                  </div>
                                </div>
                                <form  method="post" action="{{route('job_opportunity.unpublish',  [$id= Crypt::encrypt($jobopp->id)])}}">
                                 @csrf
                                 @method('post')
                                <div class="modal-footer">
                                  <button type="submit" class="btn btn-warning">Unpublish</button>
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                              </form>
                              </div>
                            </div>
                      </div>
              @endforeach
            
                    </tbody>
                </table>
              </div>
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
      disableFilterBy: [6]
    });
    // $('.tablemanager').tablemanager();
  </script>
@endsection
