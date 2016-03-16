@extends('layouts.app')

@section('content')
<div class="panel-heading">Dashboard</div>

<div class="panel-body">
    <h3 class="text-center">Liste des projets</h3>
    <div class="row">
    {{-- Affichage des projets en attente de validation --}}
        <div class="col-md-4">
            <h4 class="text-center">En attente de validation</h4>
            @foreach($projectsWaiting as $project)
                <div class="project">
                    <div class="alert alert-warning" role="alert">
                        <a href="{{route('projects.show', $project->id)}}" class="text-center"><h2>{{$project->name}}</h2></a>
                        <p class="text-center">{{$project->type}}</p>
                        @if(Auth::check() && Auth::user()->is_admin == 1)
                            <div class="row">
                                <div class="col-md-6">
                                    {{ Form::model($project, array('route' => array('projects.updateStatus', $project->id), 'method' => 'POST',)) }}
                                        {!! Form::hidden('status', 'approved') !!}
                                        {!! Form::submit('Approuver', array('class' => 'btn btn-block btn-success')) !!}
                                    {{ Form::close() }}
                                </div>
                                <div class="col-md-6">
                                    {{ Form::model($project, array('route' => array('projects.updateStatus', $project->id), 'method' => 'POST',)) }}
                                        {!! Form::hidden('status', 'refused') !!}
                                        {!! Form::submit('Refuser', array('class' => 'btn btn-block btn-danger')) !!}
                                    {{ Form::close() }}
                                </div>
                            </div>
                            <div class="row project-btn-second-row">
                                <div class="col-md-6">
                                    <a href="{{route('projects.edit', $project->id)}}">
                                        <button class="btn btn-block btn-primary">
                                            Editer le projet
                                        </button>
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    {{ Form::model($project, array('route' => array('projects.destroy', $project->id), 'method' => 'DELETE',)) }}
                                        {!! Form::submit('Supprimer', array('class' => 'btn btn-block btn-danger')) !!}
                                    {{ Form::close() }}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>  
            @endforeach
        </div>
        {{-- Affichage des projets approuvé --}}
        <div class="col-md-4">
            <h4 class="text-center">Approuvé</h4>
            @foreach($projectsApproved as $project)
                <div class="project">
                    <div class="alert alert-success" role="alert">
                        <a href="{{route('projects.show', $project->id)}}" class="text-center"><h2>{{$project->name}}</h2></a>
                        <p class="text-center">{{$project->type}}</p>
                        @if(Auth::check() && Auth::user()->is_admin == 1)
                            <div class="row">
                                <div class="col-md-6">
                                    {{ Form::model($project, array('route' => array('projects.updateStatus', $project->id), 'method' => 'POST',)) }}
                                        {!! Form::hidden('status', 'approved') !!}
                                        {!! Form::submit('Approuver', array('class' => 'btn btn-block btn-success')) !!}
                                    {{ Form::close() }}
                                </div>
                                <div class="col-md-6">
                                    {{ Form::model($project, array('route' => array('projects.updateStatus', $project->id), 'method' => 'POST',)) }}
                                        {!! Form::hidden('status', 'refused') !!}
                                        {!! Form::submit('Refuser', array('class' => 'btn btn-block btn-danger')) !!}
                                    {{ Form::close() }}
                                </div>
                            </div>
                            <div class="row project-btn-second-row">
                                <div class="col-md-6">
                                    <a href="{{route('projects.edit', $project->id)}}">
                                        <button class="btn btn-block btn-primary">
                                            Editer le projet
                                        </button>
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    {{ Form::model($project, array('route' => array('projects.destroy', $project->id), 'method' => 'DELETE',)) }}
                                        {!! Form::submit('Supprimer', array('class' => 'btn btn-block btn-danger')) !!}
                                    {{ Form::close() }}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        {{-- Affichage des projets refusé --}}
        <div class="col-md-4">
            <h4 class="text-center">Refusé</h4>
            @foreach($projectsRefused as $project)
                <div class="project">
                    <div class="alert alert-danger" role="alert">
                        <a href="{{route('projects.show', $project->id)}}" class="text-center"><h2>{{$project->name}}</h2></a>
                        <p class="text-center">{{$project->type}}</p>
                        @if(Auth::check() && Auth::user()->is_admin == 1)
                            <div class="row">
                                <div class="col-md-6">
                                    {{ Form::model($project, array('route' => array('projects.updateStatus', $project->id), 'method' => 'POST',)) }}
                                        {!! Form::hidden('status', 'approved') !!}
                                        {!! Form::submit('Approuver', array('class' => 'btn btn-block btn-success')) !!}
                                    {{ Form::close() }}
                                </div>
                                <div class="col-md-6">
                                    {{ Form::model($project, array('route' => array('projects.updateStatus', $project->id), 'method' => 'POST',)) }}
                                        {!! Form::hidden('status', 'refused') !!}
                                        {!! Form::submit('Refuser', array('class' => 'btn btn-block btn-danger')) !!}
                                    {{ Form::close() }}
                                </div>
                            </div>
                            <div class="row project-btn-second-row">
                                <div class="col-md-6">
                                    <a href="{{route('projects.edit', $project->id)}}">
                                        <button class="btn btn-block btn-primary">
                                            Editer le projet
                                        </button>
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    {{ Form::model($project, array('route' => array('projects.destroy', $project->id), 'method' => 'DELETE',)) }}
                                        {!! Form::submit('Supprimer', array('class' => 'btn btn-block btn-danger')) !!}
                                    {{ Form::close() }}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('projects.create') }}" class="btn btn-block btn-lg btn-primary" role="button">Créer votre projet</a>
        </div>
    </div>
</div>
@endsection
