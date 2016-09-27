@extends('layouts.master')

@section('title', 'Edit Event — See&Do')

@section('content')
    <h2 class="aligned">Edit Event</h2>
    {!! Form::model($event, ['route' => ['{city}.events.update',  Request::route()->getParameter('city')->iata, $event->slug], 'method' => 'put', 'class' => 'form']) !!}
		@include('events.eventForm')

    {!! Form::close() !!}
	<div class="form no-mgt">
		<div class="form-row">
		    <div class="form-row-body">
		        {!! delete_form( ['{city}.events.destroy',  Request::route()->getParameter('city')->iata, $event->slug]) !!}
		    </div>
		</div>
	</div>

@stop
