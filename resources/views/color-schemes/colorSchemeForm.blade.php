<!-- Color 1 -->
<div class="form-row">
    {!! Form::label('color_1', 'Background') !!}
    
    <div class="form-row-body">
        {!! Form::input('color', 'color_1', null, ['class' => 'input-text']) !!}

        @include('common.forms.field-errors', ['errors' => $errors->get('color_1')])
    </div>
</div>

<!-- Color 2 -->
<div class="form-row">
    {!! Form::label('color_2', 'Primary') !!}
    
    <div class="form-row-body">
        {!! Form::input('color', 'color_2', null, ['class' => 'input-text']) !!}

        @include('common.forms.field-errors', ['errors' => $errors->get('color_2')])
    </div>
</div>

<!-- Color 3 -->
<div class="form-row">
    {!! Form::label('color_3', 'Secondary') !!}
    
    <div class="form-row-body">
        {!! Form::input('color', 'color_3', null, ['class' => 'input-text']) !!}

        @include('common.forms.field-errors', ['errors' => $errors->get('color_3')])
    </div>
</div>

<div class="form-row">
    <div class="form-row-body">
        {!! Form::submit('[ Submit ]', ['class' => 'btn primary']) !!}
    </div>
</div>
