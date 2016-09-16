<div class="filter-overlay-bg js-filter-overlay-bg"></div>

<nav class="filter-overlay-nav js-filter-overlay-nav">
	<ul>
		@if ($categories)
			@foreach( $categories as $cat )

				<li>
					<a href="{{ route('{city}.categories.show', ['slug' => $cat->slug, 'city' =>  Request::route()->getParameter('city')]) }}">
	                    {!! $cat->icon !!}
	                    {{ $cat->title }} <span class="nav-num"><span class="nav-open-bracket">[</span><span class="nav-num-inner">{{ $cat->futureEventsCount( Request::route()->getParameter('city')) }}</span><span class="nav-close-bracket">]</span></span>
	                </a>
				</li>

			@endforeach
		@endif

	</ul>
    <a class="filter-nav-close js-filter-nav-close" href="#">[ Close ]</a>
</nav>
