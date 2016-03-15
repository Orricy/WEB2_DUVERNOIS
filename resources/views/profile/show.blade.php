@extends('layouts.app')

@section('content')
<div class="panel-heading">Votre profile</div>
<div class="panel-body">
    <h2>{{ $user->name }}</h2>
</div>
@endsection
