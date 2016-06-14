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
					<th>Year</th>
					<th>Month</th>
					<th>User</th>
					<th>Steps</th>
				</thead>

				<!-- Table Body -->
				<tbody>
					@foreach ($activities as $activity)
						<tr>
							<!-- Activity Year -->							

							<td class="table-text">
								<div>{{ $activity->year }}</div>
							</td>
							
							<!-- Activity Month -->							

							<td class="table-text">
								<div>{{ $activity->Month }}</div>
							</td>
							
							<!-- User -->
							
							<td class="table-text">
								<div>{{ $activity->UserName }}</div>
							</td>

							<!-- Steps count -->
							<td class="table-text">
								<div>{{ $activity->TotalSteps }}</div>
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