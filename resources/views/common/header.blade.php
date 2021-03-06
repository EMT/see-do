<header>
	<div class="site-wrapper clear">
		<div class="left-align-wrapper">
			<h1 class="site-title aligned">
				<a class="js-site-title js-canvas-dom" href="/">See+Do</a>
				@if (!empty($category))
                    <span class="category-title">{{ $category->title }}</span>
                @endif
			</h1>
			@if (Request::route()->getParameter('city') || Auth::check())
			<a href="#" class="menu-link js-menu-toggle">{{ trans('navigation.menu') }}</a></li>
			<div class="js-menu hidden-nav">
				<nav>
					<ul>
					@if(Request::route()->getParameter('city'))
						<li><a href="#" class="filter">Filter</a></li>
						<li><a href="{{ route('{city}.subscribers.create', ['city' => Request::route()->getParameter('city')]) }}">{{ trans('navigation.subscribe') }}</a></li>
						<li><a href="{{ URL::route('{city}.users.index', ['city' => Request::route()->getParameter('city')->iata])}}">{{ trans('navigation.collaborators') }}</a></li>
						@if (Auth::check() && Auth::user()->city->iata === Request::route()->getParameter('city')->iata)

							<li><a href="{{ URL::route('{city}.events.create', ['city' => Request::route()->getParameter('city')->iata]) }}">Add Event</a></li>
						@endif
						@if (Request::route()->getParameter('category'))
							<li><a href="{{ route('{city}.categories.edit', ['category'=>Request::route()->getParameter('category')->slug, 'city' => Request::route()->getParameter('city')->iata]) }}">Edit Category</a></li>
						@endif
					@endif
					@if (Auth::check())
						<li><a href="/auth/logout">Log Out</a></li>
					@else
						<li><a href="/auth/login">Log In</a></li>
					@endif
					</ul>
				</nav>
			</div>
			@endif
		</div>
	</div>
</header>