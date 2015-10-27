@extends('layouts.master')

@section('title', 'All Color Schemes — See&Do')

@section('content')
    <h2>Color Schemes</h2>

    @if ( !$colorSchemes->count() )
        There are no color schemes :(
    @else
        <ul>
            @foreach($colorSchemes as $cs)
                <li><a href="{{ route('color-schemes.edit', $cs->id) }}">{{ $cs->color_1 }}, {{ $cs->color_2 }}, {{ $cs->color_3 }}</a></li>
            @endforeach
        </ul>
    @endif
@stop
