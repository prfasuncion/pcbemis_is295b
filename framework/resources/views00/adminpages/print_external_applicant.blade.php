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
        <h3>External Applicant</h3>
      </div>
        
      <div id="project">

    </header>
    <div class="card">
      <div class="card-header ">
        <h5 class="card-title"><strong></strong></h5>
        <p class="card-category">
        </p>
      </div>
      <div class="card-body">
        <div class="row">
                <div class="col-sm-12">
                  <h4 class="text-primary">Profile</h4>
                </div>
                <div class="col-sm-4 ml-auto mr-auto">

                         @if(!isset($external_app->image))
                           <img class="card-img-top ml-auto mr-auto " src='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSQJxKGGpPc9-5g25KWwnsCCy9O_dlS4HWo5A&usqp=CAU'  id="img" style="height: 250px; width: 250px; max-height: 250px;  "> 
                            @else
                            <img class="card-img-top ml-auto mr-auto " src="<?php echo asset($external_app->image); ?>"  id="img" style="height: 250px; width: 250px; max-height: 250px;  ">
                            @endif
                </div>
                <div class="col-sm-8">
                  <!-- <p>Last Name:</p>
                  <p>First Name:</p>
                  <p>Middle Name:</p>
                  <p>Name Extension:</p> -->
                  <table class="table table-bordered" id="profiletbl">
                    <style type="text/css">
                #profiletbl td{
                  padding: .3em;
                }
                  </style>
                    <thead></thead>
                    <tbody>
                    <tr>
                      <td width="30%">Last Name</td>
              
                      <td ><strong>{{$external_app->lname}}</strong></td>
                    
                    </tr>
                    <tr >
                      <td width="30%">First Name</td>
                  
                      <td ><strong>{{$external_app->fname}}</strong></td>
                    </tr>
                    <tr>
                      <td width="30%">Middle Name</td>
             
                      <td><strong>{{$external_app->mname}}</strong></td>
                    </tr>
                    <tr>
                      <td width="30%">Name Extension</td>
                
                      <td><strong>{{$external_app->name_ext}}
                          @if(!isset($external_app->name_ext))
                          N/A
                          @endif
                        </strong>
                      </td>
                    </tr>
                    <tr>
                      <td width="30%">Birthday</td>
                 
                      <td><strong>{{$external_app->bday}}</strong></td>
                    </tr>
                    <tr>
                      <td width="30%">Contact Number</td>
                 
                      <td ><strong>{{$external_app->contact}}</strong></td>
                    </tr>
                    <tr>
                      <td width="30%">E-mail</td>
                   
                      <td><strong>{{$external_app->email}}</strong></td>
                    </tr>
                   
                  </tbody>
                  </table>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-sm-12">
                  <h4 class="text-primary">Application Intent</h4>
                </div>
                <div class="col-sm-12">
                  {!!$external_app->intent!!}
                </div>
              </div>
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