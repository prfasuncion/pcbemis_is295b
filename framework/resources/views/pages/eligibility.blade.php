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
                      <a class="nav-link active" href="{{url('userprofile/eligibility')}}">
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
                              <form id="myform" method="post" action="{{route('eligibility.store')}}">
                                 @csrf
                                 @method('post')
                                 <h5>Write NA if not applicable</h5>
                                <div class="form-group">
                                  <label for="eligibility" class="col-form-label">Eligibility</label><br>
                                  <input type="text" class="form-control" name="eligibility" required >
                                </div>
                                
                                <div class="form-group">
                                  <label for="rating" class="col-form-label">Rating:</label><br>
                                  <input type="text" class="form-control" name="rating" required >
                                </div>
                                <div class="form-group">
                                  <label  for="date_exam" class="col-form-label">Date of Examination/Conferment</label><br>
                                  <input type="date" class="form-control" name="date_exam" required >
                                </div>
                                
                          
                                <div class="form-group">
                                  <label for="place" class="col-form-label">Place of Examination/Conferment</label>
                                  <br>
                                  <input type="text" class="form-control" name="place" required >
                                </div>

                                <div class="form-group">
                                  <label for="license" class="col-form-label">License number</label>
                                  <br>
                                  <input type="text" class="form-control" name="license" required >
                                </div>
                                <div class="form-group">
                                  <label  for="date_valid" class="col-form-label">Date of Validity</label><br>
                                  <input type="date" class="form-control" name="date_valid" required  >
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
                    <h5><strong>Eligibility</strong></h5>
                  </div>
                  <div class="col-sm-6">
                    <button type="button" id="addeducbtn" class="btn btn-warning addeducbtn pull-right" data-toggle="modal" data-target=".bd-example-modal-lg">{{ __('Add') }}</button>
                  </div>
                  </div>
                  <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <tr>
                      <th>Eligibility</th>
                      <th>Rating</th>
                      <th>Date of Exmination/Conferment</th>
                      <th>Place of Exmination/Conferment</th>
                      <th>License No.</th>
                      <th>Date of Validity</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                      

                      @foreach($user_eligibility as $eligibility)
                      
                      <tr>
                        <td>{{$eligibility->eligibility}}</td>
                        <td>{{$eligibility->rating}}</td>
                        <td>{{$eligibility->date_exam}}</td>
                        <td>{{$eligibility->place}}</td>
                        <td>{{$eligibility->license}}</td>
                        <td>{{$eligibility->validity}}</td>
                  
                        <td class="text-right td-action" >
                         
                          <button title="Edit"  class="btn btn-primary btn-sm " data-toggle="modal" data-target=".edit_ed-{{$eligibility->id}}"><i class="material-icons">edit</i></button>

                          <button title="Delete"  class="btn btn-danger btn-sm  " data-toggle="modal" data-target=".delete-{{$eligibility->id}}"><i class="material-icons">close</i></button>
                          
                        </td>
                      </tr>
                          <div class="modal fade  delete-{{$eligibility->id}}" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title">Delete</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <p>Are you sure you want to delete this?</p>
                                  <div>
                                    <p>Eligibility: {{$eligibility->eligibility}}</p>
                                    <p>Rating: {{$eligibility->rating}}
                                    </p>
                                    <p>Date of Examination: {{$eligibility->date_exam}}</p>
                                    <p>Place: {{$eligibility->place}}</p>
                                    <p>License Number: {{$eligibility->license}}</p>
                                    <p>Date of Validity: {{$eligibility->validity}}</p>
                                  </div>
                                </div>
                                <form  method="post" action="{{route('eligibility.delete',  [$id= Crypt::encrypt($eligibility->id)])}}">
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
                        
                          <div class="modal fade edit_ed-{{$eligibility->id}}" tabindex="-1" id="edit_educ" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                               <div class="modal-body">
                              <form id="myform" method="post" action="{{route('eligibility.update',  [$id= Crypt::encrypt($eligibility->id)])}}">
                                 @csrf
                                 @method('post')
                                <div class="form-group">
                                  <label for="eligibility" class="col-form-label">Eligibility</label><br>
                                  <input type="text" class="form-control" name="eligibility" value="{{$eligibility->eligibility}}" required >
                                </div>
                                
                                <div class="form-group">
                                  <label for="rating" class="col-form-label">Rating:</label><br>
                                  <input type="text" class="form-control" name="rating" value="{{$eligibility->rating}}" required >
                                </div>
                                <div class="form-group">
                                  <label  for="date_exam" class="col-form-label">Date of Examination/Conferment</label><br>
                                  <input type="date" class="form-control" name="date_exam" value="{{$eligibility->date_exam}}" required >
                                </div>
                                
                          
                                <div class="form-group">
                                  <label for="place" class="col-form-label">Place of Examination/Conferment</label>
                                  <br>
                                  <input type="text" class="form-control" name="place" value="{{$eligibility->place}}" required >
                                </div>

                                <div class="form-group">
                                  <label for="license" class="col-form-label">License number</label>
                                  <br>
                                  <input type="text" class="form-control" name="license" value="{{$eligibility->license}}" required >
                                </div>
                                <div class="form-group">
                                  <label  for="date_valid" class="col-form-label">Date of Validity</label><br>
                                  <input type="date" class="form-control" name="date_valid" value="{{$eligibility->validity}}" required >
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

  