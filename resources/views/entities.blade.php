@extends('layout')
@section('head')
<link rel="stylesheet" href="{{ url('css/entities.css') }}">
@endsection
@section('content')
<div class="top-bar">
    <h1>{{ Str::ucfirst($category) }}</h1>
    <input id="search" type="text" placeholder="Wyszukaj">
</div>
<div class="entites">
@each('templates.sw-entity', $entities, 'entity')
</div>
<div class="no-results hidden">
<h2>No results</h2>
<h3>:c</h3>
</div>
@endsection

