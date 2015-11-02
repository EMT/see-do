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

                <?php if ($errors->first('email')) { ?>
                    <p><?php echo $errors->first('email') ?></p>
                <?php } ?>
            </div>
        </div>

        <!-- Password -->
        <div class="form-row">
            {!! Form::label('password', 'Password') !!}

            <div class="form-row-body">
                {!! Form::text('password', null, ['class' => 'input-text', 'placeholder' => 'Shhh']) !!}

                <?php if ($errors->first('password')) { ?>
                    <p><?php echo $errors->first('password') ?></p>
                <?php } ?>
            </div>
        </div>

        <!-- Password confirmation -->
        <div class="form-row">
            {!! Form::label('password_confirmation', 'Confirm Password') !!}

            <div class="form-row-body">
                {!! Form::text('password_confirmation', null, ['class' => 'input-text', 'placeholder' => 'Shhh']) !!}

                <?php if ($errors->first('password_confirmation')) { ?>
                    <p><?php echo $errors->first('password_confirmation') ?></p>
                <?php } ?>
            </div>
        </div>

        <div class="form-row">
            <div class="form-row-body">
                {!! Form::submit('[ Reset ]', ['class' => 'btn primary']) !!}
            </div>
        </div>
    
    {!! Form::close() !!}

@stop
