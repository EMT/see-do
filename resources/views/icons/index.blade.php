@extends('layouts.master')

@section('title', 'All Icons — See&Do')

@section('content')
    <h2 class="aligned">Icons</h2>

    <div class="article-body aligned">
        <a href="{{ route('icons.create') }}">Add a new icon</a>

        @if ( !$icons->count() )
            There are no icons :(
        @else
            <ul>
                @foreach($icons as $i)
                    <li class="icon">
                        <a href="{{ route('icons.edit', $i->id) }}">
                            {!! $i->icon !!}
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@stop
