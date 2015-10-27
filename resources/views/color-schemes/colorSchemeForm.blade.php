<!-- Color 1 -->
{!! Form::label('color_1', 'Background') !!}
{!! Form::input('color', 'color_1') !!}

<?php if ($errors->first('color_1')) { ?>
    <p><?php echo $errors->first('color_1') ?></p>
<?php } ?>

<!-- Color 2 -->
{!! Form::label('color_2', 'Primary') !!}
{!! Form::input('color', 'color_2') !!}

<?php if ($errors->first('color_2')) { ?>
    <p><?php echo $errors->first('color_2') ?></p>
<?php } ?>

<!-- Color 3 -->
{!! Form::label('color_3', 'Secondary') !!}
{!! Form::input('color', 'color_3') !!}

<?php if ($errors->first('color_3')) { ?>
    <p><?php echo $errors->first('color_3') ?></p>
<?php } ?>

{!! Form::submit('Submit') !!}
