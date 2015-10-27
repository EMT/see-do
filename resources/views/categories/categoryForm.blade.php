<!-- Title -->
{!! Form::label('title', 'Title') !!}
{!! Form::text('title') !!}

<?php if ($errors->first('title')) { ?>
    <p><?php echo $errors->first('title') ?></p>
<?php } ?>

{!! Form::submit('Submit') !!}
