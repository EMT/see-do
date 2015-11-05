@extends('layouts.master')

@section('title', 'Hello — See&Do')

@section('content')
    <h2 class="aligned">Unsubscribed</h2>

    <div class="article-body aligned">
        <p>You have been unsubscribed from See&Do, and won’t recieve any more emails from us. If this was a mistake, <a href="{{ route('subscribers.create') }}">you can resubscribe.</p>
    </div>
@stop
