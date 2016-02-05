@extends('layouts.master')

@section('title', 'Update Subscription Settings — See&Do')

@section('content')
    <h2 class="aligned">Update Subscriber Settings</h2>

    {!! Form::model($subscriber, ['action' => ['SubscribersController@update', 'token' => $subscriber->token], 'method' => 'put', 'class' => 'form']) !!}

        @include('subscribers.subscriberForm')

        <div class="form-row">
            <div class="form-row-body">
                {!! Form::submit(' Save ', ['class' => 'btn primary']) !!}
            </div>
        </div>

    {!! Form::close() !!}

@stop
