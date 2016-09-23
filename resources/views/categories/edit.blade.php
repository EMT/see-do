@extends('layouts.master')

@section('title', 'Edit Category — See&Do')

@section('content')
    <h2 class="aligned">Edit Category</h2>
    <p class="aligned">Note: Be wary of editing a category name as this will update the url, which will break old links.</p>

    {!! Form::model($category, ['route' => ['{city}.categories.update',  Request::route()->getParameter('city')->iata, $category->slug], 'method' => 'put', 'class' => 'form']) !!}

		@include('categories.categoryForm')

    {!! Form::close() !!}
@stop
