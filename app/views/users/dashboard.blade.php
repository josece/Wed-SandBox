<h1>Dashboard</h1>

@if (!empty($data))
    Hello, {{{ $data['firstname'] }}} 
	
    <br>
    Your email is {{ $data['email']}}
    <br>
    @endif