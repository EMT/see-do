<!-- Title -->
{!! Form::label('title', 'Title') !!}
{!! Form::text('title') !!}

<?php if ($errors->first('title')) { ?>
    <p><?php echo $errors->first('title') ?></p>
<?php } ?>

<!-- Color Scheme -->
{!! Form::label('color_scheme_id', 'Color Scheme') !!}
{!! Form::select('color_scheme_id', $colorSchemes, ($category) ? $category->colorScheme->id: null, ['class' => 'colorSchemeSelector']); !!}

<?php if ($errors->first('color_scheme_id')) { ?>
    <p><?php echo $errors->first('color_scheme_id') ?></p>
<?php } ?>

{!! Form::submit('Submit') !!}
