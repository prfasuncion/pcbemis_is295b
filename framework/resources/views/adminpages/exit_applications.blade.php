@extends('layouts.adminapp', ['activePage' => 'exitapp', 'titlePage' => __('Exit Application')])

@section('content')
 @csrf
<div class="content" id="content">
  <div class="container-fluid">
                  
    <div class="row">
      <div class="col-lg-12 col-md-12">
          <div class="card" id="profcard">
            <div class="card-header card-header-tabs" style="background-color: gray; color: white;">
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                    <h4 class="card-title ">Exit Application</h4>
                    <p class="card-category">Here you can manage exit applications</p>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
              <div class="col-sm-12">
                <div class="float-right">
                <button class="btn btn-sm btn-dark">Back</button>
                <a href="{{route('exit_interview_questions.index')}}" class="btn btn-sm btn-primary">Exit Interview Questions</a>
                </div>
              </div>
            </div>
                <div class="row">
                  <div class="col-sm-12">
                  <div class="table-responsive">
                  <table class="table tablemanager">
                    <thead>
                      <th>Employee</th>
                      <th>Date Filed</th>
                      <th>Status</th>
                      <th class="td-action text-right">Actions</th>
                    </thead>
                    <tbody>
                      @foreach($exit_applicants as $exit_applicant)
                      <tr>
                        <td>
                          @foreach($userprofile as $user)
                            @if($exit_applicant->user_id == $user->id)

                              {{$user->user->lname}},
                              {{$user->user->fname}} 
                              {{$user->user->name_ext}}

                            @endif
                          @endforeach
                        </td>
                        <td>
                             <?php echo date('F d, Y', strtotime($exit_applicant->created_at))?>
                        </td>
                        <td>
                          @if(isset($exit_applicant->approved))
                              Approved
                          @elseif($exit_applicant->status==2)
                              Cancelled on 
                              <?php echo date('F d, Y', strtotime($exit_applicant->updated_at))?>
                          @else

                          @endif
                        </td>
                        <td class="td-action text-right">
                          <a href="{{route('exit.view_application', [Crypt::encrypt($exit_applicant->id)])}}" class="btn btn-sm btn-primary">
                            View
                          </a>
                          <?php $exit_int_exist=0; ?>
                          @foreach($exit_answers as $answers)
                            @if($answers->user_id == $exit_applicant->user_id)
                            <?php $exit_int_exist++; ?>
                            @endif
                          @endforeach

                          @if($exit_int_exist>0)
                          <a href="{{route('exit.view_exit_interview', [Crypt::encrypt($exit_applicant->user_id)])}}" class="btn btn-sm btn-info">
                            View Exit Interview
                          </a>
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
      disableFilterBy: [3]
    });
    // $('.tablemanager').tablemanager();
  </script>

@endsection

 