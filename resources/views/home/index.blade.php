@extends('layouts.master')

@section('title', 'See&Do')

@section('content')
	<ul class="city-list">
		@foreach( $cities as $city)
			<li class="city">
				<a href="/{{$city->iata}}">
					<h3 class="js-canvas-dom">{{$city->iata}}</h3>
					<h2 class="js-canvas-dom">{{$city->name}}</h2>
				</a>
			</li>
		@endforeach
	</ul>
	<script src="{{ elixir('js/homepage.js') }}"></script>
@stop