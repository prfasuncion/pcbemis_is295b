@extends('layouts.adminapp', ['activePage' => 'pos', 'titlePage' => __('Positions')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">Position Type</h4>
              <p class="card-category"> Here you can manage types of position
              </p>
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
                  <a href="{{ route('positions.index') }}" class="btn btn-sm btn-primary">Back</a>
                  <a href="{{ route('position.create_type') }}" class="btn btn-sm btn-primary">Create Type</a>

                </div>
              </div>
              <div class="table-responsive">
                <table class="table">
                  <thead class=" text-primary">

                 
                    <tr><th>
                       Type
                    </th>
                  <!--   <th>
                      Type
                    </th>
                    <th>
                      Salary
                    </th> -->
                    <th class="text-right">
                      Actions
                    </th>
                  </tr></thead>
                  <tbody>
                        @foreach ($position_type as $type)
                        <tr>
                        <td>
                          {{$type->type}}
                        </td>
                       <!--  <td>
                      
                        </td>
                        <td>
           
                        </td> -->
                        <td class="td-actions text-right">
                                                        <a rel="tooltip" class="btn btn-success btn-link" href="" data-original-title="" title="">
                              <i class="material-icons">edit</i>
                              <div class="ripple-container"></div>
                            </a>
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
<script>
  setTimeout(function() {
    $('#successMessage').fadeOut('fast');
}, 5000); // <-- time in milliseconds
</script>
@endsection
