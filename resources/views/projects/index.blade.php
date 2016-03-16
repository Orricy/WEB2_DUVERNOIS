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
                <h2>{{$project->name}}</h2>
                <p>{{$project->type}}</p>
                <a href="{{route('projects.show', $project->id)}}">
                    <button class="btn btn-info">
                        Voir le projet
                    </button>
                </a>
                @if(Auth::check() && Auth::user()->is_admin == 1)
                    <a href="{{route('projects.edit', $project->id)}}">
                        <button class="btn btn-success">
                            Editer le projet
                        </button>
                    </a>
                    <span class="delete-article-btn">
                    {{-- Form::model($project, array('route' => array('projects.destroy', $project->id), 'method' => 'DELETE',)) }}
                        {!! Form::submit('Supprimer', array('class' => 'btn btn-danger')) !!}
                    {{ Form::close() --}}
                    </span>
                @endif
            @endforeach
        </div>
        {{-- Affichage des projets approuvé --}}
        <div class="col-md-4">
            <h4 class="text-center">Approuvé</h4>
            @foreach($projectsApproved as $project)
                <h2>{{$project->name}}</h2>
                <p>{{$project->type}}</p>
                <a href="{{route('projects.show', $project->id)}}">
                    <button class="btn btn-info">
                        Voir le projet
                    </button>
                </a>
                @if(Auth::check() && Auth::user()->is_admin == 1)
                    <a href="{{route('projects.edit', $project->id)}}">
                        <button class="btn btn-success">
                            Editer le projet
                        </button>
                    </a>
                    <span class="delete-article-btn">
                    {{-- Form::model($project, array('route' => array('projects.destroy', $project->id), 'method' => 'DELETE',)) }}
                        {!! Form::submit('Supprimer', array('class' => 'btn btn-danger')) !!}
                    {{ Form::close() --}}
                    </span>
                @endif
            @endforeach
        </div>
        {{-- Affichage des projets refusé --}}
        <div class="col-md-4">
            <h4 class="text-center">Refusé</h4>
            @foreach($projectsRefused as $project)
                <h2>{{$project->name}}</h2>
                <p>{{$project->type}}</p>
                <a href="{{route('projects.show', $project->id)}}">
                    <button class="btn btn-info">
                        Voir le projet
                    </button>
                </a>
                @if(Auth::check() && Auth::user()->is_admin == 1)
                    <a href="{{route('projects.edit', $project->id)}}">
                        <button class="btn btn-success">
                            Editer le projet
                        </button>
                    </a>
                    <span class="delete-article-btn">
                    {{-- Form::model($project, array('route' => array('projects.destroy', $project->id), 'method' => 'DELETE',)) }}
                        {!! Form::submit('Supprimer', array('class' => 'btn btn-danger')) !!}
                    {{ Form::close() --}}
                    </span>
                @endif
            @endforeach
        </div>
    </div>
</div>
@endsection
