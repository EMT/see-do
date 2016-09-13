@extends('layouts.master')

@section('title', '[CITY NAME HERE] Settings — See&Do')

@section('content')
	{!! Form::model($city, array('route' => ['cities.update',  $city->iata], 'method' => 'put', 'class' => 'form')) !!}


	<div class="form-row">
		<div class="form-row aligned">
		    <h2>City Details</h2>
		    <p>Change the city name/code. (note: changing the code will cause all associated events to be lost)</p>
		</div>


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
	</div>


{{-- 		<div class="form-row">
			<div class="form-row aligned">
				<h2>Users</h2>
				<p>All of the users currently attatched to this city.</p>
			</div>
		</div> --}}

	<div class="form-row">
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
	</div>

		<div class="form-row">
			<div class="form-row aligned">
				<h2>Hide City</h2>
				<p>Hide the city from the frontpage and prevent people that are not logged in accessing it. This defaults to on, turn it off when you want the city to go live.</p>
			</div>
		    {!! Form::label('hidden', 'Hide City') !!}

		    <div class="form-row-body">
			    {{ Form::hidden('hidden',0) }}
		        {!! Form::checkbox('hidden', 1, $city->hidden, ['class' => 'input-checkbox']) !!}

		        @include('common.forms.field-errors', ['errors' => $errors->get('hidden')])
		    </div>
		</div>

		<div class="form-row">
		    <div class="form-row-body">
		        {!! Form::submit(' Save ', ['class' => 'btn primary']) !!}
		    </div>
		</div>

    {!! Form::close() !!}
@stop
