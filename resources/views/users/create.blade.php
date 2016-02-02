@extends('layouts.master')

@section('title', 'Add a User — See&Do')

@section('content')
    <h2 class="aligned">Add a User</h2>

    {!! Form::open(['action' => 'UsersController@store', 'class' => 'form']) !!}

		<div class="form-row">
		    {!! Form::label('name', 'Name') !!}

		    <div class="form-row-body">
		        {!! Form::text('name', null, ['class' => 'input-text', 'placeholder' => 'Duck Dodgers']) !!}

		        @include('common.forms.field-errors', ['errors' => $errors->get('name')])
		    </div>
		</div>

		<div class="form-row">
		    {!! Form::label('email', 'Email') !!}

		    <div class="form-row-body">
		        {!! Form::text('email', null, ['class' => 'input-text', 'placeholder' => 'duckdodgers@inthe241/2st.century']) !!}

		        @include('common.forms.field-errors', ['errors' => $errors->get('email')])
		    </div>
		</div>


		<div class="form-row">
		    <div class="form-row-body">
		        {!! Form::submit('[ Submit ]', ['class' => 'btn primary']) !!}
		    </div>
		</div>

    {!! Form::close() !!}
@stop
