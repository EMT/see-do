@extends('layouts.master')

@section('title', 'Add a Category — See&Do')

@section('content')
    <h2>Add a Category</h2>

    {!! Form::open(['action' => 'CategoriesController@store']) !!}
		
		<!-- Title -->
        {!! Form::label('title', 'Title') !!}
        {!! Form::text('title') !!}

        <?php if ($errors->first('title')) { ?>
            <p><?php echo $errors->first('title') ?></p>
        <?php } ?>

    {!! Form::close() !!}
@stop