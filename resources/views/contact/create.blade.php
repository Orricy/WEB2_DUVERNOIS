@extends('layouts.app')

@section('content')
<div class="panel-heading">Nous contacter</div>

<div class="panel-body">
    @if(isset($result))
        {{-- vérification du résultat suite à l'envoi du formulaire (0 = échec / 1 = réussite) --}}
        @if($result == 0)
            <div class="alert alert-danger alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4><strong>Votre message n'a pas pu être envoyé</strong></h4>
                <p>Erreur : {{$errorLog}}</p>
            </div>
        @else
            <div class="alert alert-success alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4><strong>Votre message a été envoyé avec succès</strong></h4>
            </div>
        @endif
    @endif
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
    {!! Form::open(array('url' => route('contact.store'), 'method' => 'POST')) !!}
    	<p>{!! Form::email('email', Auth::user()->email, array('class' => 'form-control', 'placeholder' => 'votre adresse mail')) !!}</p>
        <p>{!! Form::text('subject', null, array('class' => 'form-control', 'placeholder' => 'le sujet de votre message')) !!}</p>
        <p>{!! Form::textarea('message', null, array('class' => 'form-control', 'rows' => 3, 'placeholder' => 'votre message')) !!}</p>
        {!! Form::submit('Envoyer', array('class' => 'form-control btn btn-primary')) !!}
    {!! Form::close() !!}
</div>
@endsection
