@extends('layouts.master')

@section('title', 'Edit Category — See&Do')

@section('content')
    <h2>Edit Category</h2>

    {!! Form::model($category, ['route' => ['categories.update', $category->slug], 'method' => 'put']) !!}
		
		@include('categories.categoryForm')

    {!! Form::close() !!}
@stop
