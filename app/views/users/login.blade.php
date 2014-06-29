<div class="large-4 columns loginbox medium-6 push--right">
	{{ Form::open(array('url'=>'user/signin', 'class'=>'form-signin')) }}
	<h3 class="form-signin-heading">Please Login</h3>

	{{ Form::text('email', null, array('class'=>'', 'placeholder'=>'Email Address')) }}
	{{ Form::password('password', array('class'=>'', 'placeholder'=>'Password')) }}

	{{ Form::submit('Login', array('class'=>'button object--centered radius expand'))}}
{{ Form::close() }}

<div class="line__separator line--small object--centered"></div>
<a href="{{ url('user/facebookauth')}}" class="block--centered">
	<img src="{{asset('assets/img/user/facebook-login-button.png')}}" class="
facebook__button--small"/>
</a>
</div>