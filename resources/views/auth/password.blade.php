@extends('layouts.master')

@section('title', 'Reset Pasword — See&Do')

@section('content')
    <h2 class="aligned">Reset Password</h2>

    @if (session('status'))
        <div class="aligned alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    {!! Form::open(['action' => 'Auth\PasswordController@postEmail', 'class' => 'form']) !!}

        <!-- Email -->
        <div class="form-row">
            {!! Form::label('email', 'Email') !!}

            <div class="form-row-body">
                {!! Form::text('email', null, ['class' => 'input-text', 'placeholder' => 'marty@thefuture.org']) !!}

                @include('common.forms.field-errors', ['errors' => $errors->get('email')])
            </div>
        </div>

        <div class="form-row">
            <div class="form-row-body">
                {!! Form::submit(' Send reset link ', ['class' => 'btn primary']) !!}
            </div>
        </div>

    {!! Form::close() !!}

@stop
