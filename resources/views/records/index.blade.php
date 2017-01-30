@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
		@forelse($records as $record)
			<h1>{{ $record->title }}</h1>
			<h2>{{ $record->artist }}</h2>
			<p>{{ $record->year }}, {{ $record->label }}</p>
		@empty
			<h1>No Records Found</h1>
		@endforelse
		</div>
	</div>
</div>

@endsection