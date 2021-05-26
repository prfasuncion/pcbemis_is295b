@extends('layouts.adminapp', ['activePage' => 'acadyear', 'titlePage' => __('Academic Year Setting> Semester')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">A.Y. {{$sem->start_ay}}-{{$sem->end_ay}} Setting</h4>
              <p class="card-category"> Here you can manage active Semester</p>
            </div>
            <div class="card-body">
                              <div class="row">
                <div class="col-12 text-right">
                  <a href="{{ route('acadyear.index') }}" class="btn btn-sm btn-primary">Back to Academic Year</a>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table">
                  <thead class=" text-primary">

                 
                    <tr><th>
                        Semester
                    </th>
                    <th>
                      Status
                    </th>
               <!--      <th>
                      Creation date
                    </th> -->
                    <th class="text-right">
                      Actions
                    </th>
                  </tr></thead>
                  <tbody>
                          @foreach($the_sem as $sems)
                        <tr>
                          
                        <td>
                          {{$sems->name}}
                        
                	
                        </td>
                    
                        <td>
                         
                         @if ($sems->status == 0)
                          {{ 'Inactive' }}
                          @else
                           {{'Active'}}
                          @endif
                        </td>
                   <!--      <td>
                  
                        </td> -->
                        <td class="td-actions text-right">

                           @if ($sems->status == 0)
                         <!--  <button type="submit" class="btn btn-primary">{{ __('Activate') }}</button> -->

                           <button type="button" class="btn btn-primary" data-toggle="modal"  data-backdrop="static" data-keyboard="false" data-target="#myModal-{{$sems->name}}">{{ __('Activate')  }}</button>

                              <!-- Modal -->
                            <div id="myModal-{{$sems->name}}" class="modal fade" role="dialog">
                              <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h4 class="modal-title">Warning!</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    
                                  </div>
                                  <div class="modal-body" align="left">

                                    <p>You are about to Activate the term, the information available will be for this specific term. <br>Are you sure you wanted to activate {{$sems->name}} A.Y. {{$sem->start_ay}}-{{$sem->end_ay}}?</p>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                                    <form action="{{ route('sem.update', [$id= Crypt::encrypt($sems->id)] )}}" method="post">
                                       @csrf
                                    @method('post')
                                      <button type="submit" class="btn btn-primary" >Activate</button>
                                    </form>
                                  </div>
                                </div>

                              </div>
                            </div>



                          @else
                          
                          @endif
                                                       <!--  <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('sem.index', [Crypt::encrypt($sems->ay_id)]) }}" data-original-title="" title=""> -->
                          
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
  </div>
</div>
@endsection