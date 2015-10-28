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

                <?php if ($errors->first('name_first')) { ?>
                    <p><?php echo $errors->first('name_first') ?></p>
                <?php } ?>
            </div>
        </div>
        
        <!-- Last name -->
        <div class="form-row">
            {!! Form::label('name_last', 'Last Name') !!}

            <div class="form-row-body">
                {!! Form::text('name_last', null, ['class' => 'input-text', 'placeholder' => 'McFly']) !!}

                <?php if ($errors->first('name_last')) { ?>
                    <p><?php echo $errors->first('name_last') ?></p>
                <?php } ?>
            </div>
        </div>

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
                {!! Form::submit('[ Sign Up ]', ['class' => 'btn primary']) !!}
            </div>
        </div>
    
    {!! Form::close() !!}

@stop
