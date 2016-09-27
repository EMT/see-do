@extends('layouts.master')

@section('title', 'All User Profiles — See&Do')

@section('content')
<div class="left-align-wrapper events-list">
		<div class="page-intro">
			<div class="page-intro-inner">
				<h2 class="page-intro-title">Our Active Collaborators</h2>
				<p>{{ trans('pages.collaborators')}}</p>
			</div>
		</div>
		<ul>
			@foreach( $users as $user )
				@if ($user->user_events_count > 0)
					<li>
						<a href="{{ route('{city}.users.show', ['city' => Request::route()->getParameter('city'), 'users' => $user->slug])}}" class="user-item">
							<div class="event-item-title">
					            <div class="event-item-inner">
					                <h3>{{ $user->name_first }} {{ $user->name_last }} <span class="events-count">[ {{$user->user_events_count}} ]</span></h3>
					            </div>
					        </div>
					    </a>
					</li>
				@endif
			@endforeach
		</ul>
</div>
@stop
