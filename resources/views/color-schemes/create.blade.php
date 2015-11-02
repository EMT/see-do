@extends('layouts.master')

@section('title', 'Add a Colour Scheme — See&Do')

@section('content')
    <h2 class="aligned">Add a Colour Scheme</h2>

    {!! Form::open(['action' => 'ColorSchemesController@store', 'class' => 'form']) !!}
		
		@include('color-schemes.colorSchemeForm')

    {!! Form::close() !!}
@stop
