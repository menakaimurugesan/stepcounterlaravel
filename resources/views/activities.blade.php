//resources/views/activities.blade.php
@extends('layouts.app')

@section('content')
    <!-- Bootstrap Boilerplate... -->
    <div class="panel-body">

		<!-- Display Validation Errors -->
        @include('common.errors')
		
        <!-- New Activity Form -->
        <form action="/activity" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <!-- Activity Date -->
            <div class="form-group">
                <label for="activity" class="col-sm-3 control-label">Date</label>

                <div class="col-sm-6">
                    <input type="text" name="activity-date" id="activity-date" class="form-control">
                </div>
            </div>
			
			<!-- Steps count -->
            <div class="form-group">
                <label for="steps" class="col-sm-3 control-label">Steps</label>

                <div class="col-sm-6">
                    <input type="text" name="step-count" id="step-count" class="form-control">
                </div>
            </div>

            <!-- Add Activity Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Add Activity
                    </button>
                </div>
            </div>
        </form>
    </div>

	<!-- Current Activities -->
	@if (count($activities) > 0)
		<div class="panel panel-default">
			<div class="panel-heading">
				Current Activities
			</div>

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
									<div>{{ $activity->user->id }}</div>
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
		</div>
	@endif

@endsection