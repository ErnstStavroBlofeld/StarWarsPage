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
@endsection

