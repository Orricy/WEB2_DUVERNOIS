@extends('layouts.app')

@section('content')
<div class="panel-heading">Dashboard</div>
<div class="panel-body">
    <h2>{{$post->title}}</h2>
    <h3>Auteur : {{$post->user->name}}</h3>
    <p>{{$post->description}}</p>
    <div class="row">
    	@foreach($comments as $comment)
    		<div class="comment col-md-12">
				{{ $comment->comment}}
				<small class="row">{{ $comment->user->name}}</small>
    		</div>
    	@endforeach
    </div>
</div>
@endsection
