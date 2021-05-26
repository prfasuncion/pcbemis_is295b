@extends('layouts.adminapp', ['activePage' => 'employees', 'titlePage' => __('Employees')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">Employees
                <div class="float-right">
                  <a href="{{route('employee.print_list')}}" target="_blank" class="btn btn-sm btn-info">PRINT LIST OF ALL EMPLOYEES</a>
                </div>
              </h4>
              <p class="card-category"> Here you can view employee profiles</p>
            </div>
            <div class="card-body">
             <!--  <div class="photo">
                <img id="taw" width="213 " height="231 "  name="taw"  class="avatar img-circle img-thumbnail img-responsive" src="@if(isset($data)){{ $data->photo }} @endif" onerror="this.onerror=null;this.src='https://exelord.com/ember-initials/images/default-d5f51047d8bd6327ec4a74361a7aae7f.jpg';"  />

                  <br><br>
                  <h6>Click <strong> <input type="file" style="display: none;border:none;width: 300px" id="x"  name="x" accept="image/*"  onchange="PreviewImage();document.getElementById('taw').src = window.URL.createObjectURL(this.files[0])" />Image</strong> to Change Picture</h6><div class="col-xs-12">
                 

                      <button  data-toggle="collapse" data-target="#logoutModal" id="seet" value="seet" type="button" class="btn btn-primary pull-right" >Save Picture</button>


                    </div><br>
                 <input name="photo" id="photo" hidden value="@if(isset($data)){{ $data->photo }} @endif" />
                 <script>
                   $("#seet").on( "click", function() {
                      $("#photo").val($('input[type=file]').val().split('\\').pop());
                      $("#seet").hide();
                   });
                   $("#taw").click(function () {
                      $("#x").trigger('click');
                  });
                 </script>
                
              </div> -->
                              <div class="row">
                <div class="col-12 text-right">
                  <!-- <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary">Add user</a> -->
                </div>
              </div>
              <div class="table-responsive">
                <table class="table tablemanager">
                  <thead class=" text-primary">
                    <tr><th>
                        Name
                    </th>
                    <th>
                      Department
                    </th>
                    <th>
                      Designation
                    </th>
                    <th class="text-right">
                      Actions
                    </th>
                  </tr></thead>
                  <tbody>
                    @foreach ($userprofile as $x)
                        <tr>
                        <td>
                           @if(!isset($x->image))
                           <img class="card-img-top ml-auto mr-auto " src='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSQJxKGGpPc9-5g25KWwnsCCy9O_dlS4HWo5A&usqp=CAU'  id="img" style="height: 50px; width: 50px; max-height: 50px; border-radius: 50%; "> 
                            @else
                            <img class="card-img-top ml-auto mr-auto " src="<?php echo asset( $x->image); ?>"  id="img" style="height: 50px; width: 50px; max-height: 50px; border-radius: 50%; ">
                            @endif

                          
                          {{ $x->user->lname.', '.$x->user->fname }}
                       
                        
                        </td>
                        <?php $emp_dept=''; ?>
                        @foreach($dept_records as $dep_rec)

                          @if($x->id == $dep_rec->user_id && !isset($dep_rec->until))
                            @foreach($department as $dept)
                              @if($dep_rec->dept_id == $dept->id)
                                <?php $emp_dept= $dept->code; ?>
                              @else
                              @endif
                            @endforeach
                          @endif    
                        @endforeach
                        <td>
                          @if(isset($emp_dept))
                            {{$emp_dept}}
                          @else
                            {{''}}
                          @endif
                        </td>

                        
                        
                        <td>
                          <?php $emp_desig=''; ?>
                        @foreach($desig_records as $des_rec)

                          @if($x->id == $des_rec->user_id && !isset($des_rec->until))
                            @foreach($designations as $designation)
                              @if($des_rec->desig_id == $designation->id)
                               <p> {{ $designation->desig_title }} </p>
                              @else
                              @endif
                            @endforeach
                          @endif   

                        @endforeach

                         
                        </td>
                        <td class="td-actions text-right">
                              <!-- <a rel="tooltip" class="btn btn-success btn-link" href="#" data-original-title="" title="">
                              <i class="material-icons">edit</i>
                              <div class="ripple-container"></div>
                            </a> -->
                            @if($x->id == Auth::user()->id)
                            @else
                            <a rel="tooltip" class="btn btn-primary" href="{{ route('employee.view_profile', [Crypt::encrypt($x->id)]) }}" data-original-title="" title="">
                              <i class="material-icons">visibility</i> View Profile
                              <div class="ripple-container"></div>
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
<script type="text/javascript">
  setInterval(function() {
                  window.location.reload();
                }, 30000); 

</script>
<script type="text/javascript" src="{{ asset('material') }}/js/tableManager.js"></script>
<script type="text/javascript">
    // basic usage
    $('.tablemanager').tablemanager({
      firstSort: [[3,'desc']],
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