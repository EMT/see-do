@extends('layouts.master')

@section('title', 'Edit Icon — See&Do')

@section('content')
    <h2 class="aligned">Edit Icon</h2>

    {!! Form::model($icon, ['route' => ['icons.update', $icon->id], 'method' => 'put', 'class' => 'form']) !!}
		
		@include('icons.iconForm')

    {!! Form::close() !!}
@stop
