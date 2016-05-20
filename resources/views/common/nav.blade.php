<div class="filter-overlay-bg js-filter-overlay-bg"></div>

<nav class="filter-overlay-nav js-filter-overlay-nav">
	<ul>

		@foreach( $categories as $cat )

			<li>
				<a href="{{ route('{city}.categories.show', ['slug' => $cat->slug, 'city' => Request::segment(1)]) }}">
                    {!! $cat->icon !!}
                    {{ $cat->title }} <span class="nav-num"><span class="nav-open-bracket">[</span><span class="nav-num-inner">{{ $cat->futureEventsCount(Request::segment(1)) }}</span><span class="nav-close-bracket">]</span></span>
                </a>
			</li>

		@endforeach

	</ul>
    <a class="filter-nav-close js-filter-nav-close" href="#">[ Close ]</a>
</nav>
