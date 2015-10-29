<div class="event-info {{ $event ? 'event-info--open' : '' }} event-background-color event-primary-color">
    <a href="#" class="event-info--close js-close-sidebar">
        <img src="{{asset('assets/img/close.svg')}}" alt="Close">
    </a>
    
    <h2 class="event-info--title">{{ $event ? $event->title : '' }}</h2>

    <div class="event-info--metadata event-secondary-color">
        <p class="meta-data event-info--date">
            <span class="event-icon">@include('svg.event-date-icon')</span>
            <span class="js-event-info-date">{{ $event ? date('d.m.y', strtotime($event->time_start)) : '' }}</span>
        </p>
        <p class="meta-data event-info--time">
            <span class="event-icon">@include('svg.event-time-icon')</span>
            <span class="js-event-info-time">{{ $event ? date('g.ia', strtotime($event->time_start)) : '' }} - {{ $event ? date('g.ia', strtotime($event->time_end)) : '' }}</span>
        </p>
        <p class="meta-data event-info--location">
            <span class="event-icon">@include('svg.event-location-icon')</span>
            <span class="js-event-info-venue">{{ $event ? $event->venue : '' }}</span>
        </p>
    </div>

    <div class="body-copy">
        <p>{!! $event ? $event->content : '' !!}</p>
    </div>

    <div class="event-info--navigation clear">
        <p class="event-info--share meta-data">Share 
            <a class="js-event-info-fb" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ $event ? rawurlencode(route('events.show', ['slug' => $event->slug])) : '' }}">[ f ]</a> 
            <a class="js-event-info-twitter" target="_blank" href="https://twitter.com/home?status={{ $event ? rawurlencode($event->title . ' ' . route('events.show', ['slug' => $event->slug])) : '' }}">[ t ]</a>
        </p>
        <div class="event-info--nav-arrows clear js-event-next-prev"></div>
    </div>
</div>
