@extends('layouts.master')

@section('title', 'Edit Colour Scheme — See&Do')

@section('content')
    <h2>Edit Colour Scheme</h2>

    {!! Form::model($colorScheme, ['route' => ['color-schemes.update', $colorScheme->id], 'method' => 'put']) !!}
		
		@include('color-schemes.colorSchemeForm')

    {!! Form::close() !!}
@stop
