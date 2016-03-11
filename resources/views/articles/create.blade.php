@extends('layouts.app')

@section('content')
<div class="col-md-10 col-md-offset-1">
    <h1>Formulaire</h1>
    {!! Form::open(array('url' => route('articles.store'), 'method' => 'POST')) !!}
        {{-- Form::select('user_id', $users, null, array('class' => 'form-control')) --}}
        <br>
        {!! Form::text('title', null, array('class' => 'form-control', 'placeholder' => 'Le titre de l\'article')) !!}
        <br>
        {!! Form::textarea('description', null, array('class' => 'form-control', 'placeholder' => 'la description de l\'article')) !!}
        <br>
        {!! Form::submit('Envoyer', array('class' => 'form-control btn btn-primary')) !!}
    {!! Form::close() !!}
    @if($errors)
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
