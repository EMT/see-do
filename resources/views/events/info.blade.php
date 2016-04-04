<div class="event-info event-background-color event-primary-color">
    <a href="#" class="event-info--close js-close-sidebar">
        <img src="{{asset('assets/img/close.svg')}}" alt="Close">
    </a>

    <h2 class="event-info--title">{{ $event ? $event->title : '' }}</h2>

    <div class="event-info--metadata event-secondary-color">
        <p class="meta-data event-info--date">
            <span class="event-icon">@include('svg.event-date-icon')</span>
            <span class="js-event-info-date">
                @if ($event)
                    {{ $event->longDates() }}
                @endif
            </span>
        </p>
        <p class="meta-data event-info--time">
            <span class="event-icon">@include('svg.event-time-icon')</span>
            <span class="js-event-info-time">{{ $event ? date('g.ia', strtotime($event->time_start)) : '' }} - {{ $event ? date('g.ia', strtotime($event->time_end)) : '' }}</span>
        </p>
        <p class="meta-data event-info--location">
            <span class="event-icon">@include('svg.event-location-icon')</span>
            <span class="js-event-info-venue">{{ $event ? $event->venue : '' }}</span>
        </p>
        <p class="meta-data event-info--user">
            <span class="event-icon">@include('svg.event-location-icon')</span>
            <span class="js-event-info-user">Posted by: <a href="/users/{{ $event ? $event->user->slug : '' }}">{{ $event ? $event->user->username : '' }}</a></span>
        </p>
    </div>

    <div class="body-copy">
       {!! $event ? $event->parseMarkdown('content') : '' !!}
    </div>
    <div class="js-event-info-wrapper">
        @if ($event && $event->more_info)
            <a href="{{ $event ? rawurlencode($event->more_info) : '' }}" target="blank">More Info</a>
        @endif
    </div>
    <div class="event-info--navigation clear">
        <p class="event-info--share meta-data">
            <a class="js-event-info-fb" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ $event ? rawurlencode(route('events.show', ['slug' => $event->slug])) : '' }}">f</a>
            <a class="js-event-info-twitter" target="_blank" href="https://twitter.com/home?status={{ $event ? rawurlencode($event->title . ' ' . route('events.show', ['slug' => $event->slug])) : '' }}">t</a>
        </p>
        <div class="event-info--nav-arrows clear js-event-next-prev"></div>
    </div>

    @if (Auth::check())
        <div class="event-info--admin meta-data">
            <a class="js-edit-event" href="{{ $event ? route('events.edit', ['slug' => $event->slug]) : '' }}">Edit Event</a>
        </div>
    @endif
</div>
