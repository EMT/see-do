<!-- First name -->
<div class="form-row">
    {!! Form::label('name', 'Name') !!}

    <div class="form-row-body">
        {!! Form::text('name', null, ['class' => 'input-text', 'placeholder' => 'Marty']) !!}

        @include('common.forms.field-errors', ['errors' => $errors->get('name')])
    </div>
</div>

<!-- Email -->
<div class="form-row">
    {!! Form::label('email', 'Email') !!}

    <div class="form-row-body">
        {!! Form::text('email', null, ['class' => 'input-text', 'placeholder' => 'marty@thefuture.org']) !!}

        @include('common.forms.field-errors', ['errors' => $errors->get('email')])
    </div>
</div>
