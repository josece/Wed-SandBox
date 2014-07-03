<!doctype html>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8" />
	{{--<meta name="viewport" content="width=device-width, initial-scale=1.0" />--}}
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<title>{{$appname}}
		@if(isset($title)) 
		/ {{$title}}
		@endif
	</title>
	{{ HTML::style('assets/css/app.css') }}
</head>

<body>

	<div class="off-canvas-wrap site__wrap" data-offcanvas>
    <div class="inner-wrap">
    	<header class="nav-down header">
    		<nav class="top-bar topnav" data-topbar>
    			<section class="show-for-small ">
    				<div class="toggle-topbar  menu-icon left">
    					<a class="left-off-canvas-toggle " href="#">{{Lang::get('global.menu')}}<span></span></a>
    				</div>
    			</section>
    			<section class="topnav__logo small-centered large-uncentered small-4 medium-3 large-4 columns">
    				<a href="{{url('user/home')}}" ><h1 class="left">{{Lang::get('global.appname')}}</h1></a>
    			</section>
    			<section class="top-bar-section">
    				@if(!Auth::check())
    				<ul class="right hide-for-small">
    					<li class="{{ (strpos(URL::current(), URL::to('user/register'))!== false) ? 'active' : '' }}">{{ HTML::link('user/register', Lang::get('form.signup')) }}</li>   
    					<li class="{{ (strpos(URL::current(), URL::to('user/login'))!== false) ? 'active' : '' }}">{{ HTML::link('user/login', Lang::get('form.login')) }}</li>   
    				</ul>
    				@else


    				<ul class="right hide-for-small">	
    					<li class="has-dropdown">
    						<a href="#">
    							<?php $photourl = !empty($user->photo) ? $user->photo: Config::get('configuration.picture--default');?>
    							{{HTML::image($photourl, Lang::get('global.profilepic'), array('class' => 'photo--thumbnail left hide-for-small'))}}
    							{{$user->firstname}}
    						</a>
    						<ul class="dropdown">
    							@if($user->role_id > 2)
    								<li>{{ HTML::link('admin', Lang::get('global.admin')) }}</li> 
    							@endif
    							<li>{{ HTML::link('user/edit', Lang::get('global.editinfo')) }}</li>
    							<li>{{ HTML::link('user/logout', Lang::get('global.logout')) }}</li>
    						</ul>
    					</li>
    				</ul>
    					@if($user->role_id > 2)
    						<ul class="right">
    							<li class="{{ (strpos(URL::current(), URL::to('admin/users'))!== false) ? 'active' : '' }}">
    								{{ HTML::link('admin/users', Lang::get('form.users'))}}</li>   
    						</ul>
    					@endif
    				@endif			
    			</section>
    		</nav>
    	</header>
	<aside class="left-off-canvas-menu">
		<ul class="off-canvas-list">
			<li class="show-for-small">
				<label>{{$appname}}</label>
			</li>
			@if(Auth::check())
			<li>{{HTML::image($photourl, Lang::get('global.profilepic'), array('class' => 'photo--thumbnail left '))}}
			<a href="#">{{$user->firstname}}</a> </li>
				@if($user->role_id > 2)<li>{{ HTML::link('admin', Lang::get('global.admin')) }}</li>
				<li></li>
				@endif
			<li><label>{{Lang::get('global.navigation')}}</label></li>
			<li>{{ HTML::link('user/edit', Lang::get('global.editinfo')) }}</li>
    		<li>{{ HTML::link('user/logout', Lang::get('global.logout')) }}</li>
            <hr />
            @else
            <li class="{{Request::is('user/register') ? 'active' : ''}}">{{ HTML::link('user/register', Lang::get('form.signup')) }}</li>   
    					<li class="{{Request::is('user/login') ? 'active' : ''}}">{{ HTML::link('user/login', Lang::get('form.login')) }}</li>   
            @endif
            <li>{{ HTML::link('terms', Lang::get('global.termsofuse')) }}</li>
    		<li>{{ HTML::link('privacy-notice', Lang::get('global.privacynotice')) }}</li>
    		<li></li>
            <li><label>{{Lang::get('global.builtby')}}</label>{{ HTML::link('http://calleja.mx', 'CALLEJA.MX') }}</li>
		</ul>
	</aside>
<section class="main-content">
		<div class="row alert__row">
			<div class="large-12 small-12 columns alert__container">
				@if(Session::has('message'))
				<div data-alert class="alert-box large-6 small-centered columns">
					{{ Session::get('message') }}
					<a href="#" class="close">&times;</a>
				</div>
				@endif
				@if(Session::has('success'))
				<div data-alert class="alert-box success large-6 small-centered columns">
					{{ Session::get('success') }}
					<a href="#" class="close">&times;</a>
				</div>
				@endif
				@if(Session::has('alert'))
				<div data-alert class="alert-box alert large-6 small-centered columns" >
					{{ Session::get('alert') }}
					<a href="#" class="close">&times;</a>
				</div>
				@endif	
			</div>
		</div>
		{{$content}}
	</section>
		 <a class="exit-off-canvas"></a>
	</div>
</div>
	<footer class="site__footer hide-for-small">

		<div class="row">
			<div class="large-6 columns text--small small-5">

				Copyright {{ date('Y') }} &copy; {{link_to('http://calleja.mx', 'CALLEJA.MX', $attributes = array('target' => '_blank', 'title' => 'CALLEJA.MX / Software Artisans'), $secure = null) }}
<br />
			</div>
			<div class="large-6 columns  text-right small-7">
				<ul class="inline-list text--small right list--nomargin">
					<li>
				{{Lang::get('global.termsofuse')}}</li> 
				<li>{{Lang::get('global.privacynotice')}}</li>
			</ul>
			</div>
		</div>
	</footer>
	{{ HTML::script('assets/js/vendor/jquery.js') }}
	{{ HTML::script('assets/js/vendor/modernizr.js') }}
	{{ HTML::script('assets/js/foundation/foundation.js') }}
	{{ HTML::script('assets/js/foundation/foundation.alert.js') }}
	{{ HTML::script('assets/js/foundation/foundation.topbar.js') }}
	{{ HTML::script('assets/js/foundation/foundation.offcanvas.js') }}
	{{ HTML::script('assets/js/vendor/jquery.mobile.custom.min.js')}}
	{{ HTML::script('assets/js/script.js') }}
{{--If the array of custom script files exist, we print it--}}
@if(isset($scripts)) @foreach ($scripts as $script)
	{{ HTML::script($script) }}
@endforeach @endif
	<script>
    $(document).foundation();
    @if(isset($script_verbose))
    	{{$script_verbose}}
    @endif
  </script>
</body>
</html>