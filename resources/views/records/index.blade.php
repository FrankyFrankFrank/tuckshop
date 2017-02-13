@extends('layouts.app')

@section('content')

<div class="container">

	{{-- 
	Records Control Row 
	--}}
	<div class="row">
		<div class="col-md-12">
			<p class="text-right"><a class="btn btn-default" href="/records/create">@icon('add-solid', 'small') Add New</a></p>
		</div>
	</div>

	{{-- 
	Display Records Row 
	--}}
	<div class="row">
		@forelse($records as $record)
		<div class="col-md-4 col-sm-6 record">
			<div class="row">
				<div class="col-sm-12">
					<h4>{{ $record->title }}</h4>
					<h5>{{ $record->artist }}</h5>
					<p>{{ $record->label }}, {{ $record->year }}</p>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<!-- Delete Record -->
					{!! Form::model($record, ['route' => ['records.destroy', $record->id], 'method' => 'DELETE', 'style' => 'display:inline;']) !!}
						<button type="submit" class="btn btn-danger">
						    @icon('close-solid', 'small') Delete
						</button>
					{!! Form::close() !!}
					<!-- Edit Record -->
					<a href="{{ route('records.edit', ['id' => $record->id]) }}">
						<button class="btn btn-success">
						    @icon('close-solid', 'small') Edit
						</button>
					</a>
				</div>
			</div>

		</div>
		@empty
		<h1>No Records Found</h1>
		@endforelse
	</div>

</div>

@endsection