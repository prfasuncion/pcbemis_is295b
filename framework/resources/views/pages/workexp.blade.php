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
                  <ul class="nav nav-tabs" data-tabs="tabs">
                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('userprofile.index') }}">
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
                      <a class="nav-link" href="{{url('userprofile/educ')}}" >
                        <i class="material-icons">school</i> Educational Background
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" href="{{url('userprofile/work_experience')}}">
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
                               <form id="myform" method="post" action="{{route('workexp.store')}}">
                                 @csrf
                                 @method('post')
                                 <h5>Write NA if not applicable</h5>
                                <div class="row">
                                <div class="col-sm-6">
                                <div class="form-group">
                                  <label for="recipient-name" class="col-form-label">Position/Title</label><br>
                                  <input type="text" class="form-control" name="position" required>
                                </div>
                              </div>
                                
                                <div class="col-sm-3">
                                <div class=" form-group">
                                  <label for="message-text" class="col-form-label">From</label><br>
                                  <input type="date" class="form-control" name="workfrom"  required>
                                </div>
                                </div>
                                <div class="col-sm-3">
                                <div class=" form-group">
                                  <label for="message-text" class="col-form-label">To</label><br>
                                  <input type="date" class="form-control" name="workto"  required>
                                </div>
                                </div>
                                </div>
                              
                               
                                <div class="form-group">
                                  <label for="message-text" class="col-form-label">Agency/Company</label><br>
                                  <input type="text" class="form-control" name="company"  required>
                                </div>
                                 <div class="row">
                                <div class="col-sm-3">
                                <div class="form-group">
                                  <label for="message-text" class="col-form-label">Monthly Salary ( &#8369;)</label><br>
                                  <input class="form-control" type="number" min="0.01" step="0.01" name="salary" value="0.00"  required>
                                </div>
                                </div>
                                <div class="col-sm-5">
                                <div class="form-group">
                                  <label for="message-text" class="col-form-label">Salary Grade & Step Increment(Format "00-0")</label><br>
                                 <input class="form-control"  type="text" name="sgrade"  required>
                                </div>
                                </div>

                                <div class="col-sm-4">
                                <div class="form-group">
                                  <label for="message-text" class="col-form-label">Status of Appointment</label><br>
                                  <input class="form-control"  type="text" name="appointment"  required>
                                </div>
                                </div>
                                </div>

                                <div class="row">
                                
                             

                                <div class="col-sm-3">
                                <div class="form-group">
                                  <label for="message-text" class="col-form-label">Government Service? </label>
                                  <select class=" form-control" title="Single Select" name="gov_service"  required>
                                  <option disabled selected>Please Select</option>
                                  <option value="1">Yes</option>
                                  <option value="0">No</option>
                                </select>
                                </div>
                                </div>
                              </div>

                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary btned">Save</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>

                <div class="tab-pane active" id="messages">
                  <div class="row">
                  <div class="col-sm-6">
                    <h5><strong>Work Experience</strong></h5>
                  </div>
                  <div class="col-sm-6">
                    <button type="button" id="addeducbtn" class="btn btn-warning addeducbtn pull-right" data-toggle="modal" data-target=".bd-example-modal-lg">{{ __('Add') }}</button>
                  </div>
                  </div>
                   <div class="table-responsive">
                  <table class="table" id="educbg">
                    <thead class="text-primary">
                      <th>Position/Title</th>
                      <th>From</th>
                      <th>To</th>
                      <th>Agency/Company</th>
                      <th>Monthly Salary</th>
                      <th>Salary Grade & Step Increment</th>
                      <th>Status of Appointment</th>
                      <th>Gov't Service</th>
                      <th>Action</th>
                    </thead>
                    <tbody>
                      
                      @foreach($user_workexp as $work)
                      <tr>
                        <td>{{$work->position}}</td>
                        <td>{{$work->from}}</td>
                        <td>{{$work->to}}</td>
                        <td>{{$work->company}}</td>
                        <td>{{$work->salary}}</td>
                        <td>{{$work->sgrade}}</td>
                        <td>{{$work->appointment}}</td>
                        <td> @if($work->gov_service==0)
                          No
                          @else
                          Yes
                          @endif
                        </td>
                        <td >
                      <!--     <a rel="tooltip" class="btn btn-success btn-link"><i class="material-icons">edit</i></a> -->
                          <button title="Edit"  class="btn btn-primary btn-sm " data-toggle="modal" data-target=".editwork-{{$work->id}}"><i class="material-icons">edit</i></button>

                          <button title="Delete"  class="btn btn-danger btn-sm " data-toggle="modal" data-target=".deletework-{{$work->id}}"><i class="material-icons">close</i></button>

                        </td>
                      </tr>

                      <div class="modal fade editwork-{{$work->id}} bd-example-modal-lg" tabindex="-1" id="mymodal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                               <div class="modal-body">
                               <form id="myform" method="post" action="{{route('workexp.update',  [$id= Crypt::encrypt($work->id)])}}">
                                 @csrf
                                 @method('post')
                                 <h5>Write NA if not applicable</h5>
                                <div class="row">
                                <div class="col-sm-6">
                                <div class="form-group">
                                  <label for="recipient-name" class="col-form-label">Position/Title</label><br>
                                  <input type="text" class="form-control" name="position" value="{{$work->position}}"  required>
                                </div>
                              </div>
                                
                                <div class="col-sm-3">
                                <div class=" form-group"> 
                                  <label for="message-text" class="col-form-label">From</label><br>
                                  <input type="date" class="form-control" name="workfrom" value="{{$work->from}}"  required>
                                </div>
                                </div>
                                <div class="col-sm-3">
                                <div class=" form-group">
                                  <label for="message-text" class="col-form-label">To</label><br>
                                  <input type="date" class="form-control" name="workto" value="{{$work->to}}"  required>
                                </div>
                                </div>
                                </div>
                              
                               
                                <div class="form-group">
                                  <label for="message-text" class="col-form-label">Agency/Company</label><br>
                                  <input type="text" class="form-control" name="company" value="{{$work->company}}"  required>
                                </div>
                                 <div class="row">
                                <div class="col-sm-3">
                                <div class="form-group">
                                  <label for="message-text" class="col-form-label">Monthly Salary ( &#8369;)</label><br>
                                  <input class="form-control" type="number" min="0.01" step="0.01" name="salary" value="{{$work->salary}}"  required>
                                </div>
                                </div>
                                <div class="col-sm-5">
                                <div class="form-group">
                                  <label for="message-text" class="col-form-label">Salary Grade & Step Increment(Format "00-0")</label><br>
                                 <input class="form-control"  type="text" name="sgrade" value="{{$work->sgrade}}"  required>
                                </div>
                                </div>

                                <div class="col-sm-4">
                                <div class="form-group">
                                  <label for="message-text" class="col-form-label">Status of Appointment</label><br>
                                  <input class="form-control"  type="text" name="appointment" value="{{$work->appointment}}"  required>
                                </div>
                                </div>
                                </div>

                                <div class="row">
                                
                             

                                <div class="col-sm-3">
                                <div class="form-group">
                                  <label for="message-text" class="col-form-label">Government Service? </label>
                                  <select class=" form-control" title="Single Select" name="gov_service"  required >
                                  <option disabled>Please Select</option>

                                  <option value="1" 
                                  @if($work->gov_service == 1) selected >Yes</option>
                                  <option value="0" @else selected @endif >No</option>
                                </select>
                                </div>
                                </div>
                              </div>

                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary btned">Save</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>

                       <div class="modal fade  deletework-{{$work->id}}" tabindex="-1" role="dialog">
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
                                    <p><strong>Position:</strong> {{$work->position}}</p>
                                    <p><strong>From:</strong> {{$work->from}}</p>
                                    <p><strong>To:</strong> {{$work->to}}</p>
                                    <p><strong>Agency/Company:</strong> {{$work->company}}</p>
                                    <p><strong>Salary:</strong> {{$work->salary}}</p>
                                    <p><strong>Salary Grade & Step Increment:</strong> {{$work->sgrade}}</p>
                                    <p><strong>Status of Appointment</strong> {{$work->appointment}}</p>
                                    <p><strong>Government Serive:</strong> {{$work->gov_service}}</p>
                                  </div>
                                </div>
                                <form  method="post" action="{{route('workexp.delete',  [$id= Crypt::encrypt($work->id)])}}">
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
        </div>
    </div>
  </div>
</div>



@endsection
