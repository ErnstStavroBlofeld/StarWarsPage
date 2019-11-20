@extends('layout')
@section('head')
<link rel="stylesheet" href="{{ url('css/entities.css') }}">
@endsection
@section('content')
<h1>{{ Str::ucfirst($category) }}</h1>
<div class="entites">
@each('templates.sw-entity', $entities, 'entity')
</div>
@endsection

