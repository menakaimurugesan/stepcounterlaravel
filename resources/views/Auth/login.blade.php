@extends('layouts.app')

@section('content')

<div class="col-sm-offset-2 col-sm-8">
    <div class="panel panel-default">
		<!-- Display Validation Errors -->
        @include('common.errors')       
		<div class="panel-body">
			<form method="POST" action="/Auth/login">
				{!! csrf_field() !!}

				<div>
					Email
					<input type="email" name="email" value="{{ old('email') }}">
				</div>

				<div>
					Password
					<input type="password" name="password" id="password">
				</div>

				<div>
					<input type="checkbox" name="remember"> Remember Me
				</div>

				<div>
					<button type="submit">Login</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection