<div class="large-4 columns loginbox medium-6 push--right">
	{{ Form::open(array('url'=>'user/create', 'class'=>'form-signup')) }}
	<h2 class="form-signup-heading">Please Register</h2>

	<ul>
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>

	{{ Form::text('firstname', null, array('class'=>'', 'placeholder'=>'First Name')) }}
	{{ Form::text('lastname', null, array('class'=>'', 'placeholder'=>'Last Name')) }}
	{{ Form::text('email', null, array('class'=>'', 'placeholder'=>'Email Address')) }}
	{{ Form::password('password', array('class'=>'', 'placeholder'=>'Password')) }}
	{{ Form::password('password_confirmation', array('class'=>'', 'placeholder'=>'Confirm Password')) }}

	{{ Form::submit('Register', array('class'=>'button object--centered radius expand'))}}
{{ Form::close() }}
<div class="line__separator line--small object--centered"></div>
<a href="{{ url('user/facebookauth')}}" class="block--centered">
	<img src="{{asset('assets/img/user/facebook-login-button.png')}}" class="
facebook__button--small"/>
</a>
</div>