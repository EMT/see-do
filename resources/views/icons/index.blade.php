@extends('layouts.master')

@section('title', 'All Icons — See&Do')

@section('content')
    <h2 class="aligned">Icons</h2>

    <div class="article-body aligned">
        <a href="{{ route('icons.create') }}">Add a new icon</a>

        @if ( !$icons->count() )
            <div class="page-intro">
                <div class="page-intro-inner no-pad-bot">
                    <h2 class="page-intro-title">Oops</h2>
                </div>
            </div>

            <ul>
                 <li class="aligned no-records">Sorry, there aren't any icons listed <img class="error-emoji" src="/assets/img/error-emoji.svg" alt="Error"></li>
            </ul>
        @else
            <ul>
                @foreach($icons as $i)
                    <li class="icon">
                        <a href="{{ route('icons.edit', $i->id) }}">
                            {!! $i->svg !!}
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@stop
