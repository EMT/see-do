<!-- Title -->
<div class="form-field">
	{!! Form::label('title', 'Title') !!}
	{!! Form::text('title') !!}

	<?php if ($errors->first('title')) { ?>
	    <p><?php echo $errors->first('title') ?></p>
	<?php } ?>
</div>

<!-- Color Scheme -->
<div class="form-field">
	{!! Form::label('color_scheme_id', 'Color Scheme') !!}
	{!! Form::select('color_scheme_id', $colorSchemes, ($category) ? $category->colorScheme->id: null, ['class' => 'color-scheme-select js-color-scheme-select']); !!}

	<?php if ($errors->first('color_scheme_id')) { ?>
	    <p><?php echo $errors->first('color_scheme_id') ?></p>
	<?php } ?>
</div>

{!! Form::submit('Submit') !!}
