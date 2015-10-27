<!-- Title -->
{!! Form::label('title', 'Title') !!}
{!! Form::text('title') !!}

<?php if ($errors->first('title')) { ?>
    <p><?php echo $errors->first('title') ?></p>
<?php } ?>

<!-- Content -->
{!! Form::label('content', 'Content') !!}
{!! Form::textarea('content') !!}

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

<!-- Venue -->
{!! Form::label('venue', 'Venue/Location') !!}
{!! Form::text('venue') !!}

<?php if ($errors->first('venue')) { ?>
    <p><?php echo $errors->first('venue') ?></p>
<?php } ?>

<!-- Category -->
{!! Form::label('category_id', 'Category') !!}
{!! Form::select('category_id', $categories); !!}

<?php if ($errors->first('venue')) { ?>
    <p><?php echo $errors->first('venue') ?></p>
<?php } ?>

{!! Form::submit('Submit') !!}
