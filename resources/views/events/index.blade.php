@extends('layouts.master')

@section('title', 'Things to See+Do in Manchester')

@section('content')

    <div class="left-align-wrapper events-list">

        @if ( !$events->count() )
            <p>There are no events :(</p>
        @else
            <div class="month-range clear active">

                {{-- First month should always either be the current month in time, or the month the first event begins --}}
                @if ( strtotime($events->first()->time_start) < strtotime(date('Y-m-d H:i:s')))
                    <?php $previousMonth = date('F') ?>
                @else
                    <?php $previousMonth = date('F', strtotime($events->first()->time_start)) ?>
                @endif

                <h2 class="month-title">{{ $previousMonth }}</h2>

                <ul>
                    @foreach( $events as $ev )

                        <?php $month = date('F', strtotime($ev->time_start)) ?>

                        {{-- We only want to add a new Month to the list if the start date is in the future --}}
                        @if ( $month !== $previousMonth && strtotime($ev->time_start) > strtotime(date('Y-m-d H:i:s')))
                            <?php $previousMonth = $month ?>
                            </ul>
                            <h2 class="month-title">{{ $month }}</h2>
                            <ul>
                        @endif

                            <li id="event-item-{{ $ev->id }}" class="event clear {{ ($event && $event->id === $ev->id) ? 'event--active' : '' }}">
                                <a href="{{ route('events.show', $ev->slug) }}">
                                    <div class="event-item-date">
                                        <span class="meta-data">{{ $ev->shortDates() }}</span>
                                    </div>
                                    <div class="event-item-title">
                                        <div class="event-item-inner">
                                            <div class="event-item-icons">
                                                @foreach ($ev->icons() as $icon)
                                                    <span class="event-item-icon">{!! $icon->svg !!}</span>
                                                @endforeach
                                            </div>
                                            <h3>{{ $ev->title }}</h3>
                                        </div>
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
