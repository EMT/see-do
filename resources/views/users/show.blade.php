@extends('layouts.master')

@section('title', 'View User Profile — See&Do')

@section('content')
    <div class="left-align-wrapper events-list">
        <div class="page-intro">
            <div class="page-intro-inner">
                <h2 class="page-intro-title">{{$user->username}}</h2>
                <p>{!! nl2br($user->bio) !!}</p>
                @if (Auth::user()->slug == Request::segment(2))
                    <a class="link-effect edit-user-details" href="{{ URL::to('users/' . $user->slug . '/edit') }}">Edit your details</a>
                @endif
            </div>
        </div>

        <ul>
        @if ( !$events->count() )
            <li class="aligned no-records">Sorry, there aren't any events listed <img class="error-emoji" src="/assets/img/error-emoji.svg" alt="Error"></li>
        @else
            @foreach( $events as $ev )
                    <li id="event-item-{{ $ev->id }}" class="event clear">
                        <a href="{{ route('events.show', $ev->slug) }}">
                            <div class="event-item-date">
                                <span class="meta-data">{{ $ev->longDates() }}</span>
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
        @endif
        </ul>
    </div>


    @include('events.info')

@stop
