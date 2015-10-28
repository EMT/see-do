@extends('layouts.master')

@section('title', 'All Events — See&Do')

@section('content')
    
    <div class="left-align-wrapper events-list">
        
        @if ( !$events->count() )
            <p>There are no events :(</p>
        @else
            <div class="month-range clear active">
                <ul>
                    <?php $previousMonth = date('F', strtotime($events->first()->time_start)) ?>

                    <h2 class="month--title">{{ $previousMonth }}</h2>
                    
                    @foreach( $events as $ev )
                        
                        <?php $month = date('F', strtotime($ev->time_start)) ?>
                        
                        @if ( $month !== $previousMonth )
                            <?php $previousMonth = $month ?>
                            </ul>
                            <h2 class="month--title">{{ $month }}</h2>
                            <ul>
                        @endif
                    
                            <li class="event clear {{ ($event && $event->id === $ev->id) ? 'event--active' : '' }}">
                                <a href="{{ route('events.show', $ev->slug) }}">
                                    <div class="event--date">
                                        <span class="meta-data">{{ date('d.m.y', strtotime($ev->time_start)) }}</span>
                                    </div>
                                    <div class="event--link">
                                        <h3>{{ $ev->title }}</h3>
                                    </div>
                                </a>
                            </li>
                    @endforeach
                </ul>
            </div>
        @endif

    </div>

    @include('events.info')

@stop
