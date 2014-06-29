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
  				<div class="topnav__logo large-6 columns">
  					<h1>Sistema</h1>
  				</div>
  				<div class="large-6 columns">
  					<ul class="topnav__list ">  
						@if(!Auth::check())
							<li>{{ HTML::link('user/register', 'Register') }}</li>   
							<li>{{ HTML::link('user/login', 'Login') }}</li>   
						@else
							<li>{{ HTML::link('user/logout', 'Logout') }}</li>
						@endif
					</ul>  
  				</div>
  			</div>
  		</nav>

<div class="row">
	<div class="large-12 small-12">
		@if(Session::has('message'))
		<p class="alert">{{ Session::get('message') }}</p>
		@endif
		{{$content}}
	</div>
</div>

	    <div class="container">
	    	
	    </div>

  	</body>
</html>