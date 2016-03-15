@extends('layouts.app')

@section('content')
<div class="panel-heading">Dashboard</div>
<div class="panel-body">
    <h2>{{$post->title}}</h2>
    <h3>Auteur : {{$post->user->name}}</h3>
    <p>{{$post->description}}</p>
    <div class="row comment-section">
        <div class="col-md-12">
            {!! Form::open(array('url' => route('articles.storeComment', $post->id), 'method' => 'POST')) !!}
                <P>{!! Form::textarea('comment', null, array('class' => 'form-control', 'rows' => 3, 'placeholder' => 'votre commentaire')) !!}</P>
                {!! Form::submit('Envoyer', array('class' => 'form-control btn btn-primary')) !!}
            {!! Form::close() !!}
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
        <div class="col-md-12">
        	@foreach($comments as $comment)
        		<div class="comment col-md-12">
    				{{ $comment->comment}}
    				<small class="row">{{ $comment->user->name}}</small>
        		</div>
        	@endforeach
        </div>
    </div>
</div>
@endsection
