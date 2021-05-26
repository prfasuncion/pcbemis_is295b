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
        <h3 class="card-title"><strong>Exit Interview</strong></h3>
      </div>
        
      <div id="project">

    </header>
    <div class="card">
      <div class="row"> 
        <div class="col-sm-12">
        <h5>Name: <u>{{ $user->user->lname.', '.$user->user->fname.' '.$user->user->name_ext}}</u></h5>
        </div>
      </div>
      <div class="card-body">
      <div class="row">
                    <div class="col-sm-12">
                      <h4 class="text-primary">Instructions: Before you begin your new journey outside the institution, please take time to asnwer this exit interview. </h4>

                    </div>
                    
                      <div class="col-sm-12">
                      <?php $count=0; ?>
                      @foreach($exit_answers as $answers)

                      @foreach($questions as $question)
                      @if($answers->question_id== $question->id)
                      <?php $count++; ?>
                      <div class="row">
                      <div class="col-sm-12">
                        <h5><strong>{{$count}}. {{$question->question}}</strong>
                        </h5>

                        <h6>Answer:</h6>
                        <div class="col-sm-12">{{$answers->answer}}</div>
                        <!-- <textarea class="form-control" width="100%" style="width: 100%;" rows="3" placeholder="Type your answer here." name="answer[{{$question->id}}]" required></textarea> -->
                      <!--   <input type="text" hidden name="quest_id[]" value="{{$question->id}}"> -->
                      </div>
                    </div>
                      <br>
                      @endif
                      @endforeach

                      @endforeach
                    </div>
                  </div>

      </div>
    </div>
    <div class="col-sm-12" style="margin-top: -20px">
      Generated via PCB EMIS on <?php echo Date("Y/m/d H:i"); ?>
     
      </div>  
  </body>
</html>
<script>
  function hh(){
    window.print();
  }

</script>