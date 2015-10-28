<!-- Title -->
<div class="form-row">
	{!! Form::label('title', 'Title') !!}
	
	<div class="form-row-body">
		{!! Form::text('title', null, ['class' => 'input-text', 'placeholder' => 'Stuff & Things']) !!}

		<?php if ($errors->first('title')) { ?>
		    <p><?php echo $errors->first('title') ?></p>
		<?php } ?>
	</div>
</div>

<!-- Icon -->
<div class="form-row">
    {!! Form::label('icon', 'Icon SVG Code') !!}

    <div class="form-row-body">
        {!! Form::textarea('icon', null, ['class' => 'input-text', 'placeholder' => '<svg…']) !!}

        <?php if ($errors->first('icon')) { ?>
            <p><?php echo $errors->first('icon') ?></p>
        <?php } ?>
    </div>
</div>

<!-- Color Scheme -->
<div class="form-row">
    <div class="form-field">
    	{!! Form::label('color_scheme_id', 'Color Scheme') !!}

        <div class="form-row-body">
        	{!! Form::select('color_scheme_id', $colorSchemes, ($category && $category->colorScheme) ? $category->colorScheme->id: null, ['class' => 'color-scheme-select js-color-scheme-select']); !!}

        	<?php if ($errors->first('color_scheme_id')) { ?>
        	    <p><?php echo $errors->first('color_scheme_id') ?></p>
        	<?php } ?>
        </div>
    </div>
</div>

<div class="form-row">
    <div class="form-row-body">
        {!! Form::submit('[ Submit ]', ['class' => 'btn primary']) !!}
    </div>
</div>
