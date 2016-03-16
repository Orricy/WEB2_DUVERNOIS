@extends('layouts.app')

@section('content')
<div class="panel-heading">
	<h2>Demande D'inscription à la bourse aux projets de l'IIM</h2>
</div>

<div class="panel-body">
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
    {{ Form::model($project, array('route' => array('articles.update', $project->id), 'method' => 'PUT',)) }}
    	<p>{!! Form::text('project_name', null, array('class' => 'form-control', 'placeholder' => 'NOM DU PROJET')) !!}</p>
    	<p>{!! Form::text('project_creator', null, array('class' => 'form-control', 'placeholder' => 'Nom, Prénom et fonction du commanditaire du projet')) !!}</p>
    	<p>{!! Form::text('project_adress', null, array('class' => 'form-control', 'placeholder' => 'Adresse postale')) !!}</p>
    	<p>{!! Form::email('project_email', null, array('class' => 'form-control', 'placeholder' => 'Email')) !!}</p>
    	<p>{!! Form::text('project_phone', null, array('class' => 'form-control', 'placeholder' => 'Téléphone')) !!}</p>
    	<p>{!! Form::text('project_mediator', null, array('class' => 'form-control', 'placeholder' => 'Nom et fonction du contact pour le suivi du projet avec étudiants')) !!}</p>
    	<p>{!! Form::text('mediator_adress', null, array('class' => 'form-control', 'placeholder' => 'Adresse postale')) !!}</p>
    	<p>{!! Form::email('mediator_email', null, array('class' => 'form-control', 'placeholder' => 'Email')) !!}</p>
    	<p>{!! Form::text('mediator_phone', null, array('class' => 'form-control', 'placeholder' => 'Téléphone')) !!}</p>
    	<h4 class="text-center">VOTRE FICHE D’IDENTITE</h4>
        <p>{!! Form::textarea('identity', null, array('class' => 'form-control', 'rows' => 5, 'placeholder' => 'votre fiche d\'identité')) !!}</p>
        <h3 class="text-center">Description du projet</h3>
        <h4 class="text-center">TYPE DE PROJET</h4>
        <p>{!! Form::select('project_type', array(
        	'SITE INTERNET' => 'SITE INTERNET', 
        	'3D' => '3D',
        	'ANIMATION 2D' => 'ANIMATION 2D',
        	'INSTALLATION MULTIMÉDIA' => 'INSTALLATION MULTIMÉDIA',
        	'JEU VIDÉO' => 'JEU VIDÉO',
        	'DVD' => 'DVD',
        	'PRINT' => 'PRINT',
        	'CD-ROM' => 'CD-ROM',
        	'EVÉNEMENT' => 'EVÉNEMENT',
        	'AUTRE' => 'AUTRE'
        	), null, array('class' => 'form-control')) 
        !!}</p>
        <h4 class="text-center">CONTEXTE DE LA DEMANDE</h4>
        <p>{!! Form::textarea('context', null, array('class' => 'form-control', 'rows' => 3, 'placeholder' => 'Pourquoi')) !!}</p>
        <h4 class="text-center">VOTRE DEMANDE</h4>
        <p>{!! Form::textarea('demand', null, array('class' => 'form-control', 'rows' => 5, 'placeholder' => 'Formulez précisément votre demande en décrivant le projet tel que vous le voyez.')) !!}</p>
        <h4 class="text-center">VOS OBJECTIFS</h4>
        <p>{!! Form::textarea('goal', null, array('class' => 'form-control', 'rows' => 5, 'placeholder' => 'Quelles sont vos attentes ?')) !!}</p>
        <h4 class="text-center">CONTRAINTES PARTICULIÈRES ÉVENTUELLES ET INFORMATIONS COMPLEMENTAIRES</h4>
        <p>{!! Form::textarea('other', null, array('class' => 'form-control', 'rows' => 2, 'placeholder' => 'Toutes information complémentaire utile')) !!}</p>
        {!! Form::submit('Envoyer', array('class' => 'form-control btn btn-primary')) !!}
    {!! Form::close() !!}
</div>
@endsection