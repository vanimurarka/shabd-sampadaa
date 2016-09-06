<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>शब्द सम्पदा लॉग इन: Shabd Sampadaa Login: Hindi Thesaurus</title>
</head>
<body>

@if(Session::has('message'))
	<div class="centerDiv">
		<br/><b>{{Session::get('message')}}</b>
	</div>
@endif
<div class="sec-heading">
	Login
</div>
		
{{ Form::open(array('action' => 'UserController@login')) }}

@if (count($errors)>0)
    <div class="centerDiv error">
    	<ul>
		    @foreach($errors->all() as $error)
		        <li>{{ $error }}</li>
		    @endforeach
		</ul>
	</div>
@endif


<div class="centerDiv">
    <div class="formDiv">Email</div>
    {{ Form::text('email', null, array('placeholder'=>'Email Address')) }}
    <div class="formDiv">Password</div>
    {{ Form::password('password', array('placeholder'=>'Password')) }}
	{{ Form::submit('Login',array('class'=>'submit')) }}
	{{ Form::close() }}
</div>

</body>
</html>