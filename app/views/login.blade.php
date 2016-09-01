<html>
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