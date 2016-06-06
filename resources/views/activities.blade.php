<!--//resources/views/activities.blade.php-->
@extends('layouts.app')

@section('content')
<div class="col-sm-offset-2 col-sm-8">
    <div class="panel panel-default">
		<!-- Display Validation Errors -->
        @include('common.errors')       
		<!-- Current Activities -->
		@if (count($activities) > 0)
		<div class="panel-body">
			<table class="table table-striped activity-table">
				<!-- Table Headings -->
				<thead>
					<th>User</th>
					<th>Date</th>
					<th>Steps</th>
				</thead>

				<!-- Table Body -->
				<tbody>
					@foreach ($activities as $activity)
						<tr>
							<!-- Activity Date -->
							<td class="table-text">
								<div>{{ $activity->user->name }}</div>
							</td>

							<td class="table-text">
								<div>{{ $activity->date }}</div>
							</td>

							<!-- Steps count -->
							<td class="table-text">
								<div>{{ $activity->steps }}</div>
							</td>

							<td>
								<!-- TODO: Delete Button -->
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		@endif
	</div>
</div>
@endsection