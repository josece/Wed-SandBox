@if(Session::has('message'))
    {{ Session::get('message')}}
@endif
<br>
@if (!empty($data))
    Hello, {{{ $data['firstname'] }}} 
	<?php $photourl = !empty($data['photo']) ? $data['photo']: asset("/assets/img/user/default.jpg");
	?>
	<img src="{{  $photourl }}"> 

    <br>
    Your email is {{ $data['email']}}
    <br>
    <a href="user/logout">Logout</a>
@else
    Hi! Would you like to <a href="user/facebookauth">Login with Facebook</a>?
@endif