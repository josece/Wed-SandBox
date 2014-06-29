<!doctype html>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<title>Authentication App With Laravel 4</title>
	{{ HTML::style('assets/css/app.css') }}
</head>

<body>
	<nav class="topnav">
		<div class="row">
			<div class="topnav__logo large-6 columns medium-6 small-4">
				<h1>Sistema</h1>
			</div>
			<div class="large-6 columns medium-6 small-8">
				<ul class="topnav__list ">  
					@if(!Auth::check())
					<li>{{ HTML::link('user/register', 'Register') }}</li>   
					<li>{{ HTML::link('user/login', 'Login') }}</li>   
					@else
					<?php $photourl = !empty($user->photo) ? $user->photo: asset("/assets/img/user/default.jpg");
					?>
					
					{{HTML::image($photourl, "Profile Picture", array('class' => 'photo--thumbnail push--left'))}}
					
					<li>{{ HTML::link('user/logout', 'Logout') }}</li>
					@endif
				</ul>  
			</div>
		</div>
	</nav>
	<div class="site__wrap">
		<div class="row">
			<div class="large-12 small-12 columns">
				@if(Session::has('message'))
				<p class="alert">{{ Session::get('message') }}</p>
				@endif
				{{$content}}
			</div>
		</div>

		<div class="container">

		</div>
	</div>

	<footer class="site__footer">

		<div class="row">
			<div class="large-6 columns text--small small-5">

				Copyright {{ date('Y') }} &copy; {{link_to('http://calleja.mx', 'CALLEJA.MX', $attributes = array('target' => '_blank', 'title' => 'CALLEJA.MX / Software Artisans'), $secure = null) }}
<br />
			</div>
			<div class="large-6 columns  text--right small-7">
				<ul class="list--inline text--small push--right">
					<li>
				Aviso de Privacidad</li> 
				<li>Términos y condiciones</li>
			</ul>
			</div>
		</div>
	</footer>
</body>
</html>