@extends('layouts.app')

@section('content')
<div class="panel-heading">Dashboard</div>

<div class="panel-body">
    {{ Form::model($post, array('route' => array('articles.update', $post->id), 'method' => 'PUT',)) }}
        <p>{{ Form::text('title', $post->title, array('class' => 'form-control')) }}</p>
        <p>{{ Form::textarea('description', $post->description, array('class' => 'form-control', 'rows' => 5)) }}</p>
        <p>{!! Form::select('user_id', $users, null, array('class' => 'form-control')) !!}</p>
        {!! Form::submit('Editer', array('class' => 'form-control btn btn-success')) !!}
    {{ Form::close() }}
    @if($errors)
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
