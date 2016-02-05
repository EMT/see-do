<!-- Title -->
<div class="form-row">
    {!! Form::label('title', 'Title') !!}

    <div class="form-row-body">
        {!! Form::text('title', null, ['class' => 'input-text', 'placeholder' => 'Face Happy']) !!}

        @include('common.forms.field-errors', ['errors' => $errors->get('title')])
    </div>
</div>

<!-- SVG -->
<div class="form-row">
    {!! Form::label('icon', 'Icon') !!}

    <div class="form-row-body">
        {!! Form::textarea('svg', null, ['class' => 'input-text', 'placeholder' => '<svg…']) !!}

        @include('common.forms.field-errors', ['errors' => $errors->get('icon')])
    </div>
</div>

<div class="form-row">
    <div class="form-row-body">
        {!! Form::submit(' Submit ', ['class' => 'btn primary']) !!}
    </div>
</div>
