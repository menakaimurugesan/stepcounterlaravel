@extends('layouts.app')

@section('content')

<div class="col-sm-offset-2 col-sm-8">    
	<!-- Display Validation Errors -->
    @include('common.errors')       	
	<div class="container">
		<form method="POST" action="/Auth/login" class="form-signin">
			<h2 class="form-signin-heading">Please sign in</h2>
			{!! csrf_field() !!}
			<div>Email Address</div>
			<div><input type="email" name="email" value="{{ old('email') }}"></div>
			<div>Password</div>
			<div><input type="password" name="password" id="password"></div>			
			<div><button type="submit">Login</button></div>
		</form>
	</div>	
</div>
@endsection