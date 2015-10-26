@extends('layouts.master')

@section('title', 'All Events — See&Do')

@section('content')
    
    <div class="left-align-wrapper events-list">
        
        @if ( !$events->count() )
            <p>There are no events :(</p>
        @else
            <div class="month-range clear active">
                <h2 class="month--title">October</h2>
                
                <ul>
                    @foreach($events as $ev)
                        <li class="event clear">
                            <a href="{{ route('events.show', $ev->slug) }}">
                                <div class="event--date"><span class="meta-data">20.10.15</span></div>
                                <div class="event--link">
                                    <h3>{{ $ev->title }}</h3>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="month-range clear hidden">
            <h2 class="month--title">November</h2>
        </div>
        <div class="month-range clear hidden">
            <h2 class="month--title">December</h2>
        </div>
        <div class="month-range clear hidden">
            <h2 class="month--title">January</h2>
        </div>
    </div>

    @include('events.info')

@stop
