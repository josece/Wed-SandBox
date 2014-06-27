<h1>Edit User</h1>
{{ Form::open(array('url'=>'user/update/' . $user->id, 'class'=>'form-signin')) }}

    <ul>
        <li>
            {{ Form::label('password', 'Password:') }}
            {{ Form::text('password') }}
        </li>
        <li>
            {{ Form::label('email', 'Email:') }}
            {{ Form::text('email', $user->email ) }}
        </li>
        <li>
            {{ Form::label('firstname', 'First Name:') }}
            {{ Form::text('firstname', $user->firstname) }}
        </li>
        <li>
            {{ Form::label('lastname', 'Last Name:') }}
            {{ Form::text('lastname', $user->lastname) }}
        </li>
        <li>
            {{ Form::submit('Update', array('class' => 'btn btn-info')) }}
          
        </li>
    </ul>
{{ Form::close() }}