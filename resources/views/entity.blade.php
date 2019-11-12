@extends('layout')
@section('head')
<link rel="stylesheet" href="{{ url('css/entity.css') }}">
@endsection
@section('content')
<h1>{{ Str::ucfirst($category) }}</h1>
@if ($data instanceof Illuminate\Support\Collection)
    <sw-entity-list>
    @each('templates.sw-entity', $data, 'entity')
    </sw-entity-list>
@else
    @each('templates.sw-entity', [$data], 'entity')
@endif
@endsection

