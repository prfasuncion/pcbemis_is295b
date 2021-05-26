@extends('layouts.adminapp', ['activePage' => 'acadyear', 'titlePage' => __('Academic Year Setting')])

@section('content')
<div class="content">
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
      <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">A.Y. Setting</h4>
              <p class="card-category"> Here you can manage active Academic Year and Semester</p>
            </div>
            <div class="card-body">
                              <div class="row">
                <div class="col-12 text-right">
                  <a href="{{ route('acadyear.create') }}" class="btn btn-sm btn-primary">Add Academic Year</a>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table tablemanager">
                  <thead class=" text-primary">

                 
                    <tr><th>
                        Academic Year
                    </th>
                    <th>
                      Status
                    </th>
                    <th>
                      Creation date
                    </th>
                    <th class="text-right">
                      Actions
                    </th>
                  </tr></thead>
                  <tbody>
                     @foreach($acadyear as $acadyr)
                        <tr>
                        <td>
                			{{$acadyr->start_ay }} {{'-'}}{{$acadyr->end_ay }}
                        </td>
                         <td>
                        <?php $stat ?>

                        @foreach($sem as $s)
                          @if($acadyr->id == $s->ay_id && $s->status==1)
                            <?php $stat="Active ".$s->name; ?>

                            {{$stat}}
                        
                          @else

                          @endif
                        @endforeach
                        </td>
                        <td>
                   	
                         <?php echo date('F d, Y H:i', strtotime($acadyr->created_at))?>
                        </td>
                        <td class="td-actions text-right">
                                                        <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('sem.index', [Crypt::encrypt($acadyr->id)]) }}" data-original-title="" title="">
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
            <div class="row float-right">
                  <div class="col-12 text-right">
                   
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
      disableFilterBy: [4]
    });
    // $('.tablemanager').tablemanager();
  </script>
@endsection