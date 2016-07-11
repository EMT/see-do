@extends('layouts.master')

@section('title', 'All Categories — See&Do')

@section('content')
    <h2>Categories</h2>

    @if ( !$categories->count() )
    <ul>
         <li class="aligned no-records">Sorry, there aren't any categories listed <img class="error-emoji" src="/assets/img/error-emoji.svg" alt="Error"></li>
    </ul>
    @else
        <ul>
            @foreach($categories as $cat)
                <li>
                    <a href="{{ route('{city}.categories.show', ['category'=>$cat->slug, 'city' => Request::segment(1)]) }}">{{ $cat->title }}</a>
                    @if ( $cat->colorScheme )
                        <div class="color-scheme">
                            <span class="color-scheme-color" style="background-color: {{ $cat->colorScheme->color_1 }}">{{ $cat->colorScheme->color_1 }}</span>
                            <span class="color-scheme-color" style="background-color: {{ $cat->colorScheme->color_2 }}">{{ $cat->colorScheme->color_2 }}</span>
                            <span class="color-scheme-color" style="background-color: {{ $cat->colorScheme->color_3 }}">{{ $cat->colorScheme->color_3 }}</span>
                        </div>
                    @endif
                </li>
            @endforeach
        </ul>
    @endif
@stop
