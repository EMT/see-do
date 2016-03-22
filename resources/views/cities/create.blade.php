@extends('layouts.master')

@section('title', 'Add a City — See&Do')

@section('content')
    <h2 class="aligned">Add a City</h2>

    {!! Form::open(['action' => 'CitiesController@store', 'class' => 'form']) !!}

		<!-- Name -->
		<div class="form-row">
		    {!! Form::label('name', 'Name') !!}

		    <div class="form-row-body">
		        {!! Form::text('name', null, ['class' => 'input-text', 'placeholder' => 'Manhatten']) !!}

		        @include('common.forms.field-errors', ['errors' => $errors->get('name')])
		    </div>
		</div>

		<!-- IATA -->
		<div class="form-row">
		    {!! Form::label('iata', '3 Letter City Code (IATA)') !!}

		    <div class="form-row-body">
		        {!! Form::text('iata', null, ['class' => 'input-text', 'placeholder' => 'MCR']) !!}

		        @include('common.forms.field-errors', ['errors' => $errors->get('iata')])
		    </div>
		</div>

		<div class="form-row">
		    <div class="form-row-body">
		        {!! Form::submit(' Submit ', ['class' => 'btn primary']) !!}
		    </div>
		</div>

    {!! Form::close() !!}
@stop
