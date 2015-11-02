@extends('layouts.master')

@section('title', 'Log In — See&Do')

@section('content')
    <h2 class="aligned">Log In</h2>

    {!! Form::open(['action' => 'Auth\AuthController@postLogin', 'class' => 'form']) !!}

		<!-- Email -->
        <div class="form-row">
            {!! Form::label('email', 'Email') !!}

            <div class="form-row-body">
                {!! Form::text('email', null, ['class' => 'input-text', 'placeholder' => 'marty@thefuture.org']) !!}

                @include('common.forms.field-errors', ['errors' => $errors->get('email')])
            </div>
        </div>

        <!-- Password -->
        <div class="form-row">
            {!! Form::label('password', 'Password') !!}

            <div class="form-row-body">
                {!! Form::text('password', null, ['class' => 'input-text', 'placeholder' => 'Shhh']) !!}

                @include('common.forms.field-errors', ['errors' => $errors->get('password')])
            </div>
        </div>

        <div class="form-row">
            <div class="form-row-body">
                {!! Form::submit('[ Log In ]', ['class' => 'btn primary']) !!}
            </div>
        </div>
    
    {!! Form::close() !!}

@stop
