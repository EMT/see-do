@extends('layouts.master')

@section('title', 'Add an Event — See&Do')

@section('content')
    <h2 class="aligned">Add an Event</h2>

    {!! Form::open(['action' => 'EventsController@store', 'class' => 'form']) !!}
		
		@include('events.eventForm')

    {!! Form::close() !!}
@stop
