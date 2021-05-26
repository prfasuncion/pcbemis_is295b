<h4 style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; color: #4485b8; text-align: center;"><span style="color: #000000;">Hello {{$external->fname.' '.$external->mname.' '.$external->lname.' '.$external->name_ext}}!</span></h4>
<hr />
<h1 style="color: #4485b8; text-align: center;"><strong>THANK YOU FOR YOUR APPLICATION</strong></h1>
<hr />
<p style="text-align: center;"><span style="color: #000000;"><b>We have received your application.&nbsp;</b></span></p>
<p style="text-align: center;"><span style="color: #000000;">Please give us a moment as we review the application you have submitted. We will send an email to your inbox directly as soon.</span></p>

<p style="text-align: center;"><span style="color: #000000;">For queries and concerns please contact us through our email <span style="color: #3366ff;">polytechniccollegeofbotolan@gmail.com</span>&nbsp;. Here is our contact number <span class="fa fa-phone"></span> (+63) 949 155 3113.&nbsp;</span></p>

<!DOCTYPE html>
<html lang="en">
    <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
         <!--     Fonts and icons     -->
         <title>Job Opportunities Application</title>

        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

           
    </head>



  
 <body>

  <!-- Page Wrapper -->
  <div id="wrapper" >
     
    
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">


              <center>
          <div class="col-xl-11">

                <div class="card shadow mb-4 "  >
                <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 bg-gradient-info">
                      <h3 class="m-0 font-weight-bold text-gray-100">Your Application Summary
                      </h3>

                    </div>     
                    <div class="card-body">
                      <div class="row">
                     
                        <div class="col-sm-12">
                          <table class="table">
                            <tr>
                              <td width="30%">Name</td>
                              <td width="5%">:</td>
                              <td>{{$external->fname.' '.$external->mname.' '.$external->lname.' '.$external->name_ext}}</td>
                            </tr>
                            <tr>
                              <td width="30%">Email</td>
                              <td width="5%">:</td>
                              <td>{{$external->email}}</td>
                            </tr>
                            <tr>
                              <td width="30%">Contact</td>
                              <td width="5%">:</td>
                              <td>{{$external->contact}}</td>
                            </tr>
                            <tr>
                              <td width="30%">Birthday</td>
                              <td width="5%">:</td>
                              <td>{{$external->bday}}</td>
                            </tr>
                            <tr>
                              <td width="30%">Address</td>
                              <td width="5%">:</td>
                              <td>{{$external->street.', '.$external->brgy.','.$external->city.', '.$external->province}}</td>
                            </tr>
                          </table>
                        </div>
                        <div class="col-sm-12">
                          <h3>Application Intent</h3>
                          {!!$external->intent!!}
                        </div>
                      </div>

                       
                    </div>
                       
                    <br>

                             
                          
                </div>  
          </div>          
      </div>
               

             
    
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->  
 


</form>

   
    
    </body>
    

  
</html>