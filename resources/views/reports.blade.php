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
					@foreach ($activities as $activity)
						@if ($first == true)
							<!-- Table Headings -->	
							@foreach ($activity as $key => $col)							
									<th>{{ $key }}</th>							
							@endforeach
							{{--*/ $first = false /*--}}
						@endif						
						<tr>
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

					
						