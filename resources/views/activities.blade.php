<!--//resources/views/activities.blade.php-->
@extends('layouts.app')

@section('content')
<div class="col-sm-offset-1 col-sm-5">    
		<!-- Display Validation Errors -->
        @include('common.errors')		
		<div class="panel panel-default">
			<div class="panel-heading">Add Activities</div>
			<div class="panel-body"> 
				<!-- New Activity Form -->
				<form action="{{ url('activity') }}" method="POST" class="form-inline" role="form">
					{{ csrf_field() }}					
					<!-- Activity Name -->					
						Date:
						<select class="form-control" id="activity-date" name="date">
							<option value={{ Carbon\Carbon::now() }}>Today</option>
							<option value={{ Carbon\Carbon::yesterday() }}>Yesterday</option>
						</select>
						Steps:
						<input type="text" name="steps" id="activity-steps" class="form-control" size="5">                
						<button type="submit" class="btn btn-default">
							<i class="fa fa-plus"></i> Add Activity
						</button>				
				</form>
			</div>
		</div>
		
		<div class="panel panel-default">
			<div class="panel-heading">From Google Fit</div>
			<div class="panel-body">
				<strong><a href = "{{ url('/GoogleFit?period=10') }}" id="link" onclick="useValue()">Load</a></strong>
				<input type="text" id="period" onChange="useValue()" value="10" size = "2"> days data
				<script>	
					function useValue() {
					  document.getElementById('link').href = "{{ url('/GoogleFit?period=') }}" + encodeURIComponent(document.getElementById('period').value);
					}
				</script>
			</div>
		</div>			
	</div>
		<!-- Current Activities -->
		@if (count($activities) > 0)
		<div class="col-sm-5">
			<div class="panel panel-default">
				<div class="panel-heading">My Activities</div>
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
			<div>
		</div>
		@endif
@endsection