@extends('layouts.adminapp', ['activePage' => 'designation', 'titlePage' => __('Designations')])

@section('content')
  @csrf
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-success">
              <h4 class="card-title ">Designations</h4>
              <p class="card-category"> Here you can manage designations</p>
            </div>
            <div class="card-body">
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
                <div class="col-12 text-right">
                  <a href="{{ route('designations.create') }}" class="btn btn-sm btn-success">Add Designation</a>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table tablemanager">
                  <thead class=" text-primary">

                 
                    <tr><th>
                       Designation Title
                    </th>
                    <th>
                      Designee
                    </th>
                    <th>Date of Designation</th>
                    <th>
                      Creation date
                    </th>
                    <th class="text-right">
                      Actions
                    </th>
                  </tr></thead>
                  <tbody>
                        @foreach($designations as $desig)
                        <tr>
                        <td>
                          	{{$desig->desig_title }}
                        </td>
                        <td>
                            @foreach($desig_records as $record)
                            @if($record->desig_id==$desig->id && !isset($record->until))
                               @foreach ($userprofile as $user)

                               @if($user->id== $record->user_id)
                               <?php $name=$user->user->lname.', '.$user->user->fname;
                               ?>
                              @endif
                              @endforeach
                              {{$name}}
                      

                            @endif

                            @endforeach
                      
                        </td>
                        <td>
                          @foreach($desig_records as $record)
                            @if($record->desig_id==$desig->id && !isset($record->until))
                               @foreach ($userprofile as $user)

                               @if($user->id== $record->user_id)
                               <?php $date_desig= $record->date_designated;
                               ?>
                              @endif
                              @endforeach
                            
                      
                                 <?php echo date('F d, Y', strtotime($date_desig))?>
                            @endif

                            @endforeach
                        
                        </td>
                        <td>
              
                            <?php echo date('F d, Y H:i', strtotime($desig->created_at ))?>
                        </td>
                        <td class="td-actions text-right">
                          <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('designation.designee', [Crypt::encrypt($desig->id)]) }}" data-original-title="" title="view">

                              <i class="material-icons">visibility</i>
                              <div class="ripple-container"></div>
                          </a>

                          <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('designation.edit', [Crypt::encrypt($desig->id)]) }}" data-original-title="" title="">
                              <i class="material-icons">edit</i>
                              <div class="ripple-container"></div>
                            </a>
                            <?php $exist=0; ?>
                            @foreach($desig_records as $record)
                            @if($record->desig_id==$desig->id)
                              <?php $exist++; ?>
                      

                            @endif

                            @endforeach

                            @if($exist==0) 
                            @if(!isset($desig->dept_id_head))
                              <a rel="tooltip" class="btn btn-danger btn-link" href="" data-original-title="" title=""  data-toggle="modal" data-target=".delete-{{$desig->id}}" >
                              <i class="material-icons">delete</i>
                              <div class="ripple-container"></div>
                            </a>
                            @endif

                            <div class="modal fade delete-{{$desig->id}}" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header bg-danger">
                                  <h5 class="modal-title" style="color:white; ">Delete Task</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body text-left">
                                  <h5>Are you sure you want to delete this? </h5>

                                  <br>
                                  <p>Designation: {{$desig->desig_title}}</p>
                                  <p>Description: {{$desig->desig_description}}</p>
                                  <p>Created on: 

                               
                                     <?php echo date('F d, Y', strtotime($desig->created_at))?>
                                  </p>
                                

                                  <br>
                                  <p> By clicking delete, this cannot be undone.</p>
                                  <div>
                                   
                                  </div>
                                </div>
                                <form  method="post" action="{{ route('designation.delete', [Crypt::encrypt($desig->id)]) }}">
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
    <div class="row float-right">
                  <div class="col-sm-12 text-right">
                   
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