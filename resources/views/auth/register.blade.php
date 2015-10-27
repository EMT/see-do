@extends('layouts.master')

@section('title', 'Create Your Account — See&Do')

@section('content')
    <h2>Create Your Account</h2>

    {!! Form::open(['action' => 'Auth\AuthController@postRegister']) !!}
        
        <!-- First name -->
        {!! Form::label('name_first', 'First Name') !!}
        {!! Form::text('name_first') !!}

        <?php if ($errors->first('name_first')) { ?>
            <p><?php echo $errors->first('name_first') ?></p>
        <?php } ?>
        
        <!-- Last name -->
        {!! Form::label('name_last', 'Last Name') !!}
        {!! Form::text('name_last') !!}

        <?php if ($errors->first('name_last')) { ?>
            <p><?php echo $errors->first('name_last') ?></p>
        <?php } ?>

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

@stop
