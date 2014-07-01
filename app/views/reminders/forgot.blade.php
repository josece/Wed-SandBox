<div class="row">
	<div class="large-5 columns loginbox medium-6 small-centered">
		{{ Form::open(array('url'=>'reminders/remind', 'class'=>'form-signin','data-abide'=>'')) }}
		<h3 class="form-signin-heading">Forgot your password?</h3>
		<p>Get a link to reset it</p>
<div class="email-field">
		{{ Form::email('email', null, array('class'=>'', 'placeholder'=>'Email Address', 'required' =>'required')) }}
		<small class="error">A valid email address is required.</small>
	</div>
	

		{{ Form::submit('Send me a link', array('class'=>'button object--centered radius expand'))}}
		{{ Form::close() }}
		Already remembered? {{ HTML::link('user/login', 'Log in') }}.<br /><br />
		
	</div>
</div>