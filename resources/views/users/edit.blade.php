@extends('layouts.master')

@section('title', 'Edit User Profile — See&Do')

@section('content')
    <h2 class="aligned">Edit Profile - {{$user->username}}</h2>

    {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'put', 'class' => 'form']) !!}

    <div class="form-row">
        {!! Form::label('email', 'Email') !!}

        <div class="form-row-body">
            {!! Form::text('email', null, ['class' => 'input-text', 'placeholder' => 'marty@thefuture.org']) !!}

            @include('common.forms.field-errors', ['errors' => $errors->get('email')])
        </div>
    </div>

	<div class="form-row">
	    {!! Form::label('name_first', 'First Name') !!}

	    <div class="form-row-body">
	        {!! Form::text('name_first', null, ['class' => 'input-text', 'placeholder' => 'First Name']) !!}

	        @include('common.forms.field-errors', ['errors' => $errors->get('name_first')])
	    </div>
	</div>

	<div class="form-row">
	    {!! Form::label('name_last', 'Last Name') !!}

	    <div class="form-row-body">
	        {!! Form::text('name_last', null, ['class' => 'input-text', 'placeholder' => 'Last Name']) !!}

	        @include('common.forms.field-errors', ['errors' => $errors->get('name_last')])
	    </div>
	</div>

	<div class="form-row">
	    {!! Form::label('username', 'Username') !!}

	    <div class="form-row-body">
	        {!! Form::text('username', null, ['class' => 'input-text', 'placeholder' => 'Username']) !!}

	        @include('common.forms.field-errors', ['errors' => $errors->get('username')])
	    </div>
	</div>

	<div class="form-row">
	    {!! Form::label('bio', 'User Bio') !!}

	    <div class="form-row-body">
	        {!! Form::textarea('bio', null, ['class' => 'input-text', 'placeholder' => 'Your Name']) !!}

	        @include('common.forms.field-errors', ['errors' => $errors->get('name_second')])
	    </div>
	</div>

	<div class="form-row">
	    <div class="form-row-body">
	        {!! Form::submit(' Submit ', ['class' => 'btn primary']) !!}
	    </div>
	</div>


    {!! Form::close() !!}

    @role('admin')
		<div class="form no-mgt">
			<div class="form-row">
			    <div class="form-row-body">
			        {!! delete_form(['users.destroy', $user->id]) !!}
			    </div>
			</div>
		</div>
	@endrole

@stop
