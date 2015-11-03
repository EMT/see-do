@extends('layouts.master')

@section('title', 'Add an Icon — See&Do')

@section('content')
    <h2 class="aligned">Add an Icon</h2>

    {!! Form::open(['action' => 'IconsController@store', 'class' => 'form']) !!}
		
		@include('icons.iconForm')

    {!! Form::close() !!}
@stop
