@extends('layouts.app')

@section('content')
<div class="panel-heading">Nous contacter</div>

<div class="panel-body">
    {!! Form::open(array('url' => route('contact.store'), 'method' => 'POST')) !!}
    	<p>{!! Form::email('email', null, array('class' => 'form-control', 'placeholder' => 'votre adresse mail')) !!}</p>
        <p>{!! Form::textarea('message', null, array('class' => 'form-control', 'rows' => 3, 'placeholder' => 'votre message')) !!}</p>
        {!! Form::submit('Envoyer', array('class' => 'form-control btn btn-primary')) !!}
    {!! Form::close() !!}
</div>
@endsection
