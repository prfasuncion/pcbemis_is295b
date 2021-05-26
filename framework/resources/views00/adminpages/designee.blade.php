@extends('layouts.adminapp', ['activePage' => 'designation', 'titlePage' => __('Designations')])

@section('content')
@csrf
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
            <div class="card-header card-header-success">
              <h4 class="card-title ">Designations</h4>
              <p class="card-category"> </p>
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
               
              </div>
              <div class="table-responsive">
                <table class="table">
                  <thead class=" text-primary">

                 
                    <tr><th>
                       Designation Title
                    </th>
                    <th>
                      Description
                    </th>
                    <th class="td-actions text-right">
                      Action
                    </th>
               
              
               
                  </tr></thead>
                  <tbody>
     
                        <tr>
                        <td>
                	{{$designations->desig_title }}
                        </td>
                        <td>
                      {{$designations->desig_description }}
                        </td>
                        <td class="td-actions text-right">
                           <a rel="tooltip" class="btn btn-success " href="{{ route('designation.designate_new', [Crypt::encrypt($designations->id)]) }}" data-original-title="" title="Designate New">

                              <i class="material-icons">person_add</i> Designate
                              <div class="ripple-container"></div>
                          </a>

                        </td>
                      </tr>
                       
                      </tbody>
                </table>
              </div>
            </div>
          </div>
               
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-info">
              <h4 class="card-title ">Designee</h4>
              <p class="card-category"> </p>
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
               
              </div>
              <div class="table-responsive">
                <table class="table tablemanager">
                  <thead class=" text-primary">

                 
                    <tr>
                      <th>
                       Employee
                    </th>
                    <th>
                      Date Designated
                    </th>
                    <th>
                      Until
                    </th>
                    <th class="td-actions text-right">
                      Action
                    </th>
               
              
               
                  </tr></thead>
                  <tbody>
                      @foreach($designations->designee as $desig)
                   
                      
                        <tr>
                        <td>
                    
                         @foreach ($userprofile as $user)

                         @if($user->id== $desig->user_id)
                         <?php $name=$user->user->lname.', '.$user->user->fname ?>
                        @endif
                        @endforeach
                        {{$name}}
                        </td>
                        <td>
                          <?php echo date('F d, Y', strtotime($desig->date_designated))?>
                  
                        </td>
                        <td>
                          @if(isset($desig->until))
                           <?php echo date('F d, Y', strtotime($desig->until))?>
                       
                          @else
                          {{'Present'}}
                          @endif
                        </td>
                        <td class="td-actions text-right">
                          <a href="" class="btn btn-danger btn-sm" title="Remove" data-toggle="modal" data-target=".remove">
                            <i class="material-icons">person_off</i>
                          </a>
                        </td>
                  
                      </tr>
                        
                        <div class="modal fade  remove" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title">Delete</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <p>Are you sure you want to remove this?</p>
                                  <div>
                                   
                                  </div>
                                </div>
                                <form  method="post" action="{{route('designation.remove_designee', $desig->id)}}">
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