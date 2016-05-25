<header>
	<div class="site-wrapper clear">
		<div class="left-align-wrapper">
			<h1 class="site-title aligned">
				<a class="js-site-title" href="/">See+Do</a>
				@if (!empty($category))
                    <span class="category-title">{{ $category->title }}</span>
                @endif
			</h1>
			@if (Request::route()->getParameter('city') || Auth::check())
			<a href="#" class="menu-link js-menu-toggle">Menu</a></li>
			<div class="js-menu hidden-nav">
				<nav>
					<ul>
					@if(Request::route()->getParameter('city'))
						<li><a href="#" class="filter">Filter</a></li>
						<li><a href="{{ route('{city}.subscribers.create', ['city' => Request::route()->getParameter('city')]) }}">Subscribe</a></li>
						<li><a href="{{ route('{city}.users.index', ['city' => Request::route()->getParameter('city')])}}">Collaborators</a></li>
						@if (Auth::check() && Auth::user()->city->iata === Request::route()->getParameter('city'))
							<li><a href="{{ route('{city}.events.create', ['city' => Request::route()->getParameter('city')]) }}">Add Event</a></li>
						@endif
					@endif
					@if (Auth::check())
						<li><a href="/auth/logout">Log Out</a></li>
					@endif
					</ul>
				</nav>
			</div>
			@endif
		</div>
	</div>
</header>
