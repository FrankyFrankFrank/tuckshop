@extends('layouts.app')

@section('content')

<div class="container">
	
	@if (count($errors) > 0)
	<div class="row">
		<div class="col-md-12">
		    <div class="alert alert-danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		</div>
	</div>
	@endif

	<div class="row">
		<div class="col-md-12">
		{!! Form::model($record, ['method' => 'PATCH', 'route' => ['records.update', $record->id]]) !!}

			<div class="form-group">
				{{ Form::label('title', 'Title') }}
				{{ Form::text('title', null, ['class' => 'form-control']) }}
			</div>

			<div class="form-group">
				{{ Form::label('artist', 'Artist') }}
				{{ Form::text('artist', null, ['class' => 'form-control']) }}
			</div>

			<div class="form-group">
				{{ Form::label('year', 'Year') }}
				{{ Form::text('year', null, ['class' => 'form-control']) }}
			</div>

			<div class="form-group">
				{{ Form::label('label', 'Label') }}
				{{ Form::text('label', null, ['class' => 'form-control']) }}
			</div>

			{{ Form::submit('Submit', ['class' => 'btn btn-default']) }}

		{!! Form::close() !!}
		</div>
	</div>
</div>

@endsection