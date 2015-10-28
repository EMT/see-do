<div class="event-info {{ $event ? 'event-info--open' : '' }} event-background-color event-primary-color">
    <a href="#" class="event-info--close js-close-sidebar">
        <img src="{{asset('assets/img/close.svg')}}" alt="Close">
    </a>
    
    <h2 class="event-info--title">{{ $event ? $event->title : '' }}</h2>

    <div class="event-info--metadata event-secondary-color">
        <p class="meta-data event-info--date">{{ $event ? date('d.m.y', strtotime($event->time_start)) : '' }}</p>
        <p class="meta-data event-info--time">{{ $event ? date('g.ia', strtotime($event->time_start)) : '' }} - {{ $event ? date('g.ia', strtotime($event->time_end)) : '' }}</p>
        <p class="meta-data event-info--location">{{ $event ? $event->venue : '' }}</p>
    </div>

    <div class="body-copy">
        <p>{{ $event ? $event->content : '' }}</p>
    </div>

    <div class="event-info--navigation clear">
        <p class="event-info--share meta-data">Share</p>

        <div class="event-info--nav-arrows clear">
            <a href="#" class="nav-arrows--arrow"><img src="{{asset('assets/img/arrow-left.svg')}}" alt="Previous"></a>
            <a href="#" class="nav-arrows--arrow"><img src="{{asset('assets/img/arrow-right.svg')}}" alt="Next"></a>
        </div>
    </div>
</div>