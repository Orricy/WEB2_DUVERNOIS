@extends('layouts.app')

@section('content')
<div class="panel-heading">Welcome</div>

<div class="panel-body">
    Your Application's Landing Page.
    @if(1)
        ok
    @elseif(1 == 2)
        not good
    @endif
    
</div>
@endsection
