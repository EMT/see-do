@extends('layouts.master')

@section('title', 'All Color Schemes — See&Do')

@section('content')
    <h2>Color Schemes</h2>

    <a href="{{ route('color-schemes.create') }}">Add a new colour scheme</a>

    @if ( !$colorSchemes->count() )
        There are no color schemes :(
    @else
        <ul>
            @foreach($colorSchemes as $cs)
                <li>
                    <a class="color-scheme" href="{{ route('color-schemes.edit', $cs->id) }}">
                        <span class="color-scheme-color" style="background-color: {{ $cs->color_1 }}">{{ $cs->color_1 }}</span>
                        <span class="color-scheme-color" style="background-color: {{ $cs->color_2 }}">{{ $cs->color_2 }}</span>
                        <span class="color-scheme-color" style="background-color: {{ $cs->color_3 }}">{{ $cs->color_3 }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
@stop
