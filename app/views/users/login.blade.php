{{ Form::open(array('url'=>'user/signin', 'class'=>'form-signin')) }}
	<h2 class="form-signin-heading">Please Login</h2>

	{{ Form::text('email', null, array('class'=>'input-block-level', 'placeholder'=>'Email Address')) }}
	{{ Form::password('password', array('class'=>'input-block-level', 'placeholder'=>'Password')) }}

	{{ Form::submit('Login', array('class'=>'btn btn-large btn-primary btn-block'))}}
{{ Form::close() }}

<a href="{{ url('user/facebookauth')}}">
	<img src="{{asset('assets/img/user/facebook-login-button.png')}}" height="45px" />
</a>