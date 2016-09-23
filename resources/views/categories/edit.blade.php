@extends('layouts.master')

@section('title', 'Edit Category — See&Do')

@section('content')
    <h2 class="aligned">Edit Category</h2>

    {!! Form::model($category, ['route' => ['{city}.categories.update',  Request::route()->getParameter('city')->iata, $category->slug], 'method' => 'put', 'class' => 'form']) !!}

		@include('categories.categoryForm')

    {!! Form::close() !!}
@stop
