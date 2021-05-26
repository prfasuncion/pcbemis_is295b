@extends('layouts.app', ['activePage' => 'exitapp', 'titlePage' => __('Exit Application')])

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
                    <h5>Exit Application</h5>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="tab-content">
        
                <div class="tab-pane active" id="messages">
                  <div class="row">
                    <div class="col-sm-6">
                      <p>Write an exit application letter</p>
                      
                    </div>
                    <div class="col-sm-6">
                      <div class="float-right">
                      <a class="btn btn-sm btn-dark" style="color:white;">Back</a>
                    </div>
                    </div>
                    
                  </div>
                  <form action="{{route('user_exitapplication.store')}}" method="post">
                     @csrf
                     @method('post')
                  <div class="row">
                  <div class="col-sm-12">
                      
                     <textarea class="letter" id="letter" name="letter"></textarea>
                    <div class="float-right">
                     <a class="btn btn-success" data-toggle="modal" data-target=".exit_apply" style="color:white;">Submit</a>
                    </div>
                  </div>
                  </div>
                   <div class="modal fade exit_apply" tabindex="-1" id="mymodal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Submit Exit Application</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                              <p>Are you sure you wanted to submit your exit application?</p>

                              <p>Please make sure that you have carrefully read your letter, once submitted it can not be edited.</p> 
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-success" style="color:white;">Submit</button>
                              </form>
                            </div>
                          </div>
                        </div>
                   </div>

                </form>
                </div>
                
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="{{ asset('material') }}/js/tableManager.js"></script>
<script src="https://cdn.tiny.cloud/1/mcfgmuwd6krbwezb0gi8mi68jw5flsyd9dwa5hmk6ckodl0j/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>

    tinymce.init({
        selector:'textarea.letter',
        // width: 900,
        plugins: 'link',
        height: 500, 
        setup : function(ed) {
          if($(ed.getBody()).text().length===0){
                $('#finish').hide();
                $('#addmilestone').hide();
          }

        ed.on("change", function(e){
          if($(ed.getBody()).text().length===0){
                $('#finish').hide();
                $('#addmilestone').hide();
          }
          else{
                $('#finish').show();
                $('#addmilestone').show();
          }



            
        });
        ed.on("keyup", function(){
            if($(ed.getBody()).text().length===0){
                $('#finish').hide();
                $('#addmilestone').hide();
          }
          else{
                $('#finish').show();
                $('#addmilestone').show();
          }
        });
   }
    });

 
</script>
<script type="text/javascript">
    // basic usage
    $('.tablemanager').tablemanager({
      firstSort: [[5,'desc']],
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

 