@extends('layouts.adminapp', ['activePage' => 'evaluations', 'titlePage' => __('Evaluations')])
@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">Evaluations</h4>
              <p class="card-category"> Here you can manage evaluations</p>
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

                  <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary">Back</a>
                  <a href="{{ route('evaluation_kpi.index') }}" class="btn btn-sm btn-primary">Evaluation KPI's</a>

                </div>
              </div>
             <form action="{{route('eval.set_store', [Crypt::encrypt($eval_id)])}}" id="formsub" method="post">
              @csrf
                 @method('post')
              <div class="table-responsive">
                <table class="table tablemanager">
                  <thead class=" text-primary">
                    <tr>
                      <th >Include</th>
                      <th>
                       Evaluation KPI
                    </th>
                    <th>
                      Category
                    </th>
                    <th hidden>categ_id</th>
                   
                  </tr></thead>

                  <tbody>

                 
                        @foreach($evaldetails as $details)
                        <tr>
                        <td width="3%">
                            <input type="checkbox" checked="" class="form-control "   name="eval_include[]" value="{{$details->id}}">
                            
                        </td>
                        <td width="70%">
                            {{$details->kpi}}
                        </td>
                         <?php $cat; ?>
                        @foreach ($categ as $category)
                          @if($details->eval_categ_id == $category->id)
                          <?php $cat = $category->name ?>
                          @endif
                        @endforeach
                        <td width="20%">
                            {{$cat}}
                        </td>
                        <td hidden>{{$details->eval_categ_id}}</td>
                    
                      </tr>
                      @endforeach
           
             
                      </tbody>
                </table>
              </div>

              <div class="row">
                <div class="col-sm-12">
                <button type="submit" class="btn btn-success pull-right">Save</button>
            
                </div>
              </div>
                 </form>
              

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
      firstSort: [[4,'asc']],
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
      disableFilterBy: [1,4]
    });
    // $('.tablemanager').tablemanager();
  </script>
<script>
  setTimeout(function() {
    $('#successMessage').fadeOut('fast');
}, 5000); // <-- time in milliseconds


  function fsub(){
    $('#formsub').submit();
  }
</script>
@endsection