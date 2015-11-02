@extends('layouts.master')

@section('title', 'Reset Pasword — See&Do')

@section('content')
    <h2 class="aligned">Reset Password</h2>

    {!! Form::open(['action' => 'Auth\PasswordController@postEmail', 'class' => 'form']) !!}

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

        <div class="form-row">
            <div class="form-row-body">
                {!! Form::submit('[ Send reset link ]', ['class' => 'btn primary']) !!}
            </div>
        </div>
    
    {!! Form::close() !!}

@stop
