@extends('layouts.master')

@section('title', 'All Categories — See&Do')

@section('content')
    <h2>Categories</h2>

    @if ( !$categories->count() )
        There are no categories :(
    @else
        <ul>
            @foreach($categories as $category)
                <li><a href="{{ route('categories.show', $category->slug) }}">{{ $category->title }}</a></li>
            @endforeach
        </ul>
    @endif
@stop
