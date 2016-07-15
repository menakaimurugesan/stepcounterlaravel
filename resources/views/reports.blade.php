<!--//resources/views/reports.blade.php-->
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
					<!-- Table Body -->					
					{{--*/ $first = true /*--}}
					{{--*/ $rank = 1 /*--}}
					@foreach ($activities as $activity)
						@if ($first == true)
							<!-- Table Headings -->
							@if ($choice > 0 and $choice < 4) 
								<th>Rank</th>
							@endif
							@foreach ($activity as $key => $col)							
									<th>{{ $key }}</th>							
							@endforeach
							{{--*/ $first = false /*--}}
						@endif						
						<tr>
						@if ($choice > 0 and $choice < 4) 
							<td class="table-text">
									<div>{{ $rank }}</div>
							</td>
							{{--*/ $rank = $rank + 1 /*--}}
						@endif
						@foreach ($activity as $adata)
							<td class="table-text">
								<div>{{ $adata }}</div>
							</td>
						@endforeach	
						</tr>
						
					@endforeach					
			</table>
		</div>
		@endif
	</div>
</div>
@endsection

					
						