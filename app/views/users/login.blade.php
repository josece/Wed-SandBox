<div class="row">
	<div class="large-5 columns loginbox medium-6 small-centered">
		{{ Form::open(array('url'=>'user/signin', 'class'=>'form-signin','data-abide'=>'')) }}
		<h3 class="form-signin-heading">{{Lang::get('form.login')}}</h3>
	<div class="email-field">
		{{ Form::email('email', null, array('class'=>'', 'placeholder'=>Lang::get('form.emailaddress'), 'required' =>'required')) }}
		<small class="error">{{Lang::get('form.error--email')}}</small>
	</div>
	<div class="password-field">
		{{ Form::password('password', array('class'=>'', 'placeholder'=>'Password', 'required' =>'required', 'id'=>'password', 'pattern' => '(?=.*\d)(?=.*[a-zA-Z]).{4,8}$')) }}
		<small class="error">{{Lang::get('form.error--password')}}</small>
	</div>

		{{ Form::submit(Lang::get('form.login'), array('class'=>'button object--centered radius expand'))}}
		{{ Form::close() }}
		
		{{ HTML::link('user/register', Lang::get('form.account--new'))}}<br /><br />
		{{ HTML::link('password/remind',  Lang::get('reminders.title--forgot')) }}<br /><br />
		<div class="line__separator line--small object--centered"></div>
		<a href="{{ url('user/facebookauth')}}" title="{{Lang::get('form.login--facebook')}}" class="block--centered">
			<img src="{{asset('assets/img/user/facebook-login-button.png')}}" alt="{{Lang::get('form.login--facebook')}}" class="
			facebook__button--small"/>
		</a>
	</div>
</div>