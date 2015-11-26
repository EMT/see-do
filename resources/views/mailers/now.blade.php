@extends('layouts.master')

@section('title', 'Mailer — See+Do')

@section('content')
    <h2 class="aligned">Mailer</h2>

    <div class="article-body aligned">
        @if ( !$events->count() )
            <p>There are no events :(</p>
        @else
            <p></p>
            <ul>
                @foreach($events as $ev)
                    <li class="icon">
                        {{ $ev->longDates() }}
                        <a href="{{ route('events.show', $ev->slug) }}">
                            {!! $ev->title !!}
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@stop
