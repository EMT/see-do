@extends('layouts.master')

@section('title', 'Subscribe — See&Do')

@section('content')
    <h2 class="aligned">Subscribe</h2>

    {!! Form::open(['action' => 'SubscribersController@store', 'class' => 'form']) !!}

        <!-- First name -->
        <div class="form-row">
            {!! Form::label('name', 'Name') !!}

            <div class="form-row-body">
                {!! Form::text('name', null, ['class' => 'input-text', 'placeholder' => 'Marty']) !!}

                <?php if ($errors->first('name')) { ?>
                    <p><?php echo $errors->first('name') ?></p>
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

        <div class="form-row">
            <div class="form-row-body">
                {!! Form::submit('[ Subscribe ]', ['class' => 'btn primary']) !!}
            </div>
        </div>
    
    {!! Form::close() !!}

@stop
