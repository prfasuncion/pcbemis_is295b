@extends('layouts.adminapp', ['activePage' => 'dept', 'titlePage' => __('Departments')])

@section('content')
@csrf
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">Departments</h4>
              <p class="card-category"> Here you can manage departments</p>
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
                  <a href="{{ route('department.create') }}" class="btn btn-sm btn-primary">Create Department</a>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table tablemanager">
                  <thead class=" text-primary">

                 
                    <tr><th>
                       Department Code
                    </th>
                    <th>
                      Department Name
                    </th>
                    <th>
                      No. of Employees
                    </th>
                    <th class="text-right">
                      Actions
                    </th>
                  </tr></thead>
                  <tbody>
                      @foreach($departments as $department)
                        <tr>
                        <td>
                          {{$department->code}}
                        </td>
                        <td>
                          {{$department->name}}
                        </td>
                        <td>
                          <?php $count_emp=0;?>
                          @foreach($dept_records as $record)
                            @if($department->id == $record->dept_id && !isset($record->until))
                              <?php $count_emp++;?>
                            @endif
                          @endforeach

                          {{$count_emp}}
                        </td>
                        <td class="td-actions text-right">
                          <a rel="tooltip" class="btn btn-success btn-link" href="{{route('dept.view',[Crypt::encrypt($department->id)])}}" data-original-title="" title="">
                              <i class="material-icons">visibility</i>
                              <div class="ripple-container"></div>
                            </a>
                            <a rel="tooltip" class="btn btn-success btn-link" href="{{route('department.edit', [$id= Crypt::encrypt($department->id)])}}" data-original-title="" title=""
                            
                            >
                              <i class="material-icons">edit</i>
                              <div class="ripple-container"></div>
                            </a>
                            @if($count_emp==0)
                            <a rel="tooltip" class="btn btn-danger btn-link" href="" data-original-title="" title="" data-toggle="modal" data-target=".delete-{{$department->id}}">
                              <i class="material-icons">delete</i>
                              <div class="ripple-container"></div>
                            </a>
                            @endif
                        </td>
                      </tr>

                    <!--   <div class="modal fade edit-{{$department->id}}" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header ">
                                  <h5 class="modal-title">Edit Department</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                <form  role="form" action="{{route('department.edit',  [$id= Crypt::encrypt($department->id)])}}">
                                   @csrf
                                   {{ csrf_field() }}
                               @method('post').
                                <div class="col-sm-12">
                                  <input type="text" class="form-control" name="dept">
                                  <label class="col-form-label">Department Code</label><br>
                                  <input type="text" class="form-control" value="{{$department->code}}" name="deptcode">
                                </div>
                                <div class="col-sm-12">
                                  <label class="col-form-label">Department Name</label><br>
                                  <input type="text" class="form-control" value="{{$department->name}}" name="deptname">
                                </div>
                                 
                                  
                                </div>
                                
                                
                                <div class="modal-footer">
                                  <button type="submit" class="btn btn-success">Save</button>
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                              </form>
                              </div>
                            </div>
                        </div> -->

                        <div class="modal fade delete-{{$department->id}}" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header bg-danger">
                                  <h5 class="modal-title" style="color:white; ">Delete Department</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <h5>Are you sure you want to delete this? </h5>

                                  <br>
                                  <p>Department Code: {{$department->code}} </p>
                                  <p>Department Name: {{$department->name}}</p>
                                  

                                  <br>
                                  <p> By clicking delete, this cannot be undone.</p>
                                  <div>
                                   
                                  </div>
                                </div>
                                <form  method="post" action="{{route('dept.delete',  [$id= Crypt::encrypt($department->id)])}}">
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

<script type="text/javascript" src="{{ asset('material') }}/js/tableManager.js"></script>
<script type="text/javascript">
    // basic usage
    $('.tablemanager').tablemanager({
      firstSort: [[1,'asc']],
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
<script>
  setTimeout(function() {
    $('#successMessage').fadeOut('fast');
}, 5000); // <-- time in milliseconds
</script>
@endsection
