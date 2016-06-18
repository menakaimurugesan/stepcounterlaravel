@extends('layouts.app')

@section('content')
<div class="col-sm-offset-2 col-sm-8">
	<!-- Display Validation Errors -->
    @include('common.errors')      
	<div class="container">
		<form method="POST" action="/Auth/register">
			{!! csrf_field() !!}
			<h2 class="form-signin-heading">Please register</h2>
			<div>Name</div>
			<div><input type="text" name="name" value="{{ old('name') }}"></div>
			<div>Email</div>
			<div><input type="email" name="email" value="{{ old('email') }}"></div>
			<div>Password</div>
			<div><input type="password" name="password"></div>
			<div>Confirm Password</div>
			<div><input type="password" name="password_confirmation"></div>
			<div><button type="submit">Register</button></div>
		</form>
	</div>	
</div>
@endsection