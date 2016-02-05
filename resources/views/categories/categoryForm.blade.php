<!-- Title -->
<div class="form-row">
	{!! Form::label('title', 'Title') !!}

	<div class="form-row-body">
		{!! Form::text('title', null, ['class' => 'input-text', 'placeholder' => 'Stuff & Things']) !!}

		@include('common.forms.field-errors', ['errors' => $errors->get('title')])
	</div>
</div>

<div class="form-row">
    <div class="form-row-body">
        {!! Form::submit(' Submit ', ['class' => 'btn primary']) !!}
    </div>
</div>
