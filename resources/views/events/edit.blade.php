@extends('layouts.master')

@section('title', 'Add an Event — See&Do')

@section('content')
    <h2>Add an Event</h2>

    {!! Form::model($event, ['route' => ['events.update', $event->slug], 'method' => 'put']) !!}
		
		@include('events.eventForm')

    {!! Form::close() !!}
@stop
