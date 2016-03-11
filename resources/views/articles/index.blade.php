@extends('layouts.app')

@section('content')
<div class="panel-heading">Dashboard</div>

<div class="panel-body">
    Liste des articles
    @foreach($posts as $post)
        <h2>{{$post->title}}</h2>
        <p>{{$post->description}}</p>
        <a href="{{route('articles.show', $post->id)}}">
            <button class="btn btn-info">
                Voir l'article
            </button>
        </a>
        @if(Auth::check() && Auth::user()->id == $post->user_id)
            <a href="{{route('articles.edit', $post->id)}}">
                <button class="btn btn-success">
                    Editer l'article
                </button>
            </a>
            <span class="delete-article-btn">
            {{ Form::model($post, array('route' => array('articles.destroy', $post->id), 'method' => 'DELETE',)) }}
                {!! Form::submit('Supprimer', array('class' => 'btn btn-danger')) !!}
            {{ Form::close() }}
            </span>
        @endif
    @endforeach
</div>
@endsection
