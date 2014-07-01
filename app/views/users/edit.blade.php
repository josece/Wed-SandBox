<div class="row">
    <div class="large-5 medium-6 columns small-centered loginbox"><h3>Edit User</h3>
        {{ Form::open(array('url'=>'user/update/', 'class'=>'form-signin ajax','data-abide'=>'')) }}

        <ul class="no-bullet">

            <li>
                <div class="email-field">
                {{ Form::label('email', 'Email:') }}
                {{ Form::email('email', $user->email , array('required' =>'required', 'placeholder'=>'Email address')) }}
                <small class="error">A valid email address is required.</small>
                </div>
            </li>
            <div class="firstname-field">
        
        
    </div>
            <li>
                {{ Form::label('firstname', 'First Name:') }}
                {{ Form::text('firstname', $user->firstname, array('required' =>'required',  'placeholder'=>'First namePassword', 'pattern'=>'[a-zA-Z]+')) }}
                <small class="error">Your name can only have letters</small>
            </li>
            <li>
                {{ Form::label('lastname', 'Last Name:') }}
                {{ Form::text('lastname', $user->lastname , array( 'placeholder'=>'Last name')) }}
            </li>
            <li>
                {{ Form::submit('Update', array('class' => 'button')) }}

            </li>
        </ul>
            <hr />
            Change your password:<br /><br />
            <div class="password-field">
                {{ Form::password('password', array('id'=>'password',  'placeholder'=>'Type new password', 'pattern' => '(?=.*\d)(?=.*[a-zA-Z]).{4,8}$')) }}
                <small class="error">Your password must have at least one letter and number and at least 8 characters long.</small>
            </div>
            <div class="password_confirmation-field">
                {{ Form::password('password_confirmation', array('class'=>'', 'placeholder'=>'Confirm password', 'data-equalto' => 'password')) }}
                <small class="error">The passwords don't match.</small>
            </div>
           
                {{ Form::submit('Change Password', array('class' => 'button')) }}

           
        {{ Form::close() }}
    </div>
</div>