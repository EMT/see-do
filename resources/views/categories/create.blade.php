@extends('layouts.master')

@section('title', 'Add a Category — See&Do')

@section('content')
    <h2>Add a Category</h2>

    {!! Form::open(['action' => 'CategoriesController@store', 'class' => 'form']) !!}
		
		@include('categories.categoryForm')

    {!! Form::close() !!}
@stop
