<!-- Title -->
<div class="form-row">
    {!! Form::label('title', 'Title') !!}

    <div class="form-row-body">
        {!! Form::text('title', null, ['class' => 'input-text', 'placeholder' => 'A Nice Event']) !!}

        <?php if ($errors->first('title')) { ?>
            <p><?php echo $errors->first('title') ?></p>
        <?php } ?>
    </div>
</div>

<!-- Content -->
<div class="form-row">
    {!! Form::label('content', 'Description') !!}

    <div class="form-row-body">
        {!! Form::textarea('content', null, ['class' => 'input-text', 'placeholder' => 'Enter a description and information about the event']) !!}

        <?php if ($errors->first('content')) { ?>
            <p><?php echo $errors->first('content') ?></p>
        <?php } ?>
    </div>
</div>

<div class="form-row">
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
</div>

<!-- Venue -->
<div class="form-row">
    {!! Form::label('venue', 'Venue/Location') !!}
    
    <div class="form-row-body">
        {!! Form::text('venue', null, ['class' => 'input-text', 'placeholder' => 'The specific whereabouts']) !!}

        <?php if ($errors->first('venue')) { ?>
            <p><?php echo $errors->first('venue') ?></p>
        <?php } ?>
    </div>
</div>

<!-- Category -->
<div class="form-row">
    {!! Form::label('category_id', 'Category') !!}
    {!! Form::select('category_id', $categories); !!}

    <?php if ($errors->first('category_id')) { ?>
        <p><?php echo $errors->first('category_id') ?></p>
    <?php } ?>
</div>

<!-- Color Scheme -->
<div class="form-row">
    <div class="form-field">
    	{!! Form::label('color_scheme_id', 'Color Scheme') !!}
    	{!! Form::select('color_scheme_id', [0 => 'Select…'] + (array)$colorSchemes, ($event && $event->colorScheme) ? $event->colorScheme->id: null, ['class' => 'color-scheme-select js-color-scheme-select', 'data-default-text' => 'Use the category colour scheme']); !!}

    	<?php if ($errors->first('color_scheme_id')) { ?>
    	    <p><?php echo $errors->first('color_scheme_id') ?></p>
    	<?php } ?>
    </div>
</div>

{!! Form::submit('Submit') !!}
