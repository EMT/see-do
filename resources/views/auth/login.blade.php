@extends('layouts.master')

@section('title', 'Log In — See&Do')

@section('content')
    <h2>Log In</h2>

    {!! Form::open(['action' => 'Auth\AuthController@postLogin']) !!}

		<!-- Email -->
        {!! Form::label('email', 'Email') !!}
        {!! Form::text('email') !!}

        <?php if ($errors->first('email')) { ?>
            <p><?php echo $errors->first('email') ?></p>
        <?php } ?>

        <!-- First name -->
        {!! Form::label('password', 'Password') !!}
        {!! Form::text('password') !!}

        <?php if ($errors->first('password')) { ?>
            <p><?php echo $errors->first('password') ?></p>
        <?php } ?>

        {!! Form::submit('Sign Up') !!}
    
    {!! Form::close() !!}

    <?php var_dump($errors) ?>

    <?php foreach ($errors->all('<p>:message</p>') as $message) { ?>
        {{ $message }}
    <?php } ?>

@stop