@extends('layouts.master')

@section('title', 'Add an Event — See&Do')

@section('content')
    <h2 class="aligned">Add an Event</h2>

    {!! Form::open(['action' => array('EventsController@store', Request::segment(1)), 'class' => 'form']) !!}

		@include('events.eventForm')

    {!! Form::close() !!}
@stop
