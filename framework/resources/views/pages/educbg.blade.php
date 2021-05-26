@extends('layouts.app', ['activePage' => 'userprofile', 'titlePage' => __('Profile')])

@section('content')
 @csrf
<div class="content" id="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 col-md-12">
          <div class="card" id="profcard">
            <div class="card-header card-header-tabs card-header-primary">
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                <!--   <span class="nav-tabs-title">Profile:</span> -->
                  <ul class="nav nav-tabs" data-tabs="tabs">
                    <li class="nav-item">
                      <a class="nav-link " href="{{ route('userprofile.index') }}">
                        <i class="material-icons">account_box</i> PERSONAL INFORMATION
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link " href="{{url('userprofile/eligibility')}}">
                        <i class="material-icons">verified</i> ELIGIBILITY
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" href="{{url('userprofile/educ')}}" >
                        <i class="material-icons">school</i> Educational Background
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{url('userprofile/work_experience')}}">
                        <i class="material-icons">work</i> WORK EXPERIENCE
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{url('userprofile/ldi')}}">
                        <i class="material-icons">badge</i> L&D INTERVENTIONS/TRAININGS
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="tab-content">
                      <div class="modal fade bd-example-modal-lg" tabindex="-1" id="mymodal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                               <div class="modal-body">
                              <form id="myform" method="post" action="{{route('educbg.store')}}">
                                 @csrf
                                 @method('post')
                                 <h5>Write NA if not applicable</h5>
                                <div class="form-group">
                                  <label for="recipient-name" class="col-form-label">Level</label><br>
                                  <input type="text" class="form-control" name="level" required >
                                </div>
                                
                                <div class="form-group">
                                  <label for="message-text" class="col-form-label">School Name:</label><br>
                                  <input type="text" class="form-control" name="schoolname" required >
                                </div>
                                <div class="form-group">
                                  <label  for="message-text" class="col-form-label">Basic Education/Degree/Course</label><br>
                                  <input type="text" class="form-control" name="degree" required>
                                </div>
                                <div class="row">
                                <div class="col-sm-3">
                                <div class="form-group">
                                  <label for="message-text" class="col-form-label">From</label>
                                  <br>
                                  <input type="text" class="form-control" name="from" required>
                                </div>
                                </div>
                                <div class="col-sm-3">
                                <div class="form-group">
                                  <label for="message-text" class="col-form-label">To</label>
                                  <br>
                                  <input type="text" class="form-control" name="to" required>
                                </div>
                                </div>
                                <div class="col-sm-3">
                                <div class="form-group">
                                  <label for="message-text" class="col-form-label">Highest Level/Units Earned</label>
                                  <br>
                                  <input type="text" class="form-control" name="unitsearned" required >
                                </div>
                                </div>
                                <div class="col-sm-3">
                                <div class="form-group">
                                  <label for="message-text" class="col-form-label">Year Graduated</label>
                                  <br>
                                  <input type="text" class="form-control" name="yeargraduated" required>
                                </div>
                                </div>
                                <div class="col-sm-12">
                                <div class="form-group">
                                  <label for="message-text" class="col-form-label">Scholarship/Academic Honors received</label>
                                  <br>
                                  <input type="text" class="form-control" name="awards" required>
                                </div>
                                </div>

                                </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="submit" id="insert" class="btn btn-primary btned">Save</button>
                               </form>
                            </div>
                          </div>
                        </div>
                      </div>

                <div class="tab-pane active" id="messages">
                  <div class="row">
                  <div class="col-sm-6">
                    <h5><strong>Educational Background</strong></h5>
                  </div>
                  <div class="col-sm-6">
                    <button type="button" id="addeducbtn" class="btn btn-warning addeducbtn pull-right" data-toggle="modal" data-target=".bd-example-modal-lg">{{ __('Add') }}</button>
                  </div>
                  </div>
                  <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <tr>
                      <th>Level</th>
                      <th>Name of School</th>
                      <th>Basic Education/Degree/Course</th>
                      <th>From</th>
                      <th>To</th>
                      <th>Highest Level/Units Earned</th>
                      <th>Year Graduated</th>
                      <th>Scholarship/Academic Honors received</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                      

                      @foreach($user_educbg as $educ)
                      
                      <tr>
                        <td>{{$educ->level}}</td>
                        <td>{{$educ->school}}</td>
                        <td>{{$educ->degree}}</td>
                        <td>{{$educ->ed_from}}</td>
                        <td>{{$educ->ed_to}}</td>
                        <td>{{$educ->units_earned}}</td>
                        <td>{{$educ->year_graduated}}</td>
                        <td>{{$educ->award}}</td>
                        <td class="text-right" >
                          <!-- <button type="button"  title="Edit" class="btn btn-primary btn-link btn-sm" data-toggle="modal" data-target=".edit_ed-{{$educ->user_id}}">
                            <i class="material-icons">edit</i>
                          </button> -->
                          <button title="Edit"  class="btn btn-primary btn-sm  " data-toggle="modal" data-target=".edit_ed-{{$educ->id}}"><i class="material-icons">edit</i></button>

                          <button title="Delete"  class="btn btn-danger btn-sm" data-toggle="modal" data-target=".delete-{{$educ->id}}"><i class="material-icons">close</i></button>
                          
                        </td>
                      </tr>
                          <div class="modal fade  delete-{{$educ->id}}" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title">Delete</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <p>Are yoou sure you want to delete this?</p>
                                  <div>
                                    <p><strong>Level:</strong> {{$educ->level}}</p>
                                    <p><strong>School Name:</strong> {{$educ->school}}</p>
                                    <p><strong>Degree/Course:</strong> {{$educ->degree}}</p>
                                    <p><strong>From:</strong> {{$educ->ed_from}}</p>
                                    <p><strong>To:</strong> {{$educ->ed_to}}</p>
                                    <p><strong>Units earned:</strong> {{$educ->units_earned}}</p>
                                    <p><strong>Year Graduated</strong> {{$educ->year_graduated}}</p>
                                    <p><strong>Awards received:</strong> {{$educ->award}}</p>
                                  </div>
                                </div>
                                <form  method="post" action="{{route('educbg.delete',  [$id= Crypt::encrypt($educ->id)])}}">
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
                        
                          <div class="modal fade edit_ed-{{$educ->id}}" tabindex="-1" id="edit_educ" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                               <div class="modal-body">
                              <form id="myform" method="post" action="{{route('educbg.update',  [$id= Crypt::encrypt($educ->id)])}}">
                                 @csrf
                                 @method('post')
                                <div class="form-group">
                                  <label for="recipient-name" class="col-form-label">Level</label><br>

                                  <input type="text" class="form-control" value="{{$educ->level}}" name="level" required>
                                </div>
                                
                                <div class="form-group">
                                  <label for="message-text" class="col-form-label">School Name:</label><br>
                                  <input type="text" class="form-control" value="{{$educ->school}}"  name="schoolname" required >
                                </div>
                                <div class="form-group">
                                  <label  for="message-text" class="col-form-label">Basic Education/Degree/Course</label><br>
                                  <input type="text" class="form-control" name="degree" value="{{$educ->degree}}"  required>
                                </div>
                                <div class="row">
                                <div class="col-sm-3">
                                <div class="form-group">
                                  <label for="message-text" class="col-form-label">From</label>
                                  <br>
                                  <input type="text" class="form-control" name="from" value="{{$educ->ed_from}}" required >
                                </div>
                                </div>
                                <div class="col-sm-3">
                                <div class="form-group">
                                  <label for="message-text" class="col-form-label">To</label>
                                  <br>
                                  <input type="text" class="form-control" name="to" value="{{$educ->ed_to}}"required  >
                                </div>
                                </div>
                                <div class="col-sm-3">
                                <div class="form-group">
                                  <label for="message-text" class="col-form-label">Highest Level/Units Earned</label>
                                  <br>
                                  <input type="text" class="form-control" name="unitsearned" value="{{$educ->units_earned}}" required >
                                </div>
                                </div>
                                <div class="col-sm-3">
                                <div class="form-group">
                                  <label for="message-text" class="col-form-label">Year Graduated</label>
                                  <br>
                                  <input type="text" class="form-control" name="yeargraduated" value="{{$educ->year_graduated}}" required>
                                </div>
                                </div>
                                <div class="col-sm-12">
                                <div class="form-group">
                                  <label for="message-text" class="col-form-label">Scholarship/Academic Honors received</label>
                                  <br>
                                  <input type="text" class="form-control" name="awards" value="{{$educ->award}}" required>
                                </div>
                                </div>

                                </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="submit" id="insert" class="btn btn-primary btned">Save</button>
                               </form>
                            </div>
                          </div>
                        </div>
                      </div>

                      @endforeach
                
                    </tbody>
                  </table>
                </div>
                  
                </div>
                <div class="tab-pane" id="settings">
                  
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
@endsection

  
