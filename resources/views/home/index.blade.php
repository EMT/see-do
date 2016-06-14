@extends('layouts.master')

@section('title', 'See&Do')

@section('content')
	<ul class="city-list">
		@foreach( $cities as $city)
			<li class="city">
				<a href="/{{$city->iata}}">
					<h3>{{$city->iata}}</h3>
					<h2>{{$city->name}}</h2>
				</a>
			</li>
		@endforeach
	</ul>
	<script src="{{ elixir('js/homepage.js') }}"></script>
@stop