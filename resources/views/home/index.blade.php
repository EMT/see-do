@extends('layouts.master')

@section('title', 'See&Do')

@section('content')
	<ul class="city-list">
		@foreach( $cities as $city)
			<li class="city" style="width: 50%; float: left; text-align: center; padding: 2em;">
				<a href="/{{$city->iata}}">
					<h3>{{$city->iata}}</h3>
					<h2>{{$city->name}}</h2>
				</a>
			</li>
		@endforeach
	</ul>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/matter-js/0.10.0/matter.js"></script>
@stop