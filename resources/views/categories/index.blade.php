@extends('layouts.master')

@section('title', 'All Categories — See&Do')

@section('content')
    <h2>Categories</h2>

    @if ( !$categories->count() )
        There are no categories :(
    @else
        <ul>
            @foreach($categories as $cat)
                <li><a href="{{ route('categories.show', $cat->slug) }}">{{ $cat->title }}</a></li>
            @endforeach
        </ul>
    @endif
@stop
