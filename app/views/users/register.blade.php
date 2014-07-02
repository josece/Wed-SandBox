<div class="row">
	<div class="large-5 columns loginbox medium-6 small-centered">
			{{ Form::open(array('url'=>'user/create', 'class'=>'form-signup' ,'data-abide'=>'') ) }}
		<h3 class="form-signup-heading">{{Lang::get('form.signup')}}</h3>

		@foreach($errors->all() as $error)
		<div class="alert-box alert">{{ $error }}<a href="#" class="close">&times;</a></div>
		@endforeach

 	<div class="firstname-field">
		{{ Form::text('firstname', null, array('class'=>'', 'placeholder'=>Lang::get('form.firstname').'*', 'required' =>'required')) }}
		<small class="error">{{Lang::get('form.error--firstname')}}</small>
	</div>
	<div class="lastname-field">
		{{ Form::text('lastname', null, array('class'=>'', 'placeholder'=>Lang::get('form.lastname'))) }}
	</div>
	<div class="email-field">
		{{ Form::email('email', null, array('class'=>'', 'placeholder'=>Lang::get('form.emailaddress').'*', 'required' =>'required')) }}
		<small class="error">{{Lang::get('form.error--email')}}</small>
	</div>
	<div class="password-field">
		{{ Form::password('password', array('class'=>'', 'placeholder'=>Lang::get('form.password').'*', 'required' =>'required', 'id'=>'password', 'pattern' => '(?=.*\d)(?=.*[a-zA-Z]).{4,8}$')) }}
		<small class="error">{{Lang::get('form.error--password')}}</small>
	</div>
	<div class="password_confirmation-field">
		{{ Form::password('password_confirmation', array('class'=>'', 'placeholder'=>Lang::get('form.password--repeat').'*', 'required' =>'required', 'data-equalto' => 'password')) }}
		<small class="error">{{Lang::get('form.error--passwordmatch')}}</small>
	</div>
	<small class="right">{{Lang::get('form.requiredfields')}}</small><br /><br/>
		{{ Form::submit(Lang::get('form.signup'), array('class'=>'button object--centered radius expand'))}}
		{{ Form::close() }}
		{{Lang::get('form.account--already')}} {{ HTML::link('user/login', Lang::get('form.login')) }}.<br /><br />
		<div class="line__separator line--small object--centered"></div>
		<a href="{{ url('user/facebookauth')}}" title="{{Lang::get('form.login--facebook')}}" class="block--centered">
			<img src="{{asset('assets/img/user/facebook-login-button.png')}}" alt="{{Lang::get('form.login--facebook')}}" class="
			facebook__button--small"/>
		</a>
	</div>
</div>