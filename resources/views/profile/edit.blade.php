@extends('layouts.app')

@section('content')
<div class="panel-heading">Votre profile</div>
<div class="panel-body">
    {{ Form::model($user, array('route' => array('profile.update', $user->id), 'method' => 'PUT')) }}
        <p>{{ Form::text('name', $user->name, array('class' => 'form-control', 'placeholder' => 'votre nom')) }}</p>
        <p>{{ Form::email('email', $user->email, array('class' => 'form-control', 'placeholder' => 'votre mail')) }}</p>
        <h3>Changer mon mot de passe</h3>
        <p>{{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'votre nouveau mot de passe')) }}</p>
        <p>{{ Form::password('password_confirmation', array('class' => 'form-control', 'placeholder' => 'veuillez retaper votre nouveau mot de passe')) }}</p>
        {!! Form::submit('Editer', array('class' => 'form-control btn btn-success')) !!}
    {{ Form::close() }}
    @if($errors)
        <div class="errors">
            @foreach($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <p class="error-log">{{$error}}</p>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
