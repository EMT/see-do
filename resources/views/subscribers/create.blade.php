@extends('layouts.master')

@section('title', 'Subscribe — See&Do')

@section('content')
    <h2 class="aligned">Subscribe</h2>

    <div class="article-body aligned">
        <p>{{ trans('pages.subscribe')}} {{$city->name}}.</p>
    </div>

    {!! Form::open(['action' => array('SubscribersController@store', $city->iata), 'class' => 'form']) !!}

        @include('subscribers.subscriberForm')

        <div class="form-row">
            <div class="form-row-body">
                {!! Form::submit(' Subscribe ', ['class' => 'btn primary']) !!}
            </div>
        </div>

    {!! Form::close() !!}

@stop
