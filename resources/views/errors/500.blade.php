@extends('../layout')

@section('head')
<link rel="stylesheet" href="{{ url('css/errors/500.css') }}">
@endsection

@section('content')
<h1>Error - internal page crash</h1>
<div class="exposion">
    <img class="box" src="{{ url('img/box.svg') }}" alt="Icon">
    <img class="box" src="{{ url('img/box.svg') }}" alt="Icon">
    <img class="box" src="{{ url('img/box.svg') }}" alt="Icon">
    <img class="dynamite" src="{{ url('img/dynamite.svg') }}" alt="Icon">
</div>
<p>We are sorry for the inconvenience :c</p>
@endsection
