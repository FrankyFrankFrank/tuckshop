@extends('layouts.app')

@section('content')

<div class="container">

	{{-- 
	Records Control Row 
	--}}
	<div class="row">
		<div class="col-md-12">
			<p class="text-right"><a href="/records/create"><span class="icon">@icon('add-solid', 'small') Add New</span></a></p>
		</div>
	</div>

	{{-- 
	Display Records Row 
	--}}
	<div class="row">
		@forelse($records as $record)
		<div class="col-md-4 col-sm-6">
			<div class="panel panel-default">
				<div class="panel-heading"><h4>{{ $record->title }}</h4></div>
				<div class="panel-body">
					<h5>{{ $record->artist }}</h5>
					<p>{{ $record->label }}, {{ $record->year }}</p>
				</div>
			</div>
		</div>
		@empty
		<h1>No Records Found</h1>
		@endforelse
	</div>

</div>

@endsection