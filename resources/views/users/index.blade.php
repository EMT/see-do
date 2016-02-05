@extends('layouts.master')

@section('title', 'All User Profiles — See&Do')

@section('content')
<div class="left-align-wrapper events-list">
	<div class="page-intro">
		<div class="page-intro-inner">
			<h2 class="page-intro-title">Our Collaborators</h2>
			<p>Here's a list of our creators and collaborators that help us select what to see and do.</p>
		</div>
	</div>
	<ul>
		@foreach( $users as $user )
			<li>
				<a href="/users/{{ $user->slug }}" class="user-item">
					<div class="event-item-title">
			            <div class="event-item-inner">
			                <h3>{{ $user->name_first }} {{ $user->name_last }}</h3>
			            </div>
			        </div>
			    </a>
			</li>
		@endforeach
	</ul>
</div>
@stop
