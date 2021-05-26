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
                      <a class="nav-link" href="{{url('userprofile/work_experience')}}">
                        <i class="material-icons">work</i> WORK EXPERIENCE
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" href="{{url('userprofile/ldi')}}">
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
                              <form  method="post" action="{{route('ldi.store')}}">
                                 @csrf
                                 @method('post')
                                 <h5>Write NA if not applicable</h5>
                                <div class="form-group">
                                  <label for="recipient-name" class="col-form-label">Learning Development Interventions/Training Program</label><br>
                                  <input type="text" class="form-control" name="training" required >
                                </div>
                                <div class="row">
                                <div class="col-sm-4">
                                <div class="form-group">
                                  <label for="message-text" class="col-form-label">From:</label><br>
                                  <input type="date" class="form-control" name="from" required>
                                </div>
                                </div>
                                <div class="col-sm-4">
                                <div class="form-group">
                                  <label for="message-text" class="col-form-label">To</label><br>
                                  <input type="date" class="form-control" name="to" required>
                                </div>
                                </div>
                                <div class="col-sm-4">
                                <div class="form-group">
                                  <label for="message-text" class="col-form-label">Number of Hours</label><br>
                                  <input type="text" class="form-control" name="hours" required>
                                </div>
                                </div>
                                </div>


                                <div class="row">
                                <div class="col-sm-6">
                                <div class="form-group">
                                  <label for="message-text" class="col-form-label">Type</label><br>
                                  <input type="text" class="form-control" name="type" required >
                                </div>
                                </div>
                                
                                <div class="col-sm-6">
                                <div class="form-group">
                                  <label for="message-text" class="col-form-label">Conducted/Sponsored by</label><br>
                                  <input type="text" class="form-control" name="conducted" required>
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
                    <h5><strong>LEARNING & DEVELOPMENT INTERVENTIONS (LDI)</strong></h5>
                  </div>
                  <div class="col-sm-6">
                    <button type="button" id="addeducbtn" class="btn btn-warning addeducbtn pull-right" data-toggle="modal" data-target=".bd-example-modal-lg">{{ __('Add') }}</button>
                  </div>
                  </div>
                  
                  <table class="table" id="educbg">
                    <thead class="text-primary">
                      <th>LDI/Training Program</th>
                      <th>From</th>
                      <th>To</th>
                      <th>Number of Hours</th>
                      <th>Type of LD</th>
                      <th>Conducted/Sponsored by</th>
                   
                      <th class="td-action text-right" >Action</th>
                    </thead>
                    <tbody>
                      
                      @foreach($user_ldi as $ldi)
                      <tr>
                        <td>{{$ldi->training}}</td>
                        <td>{{$ldi->from}}</td>
                        <td>{{$ldi->to}}</td>
                        <td align="center">{{$ldi->hours}}</td>
                        <td>{{$ldi->type}}</td>
                        <td>{{$ldi->conducted}}</td>
                        <td class="td-action text-right">
                            <button title="Edit"  class="btn btn-primary  btn-sm" data-toggle="modal" data-target=".editldi-{{$ldi->id}}"><i class="material-icons">edit</i></button>

                          <button title="Delete"  class="btn btn-danger btn-sm " data-toggle="modal" data-target=".deleteldi-{{$ldi->id}}"><i class="material-icons">close</i></button>
                        </td>
                      </tr>

                       <div class="modal fade editldi-{{$ldi->id}} bd-example-modal-lg" tabindex="-1" id="mymodal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                               <div class="modal-body">
                              <form  method="post" action="{{route('ldi.update', [$id= Crypt::encrypt($ldi->id)])}}">
                                 @csrf
                                 @method('post')
                                <div class="form-group">
                                  <label for="recipient-name" class="col-form-label">Learning Development Interventions/Training Program</label><br>
                                  <input type="text" class="form-control" name="training" value="{{$ldi->training}}" required >
                                </div>
                                <div class="row">
                                <div class="col-sm-4">
                                <div class="form-group">
                                  <label for="message-text" class="col-form-label">From:</label><br>
                                  <input type="date" class="form-control" name="from" value="{{$ldi->from}}" required>
                                </div>
                                </div>
                                <div class="col-sm-4">
                                <div class="form-group">
                                  <label for="message-text" class="col-form-label">To</label><br>
                                  <input type="date" class="form-control" name="to" value="{{$ldi->to}}" required >
                                </div>
                                </div>
                                <div class="col-sm-4">
                                <div class="form-group">
                                  <label for="message-text" class="col-form-label">Number of Hours</label><br>
                                  <input type="text" class="form-control" name="hours" value="{{$ldi->hours}}" required>
                                </div>
                                </div>
                                </div>


                                <div class="row">
                                <div class="col-sm-6">
                                <div class="form-group">
                                  <label for="message-text" class="col-form-label">Type</label><br>
                                  <input type="text" class="form-control" name="type" value="{{$ldi->type}}" required>
                                </div>
                                </div>
                                
                                <div class="col-sm-6">
                                <div class="form-group">
                                  <label for="message-text" class="col-form-label">Conducted/Sponsored by</label><br>
                                  <input type="text" class="form-control" name="conducted" value="{{$ldi->conducted}}" required >
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

                       <div class="modal fade  deleteldi-{{$ldi->id}}" tabindex="-1" role="dialog">
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
                                    <p><strong>Training:</strong> {{$ldi->training}}</p>
                                    <p><strong>From:</strong> {{$ldi->from}}</p>
                                    <p><strong>To:</strong> {{$ldi->to}}</p>
                                    <p><strong>Number of Hours:</strong> {{$ldi->hours}}</p>
                                    <p><strong>Type:</strong> {{$ldi->type}}</p>
                                    <p><strong>Conducted/Sponsored by:</strong> {{$ldi->conducted}}</p>
                                   
                                  </div>
                                </div>
                                <form  method="post" action="{{route('ldi.delete',  [$id= Crypt::encrypt($ldi->id)])}}">
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
@endsection
