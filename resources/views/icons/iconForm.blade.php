<!-- Color 1 -->
<div class="form-row">
    {!! Form::label('icon', 'Icon') !!}
    
    <div class="form-row-body">
        {!! Form::textarea('icon', null, ['class' => 'input-text', 'placeholder' => '<svg…']) !!}

        @include('common.forms.field-errors', ['errors' => $errors->get('icon')])
    </div>
</div>

<div class="form-row">
    <div class="form-row-body">
        {!! Form::submit('[ Submit ]', ['class' => 'btn primary']) !!}
    </div>
</div>
