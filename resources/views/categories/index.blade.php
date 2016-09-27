@extends('layouts.master')

@section('title', 'All Categories — See&Do')

@section('content')
    <div class="left-align-wrapper events-list">
            <div class="page-intro">
                <div class="page-intro-inner">
                    <h2 class="page-intro-title">Categories</h2>
                </div>
            </div>
            <ul>
                @foreach($categories as $cat)
                    <li>
                        <a href="{{ route('{city}.categories.show', ['category'=>$cat->slug, 'city' => Request::route()->getParameter('city')->iata]) }}" class="user-item">
                            <div class="event-item-title">
                                <div class="event-item-inner">
                                    <h3>{{ $cat->title }} <span class="events-count">[ {{ $cat->futureEventsCount( Request::route()->getParameter('city')) }} ]</span></h3>
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
    </div>
@stop

