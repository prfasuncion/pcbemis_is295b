 <html>
 <div id="logo">
        <img style="width: 400px; height: 100px;" id="pcb" src="https://www.pcbzambales.com/home/images/logo.png"/>
 </div>
<div id="company" class="clearfix">
        <div>&nbsp;</div>
        <h3>Polytechnic College of Botolan</h3>
        <div>Botolan, Zambales</div>
        <div>(+63) 949 155 3113</div>
        <div>polytechniccollegeofbotolan@gmail.com</div>
        <h3>Polytechnic College of Botolan Employee Management Information System</h3>
      </div>
<h2>WELCOME TO PCB EMIS! </h2>
<hr>
<h4>Hello <strong>{{ $name }}</strong>,</h4>
<p>
	Your account has been created. 
</p>
<div>
  <p>Your password is</p>
  <p>{{$password}}</p>
  <p>Please reset your password.</p>
</div>

  <p>Go to PCB EMIS by clicking this <a href="{{url('/login')}}">link</a></p>
</html>