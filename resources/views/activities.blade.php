<!--//resources/views/activities.blade.php-->
@extends('layouts.app')

@section('content')
<div class="col-sm-offset-2 col-sm-8">
    <div class="panel panel-default">
		<!-- Display Validation Errors -->
        @include('common.errors')
		
		<!-- New Activity Form -->
        <form action="{{ url('activity') }}" method="POST" class="form-inline" role="form">
            {{ csrf_field() }}
			<div class="col-sm-8">
				<label for="activity-date" class="col-sm-3 control-label">Date</label>
				<label for="activity-steps" class="col-sm-3 control-label">Steps</label>
			</div>
            <!-- Activity Name -->
			<div class="col-sm-12">              							
				<select class="form-control" id="activity-date" name="date">
					<option value={{ Carbon\Carbon::now() }}>Today</option>
					<option value={{ Carbon\Carbon::yesterday() }}>Yesterday</option>
				</select>
				<input type="text" name="steps" id="activity-steps" class="form-control">                
				<button type="submit" class="btn btn-default">
					<i class="fa fa-plus"></i> Add Activity
				</button>
			</div>            
        </form>
	
		<!-- Current Activities -->
		@if (count($activities) > 0)
		<div class="panel-body">
			<table class="table table-striped activity-table">
				<!-- Table Headings -->
				<thead>
					<th>Activity Date</th>
					<th>Steps</th>					
				</thead>

				<!-- Table Body -->
				<tbody>
					@foreach ($activities as $activity)
						<tr>								
							<!-- Activity Date -->
							<td class="table-text">
								<div>{{ $activity->date }}</div>
							</td>

							<!-- Steps count -->
							<td class="table-text">
								<div>{{ $activity->steps }}</div>
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