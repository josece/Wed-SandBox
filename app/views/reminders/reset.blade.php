<div class="row">
	<div class="large-5 columns loginbox medium-6 small-centered">
	 {{ Form::open(array('url'=>'reminders/reset', 'class'=>'form-signin','data-abide'=>'')) }}
	 Email:<br /><div class="email-field">
		{{ Form::email('email', null, array('class'=>'', 'placeholder'=>'Email Address', 'required' =>'required')) }}
		<small class="error">A valid email address is required.</small>
	</div>
	Type your new password:<br /><br />
            <div class="password-field">
                {{ Form::password('password', array('id'=>'password',  'placeholder'=>'Type new password', 'pattern' => '(?=.*\d)(?=.*[a-zA-Z]).{4,8}$')) }}
                <small class="error">Your password must have at least one letter and number and at least 8 characters long.</small>
            </div>
            <div class="password_confirmation-field">
                {{ Form::password('password_confirmation', array('class'=>'', 'placeholder'=>'Confirm password', 'required' =>'required', 'data-equalto' => 'password')) }}
                <small class="error">The passwords don't match.</small>
            </div>
              {{ Form::hidden('token', $token) }}
	{{ Form::submit('Login', array('class'=>'button object--centered radius expand'))}}
	{{ Form::close() }}
</div>