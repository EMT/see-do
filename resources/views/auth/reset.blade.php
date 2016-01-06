@extends('layouts.master')

@section('title', 'Reset Pasword — See&Do')

@section('content')
    <h2 class="aligned">Reset Password</h2>

    {!! Form::open(['action' => 'Auth\PasswordController@postReset', 'class' => 'form']) !!}

        <input type="hidden" name="token" value="{{ $token }}">

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
                {!! Form::password('password', ['class' => 'input-text', 'placeholder' => 'Shhh']) !!}

                @include('common.forms.field-errors', ['errors' => $errors->get('password')])
            </div>
        </div>

        <!-- Password confirmation -->
        <div class="form-row">
            {!! Form::label('password_confirmation', 'Confirm Password') !!}

            <div class="form-row-body">
                {!! Form::password('password_confirmation', ['class' => 'input-text', 'placeholder' => 'Shhh']) !!}

                @include('common.forms.field-errors', ['errors' => $errors->get('password_confirmation')])
            </div>
        </div>

        <div class="form-row">
            <div class="form-row-body">
                {!! Form::submit('[ Reset ]', ['class' => 'btn primary']) !!}
            </div>
        </div>
    
    {!! Form::close() !!}

@stop
