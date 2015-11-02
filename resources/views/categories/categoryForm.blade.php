<!-- Title -->
<div class="form-row">
	{!! Form::label('title', 'Title') !!}
	
	<div class="form-row-body">
		{!! Form::text('title', null, ['class' => 'input-text', 'placeholder' => 'Stuff & Things']) !!}

		@include('common.forms.field-errors', ['errors' => $errors->get('title')])
	</div>
</div>

<!-- Icon -->
<div class="form-row">
    {!! Form::label('icon', 'Icon SVG Code') !!}

    <div class="form-row-body">
        {!! Form::textarea('icon', null, ['class' => 'input-text', 'placeholder' => '<svg…']) !!}

        @include('common.forms.field-errors', ['errors' => $errors->get('icon')])
    </div>
</div>

<!-- Color Scheme -->
<div class="form-row">
    <div class="form-field">
    	{!! Form::label('color_scheme_id', 'Color Scheme') !!}

        <div class="form-row-body">
        	{!! Form::select('color_scheme_id', $colorSchemes, ($category && $category->colorScheme) ? $category->colorScheme->id: null, ['class' => 'color-scheme-select js-color-scheme-select']); !!}

        	@include('common.forms.field-errors', ['errors' => $errors->get('color_scheme_id')])
        </div>
    </div>
</div>

<div class="form-row">
    <div class="form-row-body">
        {!! Form::submit('[ Submit ]', ['class' => 'btn primary']) !!}
    </div>
</div>
