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


		<!-- IATA -->
		<div class="form-row">
			<div class="form-row aligned">
				<h2>Twitter API Details</h2>
				<p>These need to be created at apps.twitter.com for each new city.</p>
			</div>
		    {!! Form::label('twitter_consumer_key', 'Consumer Key') !!}

		    <div class="form-row-body">
		        {!! Form::text('twitter_consumer_key', null, ['class' => 'input-text', 'placeholder' => '']) !!}

		        @include('common.forms.field-errors', ['errors' => $errors->get('twitter_consumer_key')])
		    </div>
		</div>

		<!-- IATA -->
		<div class="form-row">
		    {!! Form::label('twitter_consumer_secret', 'Consumer Secret') !!}

		    <div class="form-row-body">
		        {!! Form::text('twitter_consumer_secret', null, ['class' => 'input-text', 'placeholder' => '']) !!}

		        @include('common.forms.field-errors', ['errors' => $errors->get('twitter_consumer_secret')])
		    </div>
		</div>

		<!-- IATA -->
		<div class="form-row">
		    {!! Form::label('twitter_access_token', 'Access Token') !!}

		    <div class="form-row-body">
		        {!! Form::text('twitter_access_token', null, ['class' => 'input-text', 'placeholder' => '']) !!}

		        @include('common.forms.field-errors', ['errors' => $errors->get('twitter_access_token')])
		    </div>
		</div>

		<!-- IATA -->
		<div class="form-row">
		    {!! Form::label('twitter_access_token_secret', 'Access Token Secret') !!}

		    <div class="form-row-body">
		        {!! Form::text('twitter_access_token_secret', null, ['class' => 'input-text', 'placeholder' => '']) !!}

		        @include('common.forms.field-errors', ['errors' => $errors->get('twitter_access_token_secret')])
		    </div>
		</div>

		<div class="form-row">
		    <div class="form-row-body">
		        {!! Form::submit(' Submit ', ['class' => 'btn primary']) !!}
		    </div>
		</div>

    {!! Form::close() !!}
@stop
