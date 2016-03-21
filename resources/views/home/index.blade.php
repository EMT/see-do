@extends('layouts.master')

@section('title', 'See&Do')

@section('content')
	<ul>
		@foreach( $cities as $city)
			<li style="width: 50%; float: left; text-align: center; padding: 2em;">
				<a href="/{{$city->iata}}">
					{{$city->name}} - {{$city->iata}}
				</a>
			</li>
		@endforeach
	</ul>

@stop