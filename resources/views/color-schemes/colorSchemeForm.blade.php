<!-- Color 1 -->
{!! Form::label('color_1', 'Colour 1') !!}
{!! Form::text('color_1') !!}

<?php if ($errors->first('color_1')) { ?>
    <p><?php echo $errors->first('color_1') ?></p>
<?php } ?>

<!-- Color 2 -->
{!! Form::label('color_2', 'Colour 2') !!}
{!! Form::text('color_2') !!}

<?php if ($errors->first('color_2')) { ?>
    <p><?php echo $errors->first('color_2') ?></p>
<?php } ?>

<!-- Color 3 -->
{!! Form::label('color_3', 'Colour 3') !!}
{!! Form::text('color_3') !!}

<?php if ($errors->first('color_3')) { ?>
    <p><?php echo $errors->first('color_3') ?></p>
<?php } ?>

{!! Form::submit('Submit') !!}
