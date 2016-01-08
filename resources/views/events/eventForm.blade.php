<!-- Title -->
<div class="form-row">
    {!! Form::label('title', 'Title') !!}

    <div class="form-row-body">
        {!! Form::text('title', null, ['class' => 'input-text', 'placeholder' => 'A Nice Event']) !!}

        @include('common.forms.field-errors', ['errors' => $errors->get('title')])
    </div>
</div>

<!-- Content -->
<div class="form-row">
    {!! Form::label('content', 'Description') !!}

    <div class="form-row-body">
        {!! Form::textarea('content', null, ['class' => 'input-text', 'placeholder' => 'Enter a description and information about the event']) !!}

        @include('common.forms.field-errors', ['errors' => $errors->get('content')])
    </div>
</div>

<div class="form-row">
    <div class="form-row-body js-date-time-input-group">

        <!-- Starts -->
        <div class="form-row-body-segment">
            {!! Form::label('time_start', 'Starts') !!}
            {!! Form::text('time_start', null, ['class' => 'input-select']) !!}
        </div>

        <!-- Ends -->
        <div class="form-row-body-segment">
            {!! Form::label('time_end', 'Ends') !!}
            {!! Form::text('time_end', null, ['class' => 'input-select']) !!}
        </div>

        @include('common.forms.field-errors', ['errors' => $errors->get('time_start')])
        @include('common.forms.field-errors', ['errors' => $errors->get('time_end')])

    </div>
</div>

<!-- Venue -->
<div class="form-row">
    {!! Form::label('venue', 'Venue/Location') !!}

    <div class="form-row-body">
        {!! Form::text('venue', null, ['class' => 'input-text', 'placeholder' => 'The specific whereabouts']) !!}

        @include('common.forms.field-errors', ['errors' => $errors->get('venue')])
    </div>
</div>

<!-- Category -->
<div class="form-row">
    {!! Form::label('category_id', 'Category') !!}

    <div class="form-row-body">
        {!! Form::select('category_id', $categories, null, ['class' => 'input-select']); !!}

        @include('common.forms.field-errors', ['errors' => $errors->get('category_id')])
    </div>
</div>

<!-- Color Scheme -->
<div class="form-row">
	{!! Form::label('color_scheme_id', 'Color Scheme') !!}

    <div class="form-row-body">
    	{!! Form::select('color_scheme_id', [0 => 'Select…'] + $colorSchemes->toArray(), ($event && $event->colorScheme) ? $event->colorScheme->id: null, ['class' => 'color-scheme-select js-color-scheme-select', 'data-default-text' => 'Use the category colour scheme', 'selected' => '1']); !!}

    	@include('common.forms.field-errors', ['errors' => $errors->get('color_scheme_id')])
    </div>
</div>

<!-- Icon -->
<div class="form-row">
    {!! Form::label('icons', 'Icon') !!}

    <div class="form-row-body">
        <select name="icons[]" class="icon-select js-icon-select" data-icon-ids="{{ ($event) ? implode(',', $event->iconIdsArray()) : '' }}" multiple>
            @foreach ($icons as $icon)
                <option value="{{ $icon->id }}" data-icon-svg="{{ $icon->svg }}">{{ $icon->title }}</option>
            @endforeach
        </select>

        @include('common.forms.field-errors', ['errors' => $errors->get('icons')])
    </div>
</div>

<!-- Social Media -->

<div class="form-row">
    {!! Form::label('tweet', 'Tweet this') !!}
    <div class="form-row-body">
        <div class="styled-checkbox">
            {!! Form::checkbox('tweet', 'true') !!}
            {!! Form::label('tweet', ' ') !!}
        </div>
    </div>
</div>

<div class="form-row">
    <div class="form-row-body">
        {!! Form::submit('[ Submit ]', ['class' => 'btn primary']) !!}
    </div>
</div>

