<div class="row">
	<div class="large-4 columns loginbox medium-6 push--right">
		<form method="POST" action="{{url('user/create')}}" accept-charset="UTF-8" class="form-signup " data-abide>
			{{-- Form::open(array('url'=>'user/create', 'class'=>'form-signup' ,'data-abide'=>'') ) --}}
		<h3 class="form-signup-heading">Please Register</h3>


		@foreach($errors->all() as $error)
		<div class="alert-box alert">{{ $error }}<a href="#" class="close">&times;</a></div>>
		@endforeach

 	<div class="firstname-field">
		{{ Form::text('firstname', null, array('class'=>'', 'placeholder'=>'First Name', 'required' =>'required', 'pattern'=>'[a-zA-Z]+')) }}
		<small class="error">Your name can only have letters</small>
	</div>
	<div class="lastname-field">
		{{ Form::text('lastname', null, array('class'=>'', 'placeholder'=>'Last Name')) }}
	</div>
	<div class="email-field">
		{{ Form::email('email', null, array('class'=>'', 'placeholder'=>'Email Address', 'required' =>'required')) }}
		<small class="error">A valid email address is required.</small>
	</div>
	<div class="password-field">
		{{ Form::password('password', array('class'=>'', 'placeholder'=>'Password', 'required' =>'required', 'id'=>'password', 'pattern' => '(?=.*\d)(?=.*[a-zA-Z]).{4,8}$')) }}
		<small class="error">Your password must have at least one letter and number and at least 8 characters long.</small>
	</div>
	<div class="password_confirmation-field">
		{{ Form::password('password_confirmation', array('class'=>'', 'placeholder'=>'Confirm Password', 'required' =>'required', 'data-equalto' => 'password')) }}
		<small class="error">The passwords don't match.</small>
	</div>
		{{ Form::submit('Register', array('class'=>'button object--centered radius expand'))}}
		{{ Form::close() }}
		Already have an account? {{ HTML::link('user/login', 'Log in') }}.<br /><br />
		<div class="line__separator line--small object--centered"></div>
		<a href="{{ url('user/facebookauth')}}" class="block--centered">
			<img src="{{asset('assets/img/user/facebook-login-button.png')}}" class="
			facebook__button--small"/>
		</a>
	</div>
</div>
