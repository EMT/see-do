<header>
	<div class="site-wrapper clear">
		<div class="left-align-wrapper">
			<h1 class="site-title aligned">
				<a class="js-site-title" href="/">See+Do</a>

				@if (!empty($category))
                    <span class="category-title">{{ $category->title }}</span>
                @endif
			</h1>
			<nav>
				<ul>
					<li><a href="#" class="filter">Filter</a></li>
					<li><a href="{{ route('subscribers.create') }}">Subscribe</a></li>
					@if (Auth::check())
						<li><a href="{{ route('users.index') }}">Collaborators</a></li>
						<li><a href="{{ route('events.create') }}">Add Event</a></li>
						<li><a href="/auth/logout">Log Out</a></li>
					@endif
				</ul>
			</nav>
		</div>
	</div>
</header>
