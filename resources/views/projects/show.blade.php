@extends('layouts.app')

@section('content')
<div class="panel-heading">
	<h2>Demande D'inscription à la bourse aux projets de l'IIM</h2>
</div>

<div class="panel-body">
    <div class="row">
        <div class="col-md-12">
            @if($project->status == 'waiting approval')
            <div class="alert alert-warning" role="alert">
            @elseif($project->status == 'approved')
            <div class="alert alert-success" role="alert">
            @elseif($project->status == 'refused')
            <div class="alert alert-danger" role="alert">
            @endif
                <h2 class="text-center"><strong>{{ $project->name }}</strong></h2>
                <h3 class="text-center">{{ $project->type }}</h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h3 class="text-center">Créateur</h3>
            <h4>{{ $project->creator }}</h4>
            <p>adresse : {{ $project->adress_creator }}</p>
            <p>email : {{ $project->email_creator }}</p>
            <p>tél : {{ $project->phone_creator }}</p>
        </div>
        <div class="col-md-6">
            <h3 class="text-center">Contact</h3>
            <h4>{{ $project->contact }}</h4>
            <p>adresse : {{ $project->adress_contact }}</p>
            <p>email : {{ $project->email_contact }}</p>
            <p>tél : {{ $project->phone_contact }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-center">IDENTITE</h3>
            <p>{{ $project->identity }}</p>
        </div>
        <div class="col-md-12">
            <h3 class="text-center">CONTEXTE</h3>
            <p>{{ $project->context }}</p>
        </div>
        <div class="col-md-12">
            <h3 class="text-center">DEMANDE</h3>
            <p>{{ $project->demand }}</p>
        </div>
        <div class="col-md-12">
            <h3 class="text-center">OBJECTIF(S)</h3>
            <p>{{ $project->goal }}</p>
        </div>
        <div class="col-md-12">
            <h3 class="text-center">AUTRE</h3>
            <p>{{ $project->other }}</p>
        </div>
    </div>
</div>
@endsection