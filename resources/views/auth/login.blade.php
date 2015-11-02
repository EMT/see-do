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

        <div class="form-row">
            <div class="form-row-body">
                {!! Form::submit('[ Log In ]', ['class' => 'btn primary']) !!}
            </div>
        </div>
    
    {!! Form::close() !!}

@stop
