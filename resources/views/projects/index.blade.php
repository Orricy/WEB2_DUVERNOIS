@extends('layouts.app')

@section('content')
<div class="panel-heading">Dashboard</div>

<div class="panel-body">
    <h3 class="text-center">Liste des projets</h3>
    <div class="row">
        <div class="col-md-3">
            @foreach($projectsWaiting as $post)
                <h2>{{$post->name}}</h2>
                <p>{{$post->type}}</p>
                <a href="{{route('articles.show', $post->id)}}">
                    <button class="btn btn-info">
                        Voir l'article
                    </button>
                </a>
                @if(Auth::check() && Auth::user()->is_admin == 1)
                    <a href="{{route('articles.edit', $post->id)}}">
                        <button class="btn btn-success">
                            Editer l'article
                        </button>
                    </a>
                    <span class="delete-article-btn">
                    {{-- Form::model($post, array('route' => array('articles.destroy', $post->id), 'method' => 'DELETE',)) }}
                        {!! Form::submit('Supprimer', array('class' => 'btn btn-danger')) !!}
                    {{ Form::close() --}}
                    </span>
                @endif
            @endforeach
        </div>
    </div>
</div>
@endsection
