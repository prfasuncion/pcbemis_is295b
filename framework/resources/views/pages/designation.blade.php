@extends('layouts.app', ['activePage' => 'designation', 'titlePage' => __('My Designations')])

@section('content')
 @csrf
<div class="content" id="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 col-md-12">
          <div class="card" id="profcard">
            <div class="card-header card-header-tabs card-header-success">
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                    My Designations
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="tab-content">
            

                <div class="tab-pane active" id="messages">
                  <div class="row" style="">
                  <div class="col-sm-12">
                    <h5><strong>Active Designations</strong></h5>
                  </div>
                  </div>
                  <div class="row">
                    <?php $active=0; ?>
                    @foreach($desig_records as $mydesig)
                    @foreach($designations as $desig)
                          @if($mydesig->desig_id== $desig->id && !isset($mydesig->until))
                          <?php $active++; ?>
                    <div class="col-sm-3">
                      <div class="card bg-info">
                        <div class="card-body"> 
                        {{$desig->desig_title}}
                        </div>
                      </div>
                    </div>
                    @endif
                    @endforeach
                    @endforeach
                    @if($active==0)
                    <div class="col-sm-12">
                      <p>No Active Designations</p>
                    </div>
                    @endif

                  </div>
                  
                  <table class="table tablemanager" id="educbg">
                  	 <thead class=" text-primary">
                  	  <th>Designation</th>
                      <th>Date Designated</th>
                      <th>Until</th>
                   <!--    <th class="text-right">Action</th> -->
                      </thead>
                      <tbody>
                        @foreach($desig_records as $mydesig)
                        <tr>
                          @foreach($designations as $desig)
                          @if($mydesig->desig_id== $desig->id)
                          <td>
                            {{$desig->desig_title}}
                          </td>
                          @endif
                          @endforeach
                          <td>
                            <?php echo date('F d, Y', strtotime($mydesig->created_at))?>
                          </td>
                          <td>
                            @if(!isset($mydesig->until))
                              Present
                            @else
                        
                            <?php echo date('F d, Y', strtotime($mydesig->until))?>
                            @endif

                          </td>
                          <!-- <td class="text-right">
                            <a rel="tooltip" class="btn btn-success " href="" data-original-title="" title="View Task">
                              <i class="material-icons">visibility</i> View
                              <div class="ripple-container"></div>
                            </a>
                          </td> -->
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
      firstSort: [[3,'present']],
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

@endsection

 