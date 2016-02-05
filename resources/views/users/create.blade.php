@extends('layouts.master')

@section('title', 'Add a User — See&Do')

@section('content')
    <h2 class="aligned">Add a User</h2>
    <p class="aligned">Send an email to a new user, make sure that the email is the same<br> as the one they will sign up with or they won't be able to signup.</p>

    {!! Form::open(['action' => 'UsersController@registerEmail', 'class' => 'form']) !!}

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
		        {!! Form::submit(' Submit ', ['class' => 'btn primary']) !!}
		    </div>
		</div>

    {!! Form::close() !!}
@stop
