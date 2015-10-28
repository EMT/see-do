<div class="filter-overlay-bg"></div>

<nav class="filter-overlay-nav">
	<ul>

		@foreach( $categories as $cat )

			<li>
				{!! $cat->icon !!}
				<a href="#">{{ $cat->title }} <span class="nav-num"><span class="nav-open-bracket">[</span><span class="nav-num-inner">{{ $cat->events()->count() }}</span><span class="nav-close-bracket">]</span></span></a>
			</li>

		@endforeach

	</ul>
</nav>
