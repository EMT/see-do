@extends('layouts.master')

@section('title', 'Create Your Account — See&Do')

@section('content')
    <h2 class="aligned">Create Your Account</h2>
    @php ($last_name = explode(" ",Input::get('name')))
    @php ($first_name = array_shift($last_name))

    {!! Form::open(['action' => 'Auth\AuthController@postRegister', 'class' => 'form']) !!}

        <input name="registration_token" type="hidden" value="{{$token}}">

        <!-- First name -->
        <div class="form-row">
            {!! Form::label('name_first', 'First Name') !!}

            <div class="form-row-body">
                {!! Form::text('name_first', $first_name , ['class' => 'input-text', 'placeholder' => 'Marty']) !!}

                @include('common.forms.field-errors', ['errors' => $errors->get('name_first')])
            </div>
        </div>

        <!-- Last name -->
        <div class="form-row">
            {!! Form::label('name_last', 'Last Name') !!}

            <div class="form-row-body">
                {!! Form::text('name_last', join(' ', $last_name), ['class' => 'input-text', 'placeholder' => 'McFly']) !!}

                @include('common.forms.field-errors', ['errors' => $errors->get('name_last')])
            </div>
        </div>

        <!-- Username -->
        <div class="form-row">
            {!! Form::label('username', 'Username') !!}

            <div class="form-row-body">
                {!! Form::text('username', Input::get('name'), ['class' => 'input-text', 'placeholder' => 'Marty McFly']) !!}

                @include('common.forms.field-errors', ['errors' => $errors->get('username')])
            </div>
        </div>

        <!-- User Bio -->
        <div class="form-row">
            {!! Form::label('bio', 'User Bio') !!}

            <div class="form-row-body">
                {!! Form::textarea('bio', null, ['class' => 'input-text', 'placeholder' => 'Tell us a bit about yourself and what you do. Keep it short, about two or three sentences. ']) !!}

                @include('common.forms.field-errors', ['errors' => $errors->get('bio')])
            </div>
        </div>

		<!-- Email -->
        <div class="form-row">
            {!! Form::label('email', 'Email') !!}

            <div class="form-row-body">
                {!! Form::text('email', Input::get('email'), ['class' => 'input-text', 'placeholder' => 'marty@thefuture.org']) !!}

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
                {!! Form::submit(' Sign Up ', ['class' => 'btn primary']) !!}
            </div>
        </div>

    {!! Form::close() !!}

@stop
