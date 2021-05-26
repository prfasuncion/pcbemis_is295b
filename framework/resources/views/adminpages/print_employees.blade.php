<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>PCB EMIS</title>
     <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
   <!--  CSS Files -->
    <link href="{{ asset('material') }}/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
<style type="text/css">
  #company{
    text-align: center;
  }
  .card-header{

  }
  #logo {

  text-align: center;
  margin-top: 10px;

}
#pcb{
   height: 100px;
    width: 100px;
}
body {
  /*position: relative;
  /*width: 21cm;*/  */
  height: 29.7cm; 
  margin: 0 auto; 
  color: #001028;
  background: #FFFFFF; 
  font-family: Arial, sans-serif; 
  font-size: 12px; 
  font-family: Arial;
  width: 100% !important;
}
</style>
  </head>
  <body onload="hh()">
    <header class="clearfix">
      <div id="logo">
        <img id="pcb" src="{{ asset('material') }}/img/pcb.png"/>
      </div>
    
      <div id="company" class="clearfix">
        <div>&nbsp;</div>
        <div><h3>Polytechnic College of Botolan</h3></div>
        <div>Botolan, Zambales</div>
        <div>(+63) 949 155 3113</div>
        <div>polytechniccollegeofbotolan@gmail.com</div>
        <h3></h3>
        <h5 class="card-title"><strong>LIST OF EMPLOYEES</strong></h5>
      </div>
        
      <div id="project">

    </header>
    <div class="card">
      <div class="card-header ">
        
        <p class="card-category">
        </p>
      </div>
      <div class="card-body">
        <table class="table tablemanager">
                  <thead class=" text-primary">
                    <tr><th>
                        Name
                    </th>
                    <th>
                      Email
                    </th>
                    <th>
                      Department
                    </th>
                    <th>
                      Designation
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
                          {{$x->email }}
                        </td>
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
                        
                      </tr>
                      @endforeach
                      </tbody>
                </table>
      </div>
    </div>
    <div class="col-sm-12" style="margin-top: -20px">
      Profile is generated via PCB EMIS on <?php echo Date("Y/m/d H:i"); ?>
     
      </div>  
  </body>
</html>
<script>
  function hh(){
    window.print();
  }

</script>