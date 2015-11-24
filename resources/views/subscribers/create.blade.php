@extends('layouts.master')

@section('title', 'Subscribe — See&Do')

@section('content')
    <h2 class="aligned">Subscribe</h2>

    <div class="article-body aligned">
        <p>We’ll email you a weekly round-up of things to See+Do in Manchester.</p>
    </div>

    {!! Form::open(['action' => 'SubscribersController@store', 'class' => 'form']) !!}

        @include('subscribers.subscriberForm')

        <div class="form-row">
            <div class="form-row-body">
                {!! Form::submit('[ Subscribe ]', ['class' => 'btn primary']) !!}
            </div>
        </div>
    
    {!! Form::close() !!}

@stop
