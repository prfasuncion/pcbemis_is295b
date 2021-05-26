@extends('layouts.app', ['activePage' => 'exitapp', 'titlePage' => __('Exit Application')])

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
            <div class="card-header card-header-tabs" style="background-color: gray; color: white;">
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                    My Exit Application
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane active" id="messages">
                  <div class="row">
                    <div class="col-sm-12">
                      <h5>Date Filed: {{$exit_app->created_at}}
                        <div class="float-right">
                          <a href="{{route('user_exitapplication.index')}}" class="btn btn-sm btn-primary">Back
                          </a>
                          </div>
                        </h5>
                      

                        
                      
                    </div>
                  </div> 
                  <div class="row">

                    <div class="col-sm-12">
                      {!!$exit_app->letter!!}
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
      firstSort: [[5,'desc']],
      disable: ["last"],
      appendFilterby: false,
      dateFormat: [[4,"mm-dd-yyyy"]],
      debug: true,
      vocabulary: {
    voc_filter_by: 'Filter By',
    // voc_type_here_filter: 'Search...',
    // voc_show_rows: '  Rows'
  },
      pagination: true,
      // showrows: [5,10,15,20],
      disableFilterBy: [7]
    });

    
    // $('.table').tablemanager();
  </script>

@endsection

 