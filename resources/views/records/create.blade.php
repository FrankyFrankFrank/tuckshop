@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
		{!! Form::open(['url' => '/records']) !!}

			<div class="form-group">
				{{ Form::label('title', 'Title') }}
				{{ Form::text('title', '', ['class' => 'form-control']) }}
			</div>

			<div class="form-group">
				{{ Form::label('artist', 'Artist') }}
				{{ Form::text('artist', '', ['class' => 'form-control']) }}
			</div>

			<div class="form-group">
				{{ Form::label('year', 'Year') }}
				{{ Form::text('year', '', ['class' => 'form-control']) }}
			</div>

			<div class="form-group">
				{{ Form::label('label', 'Label') }}
				{{ Form::text('label', '', ['class' => 'form-control']) }}
			</div>

			{{ Form::submit('Submit', ['class' => 'btn btn-default']) }}

		{!! Form::close() !!}
		</div>
	</div>
</div>

@endsection