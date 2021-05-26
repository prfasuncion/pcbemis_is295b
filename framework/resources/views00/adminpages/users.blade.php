@extends('layouts.adminapp', ['activePage' => 'user-management', 'titlePage' => __('User Management')])

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
               @endif
    <div class="row">
      <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">Users</h4>
              <p class="card-category"> Here you can manage users</p>
            </div>
            <div class="card-body">
                              <div class="row">
                <div class="col-12 text-right">
                  <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary">Add user</a>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table tablemanager">
                  <thead class=" text-primary">
                    <tr><th>
                        Name
                    </th>
                    <th>
                      Email
                    </th>
                    <th>
                      Creation date
                    </th>
                    <th>Status</th>
                    <th class="text-right">
                      Actions
                    </th>
                  </tr></thead>
                  <tbody>
                    @foreach ($userprofile as $x)
                        <tr>
                        <td>
                          @if(!isset($x->image))
                           <img class="card-img-top ml-auto mr-auto " src='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSQJxKGGpPc9-5g25KWwnsCCy9O_dlS4HWo5A&usqp=CAU'  id="img" style="height: 50px; width: 50px; max-height: 50px; border-radius: 50%; "> 
                            @else
                            <img class="card-img-top ml-auto mr-auto " src="<?php echo asset( $x->image); ?>"  id="img" style="height: 50px; width: 50px; max-height: 50px; border-radius: 50%; ">
                            @endif
                          
                          {{ $x->user->lname.', '.$x->user->fname }}
                       
                        
                        </td>
                        <td>
                           {{$x->email}}
                        </td>
                        <td>
                         
                              <?php echo date('F d, Y H:i', strtotime($x->created_at))?>
                        </td>
                        <td>
                          @if(isset($x->inactive))
                            Inactive since 
                            <?php echo date('F d, Y H:i', strtotime($x->inactive))?>
                          @else
                          Active
                          @endif
                        </td>
                        <td class="td-actions text-right">
                            <a rel="tooltip" class="btn btn-success btn-sm" href="{{route('user.edit', $x->id)}}" data-original-title="" title="">
                              <i class="material-icons">edit</i>
                              <div class="ripple-container"></div>
                            </a>
                            @if(isset($x->inactive))
                              <a rel="tooltip" class="btn btn-info btn-sm" href="#" data-original-title="" title="Reactivate user access" data-toggle="modal" data-target=".activate-{{$x->id}}">
                              <i class="material-icons">person</i>
                              <div class="ripple-container"></div>
                            </a>
                            @else
                                 @if($x->id == Auth::user()->id)
                            @else
                              <a rel="tooltip" class="btn btn-danger btn-sm" data-toggle="modal" data-target=".inactivate-{{$x->id}}" data-original-title="" title="Suspend user access" style="color: white;">
                            
                              <i class="material-icons">person_off</i>
                              <div class="ripple-container"></div>
                            </a>
                            @endif
                            @endif
                            
                            
                        </td>
                      </tr>

                      <div class="modal fade inactivate-{{$x->id}}" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" style="">Suspend User Access</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body" align="left">
                                  <h5>Are you sure you want to suspend user access of {{$x->user->lname.', '. $x->user->fname.' '.$x->user->name_ext}} </h5>
                                  
                                  <p>The selected employee will not be able to login to the website after clicking Submit.</p>
                                </div>
                                <form  method="post" action="{{route('user.inactivate', $x->id)}}">
                                 @csrf
                                 @method('post')
                                <div class="modal-footer">
                                  <button type="submit" class="btn btn-danger">Submit</button>
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                              </form>
                              </div>
                            </div>
                      </div>

                      <div class="modal fade activate-{{$x->id}}" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" style="">Suspend User Access</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body" align="left">
                                  <h5>Are you sure you want to activate user access of {{$x->user->lname.', '. $x->user->fname.' '.$x->user->name_ext}} </h5>
                                  
                                  <p>The selected employee will now be able to login to the website after clicking Submit.</p>
                                </div>
                                <form  method="post" action="{{route('user.reactivate', $x->id)}}">
                                 @csrf
                                 @method('post')
                                <div class="modal-footer">
                                  <button type="submit" class="btn btn-success">Submit</button>
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
  </div>
</div>
<script type="text/javascript">
  setInterval(function() {
                  window.location.reload();
                }, 30000); 

</script>
<script>
  setTimeout(function() {
    $('#successMessage').fadeOut('fast');
}, 5000); // <-- time in milliseconds
</script>
<script type="text/javascript" src="{{ asset('material') }}/js/tableManager.js"></script>
<script type="text/javascript">
    // basic usage
    $('.tablemanager').tablemanager({
      firstSort: [[3,'desc']],
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
      disableFilterBy: [4]
    });
    // $('.tablemanager').tablemanager();
  </script>
@endsection