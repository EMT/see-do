@extends('layouts.master')

@section('title', 'Edit Colour Scheme — See&Do')

@section('content')
    <h2 class="aligned">Edit Colour Scheme</h2>

    {!! Form::model($colorScheme, ['route' => ['color-schemes.update', $colorScheme->id], 'method' => 'put', 'class' => 'form']) !!}
		
		@include('color-schemes.colorSchemeForm')

    {!! Form::close() !!}
@stop
