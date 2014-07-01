<div class="row">
	<div class="large-5 columns loginbox medium-6 small-centered">
		{{ Form::open(array('url'=>'user/signin', 'class'=>'form-signin','data-abide'=>'')) }}
		<h3 class="form-signin-heading">Please Login</h3>
	<div class="email-field">
		{{ Form::email('email', null, array('class'=>'', 'placeholder'=>'Email Address', 'required' =>'required')) }}
		<small class="error">A valid email address is required.</small>
	</div>
	<div class="password-field">
		{{ Form::password('password', array('class'=>'', 'placeholder'=>'Password', 'required' =>'required', 'id'=>'password', 'pattern' => '(?=.*\d)(?=.*[a-zA-Z]).{4,8}$')) }}
		<small class="error">Your password must have at least one letter and number and at least 8 characters long.</small>
	</div>

		{{ Form::submit('Login', array('class'=>'button object--centered radius expand'))}}
		{{ Form::close() }}
		
		{{ HTML::link('user/register', 'Create an account') }}<br /><br />
		{{ HTML::link('reminders/remind', 'Forgot your password?') }}<br /><br />
		<div class="line__separator line--small object--centered"></div>
		<a href="{{ url('user/facebookauth')}}" class="block--centered">
			<img src="{{asset('assets/img/user/facebook-login-button.png')}}" class="
			facebook__button--small"/>
		</a>
	</div>
</div>