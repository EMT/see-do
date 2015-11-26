@extends('layouts.master')

@section('title', 'All Icons — See&Do')

@section('content')
    <h2 class="aligned">Icons</h2>

    <div class="article-body aligned">
        <form action="{{ action('MailersController@generate') }}" method="post">
            {{ csrf_field() }}
            <input type="submit" value="Generate weekly email">
        </form>

        @if ( !$mailers->count() )
            There are no weekly emails yet :(
        @else
            <ul>
                @foreach($mailers as $m)
                    <li class="icon">
                        <a href="{{ action('mailers.view', $m->id) }}">
                            {!! $m->title() !!}
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@stop
