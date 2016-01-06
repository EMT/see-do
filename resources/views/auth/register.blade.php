@extends('layouts.master')

@section('title', 'Create Your Account — See&Do')

@section('content')
    <h2 class="aligned">Create Your Account</h2>

    {!! Form::open(['action' => 'Auth\AuthController@postRegister', 'class' => 'form']) !!}
        
        <!-- First name -->
        <div class="form-row">
            {!! Form::label('name_first', 'First Name') !!}

            <div class="form-row-body">
                {!! Form::text('name_first', null, ['class' => 'input-text', 'placeholder' => 'Marty']) !!}

                @include('common.forms.field-errors', ['errors' => $errors->get('name_first')])
            </div>
        </div>
        
        <!-- Last name -->
        <div class="form-row">
            {!! Form::label('name_last', 'Last Name') !!}

            <div class="form-row-body">
                {!! Form::text('name_last', null, ['class' => 'input-text', 'placeholder' => 'McFly']) !!}

                @include('common.forms.field-errors', ['errors' => $errors->get('name_last')])
            </div>
        </div>

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

        <div class="form-row">
            <div class="form-row-body">
                {!! Form::submit('[ Sign Up ]', ['class' => 'btn primary']) !!}
            </div>
        </div>
    
    {!! Form::close() !!}

@stop
