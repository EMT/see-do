@extends('layouts.master')

@section('title', 'Add a Colour Scheme — See&Do')

@section('content')
    <h2>Add a Colour Scheme</h2>

    {!! Form::open(['action' => 'ColorSchemesController@store']) !!}
		
		@include('color-schemes.colorSchemeForm')

    {!! Form::close() !!}
@stop
