@extends('layouts.master')

@section('title', 'Subscribe — See&Do')

@section('content')
    <h2 class="aligned">Subscribe</h2>

    {!! Form::open(['action' => 'SubscribersController@store', 'class' => 'form']) !!}

        @include('subscribers.subscriberForm')

        <div class="form-row">
            <div class="form-row-body">
                {!! Form::submit('[ Subscribe ]', ['class' => 'btn primary']) !!}
            </div>
        </div>
    
    {!! Form::close() !!}

@stop
