@extends('layouts.master')

@section('title', 'Add an Event — See&Do')

@section('content')
    <h2>Add an Event</h2>

    {!! Form::open(['action' => 'EventsController@store']) !!}
		
		<!-- Title -->
        {!! Form::label('title', 'Title') !!}
        {!! Form::text('title') !!}

        <?php if ($errors->first('title')) { ?>
            <p><?php echo $errors->first('title') ?></p>
        <?php } ?>

        <!-- Content -->
        {!! Form::label('content', 'Content') !!}
        {!! Form::text('content') !!}

        <?php if ($errors->first('content')) { ?>
            <p><?php echo $errors->first('content') ?></p>
        <?php } ?>

        <!-- Starts -->
        {!! Form::label('time_start', 'Starts') !!}
        {!! Form::text('time_start') !!}

        <?php if ($errors->first('time_start')) { ?>
            <p><?php echo $errors->first('time_start') ?></p>
        <?php } ?>

        <!-- Ends -->
        {!! Form::label('time_end', 'Ends') !!}
        {!! Form::text('time_end') !!}

        <?php if ($errors->first('time_end')) { ?>
            <p><?php echo $errors->first('time_end') ?></p>
        <?php } ?>

    {!! Form::close() !!}
@stop