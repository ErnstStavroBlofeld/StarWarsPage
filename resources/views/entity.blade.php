@extends('layout')
@section('head')
<link rel="stylesheet" href="{{ url('css/entity.css') }}">
@endsection
@section('content')
<h1>{{ Str::ucfirst($category) }}</h1>
@include('templates.sw-entity', ['entity' => $entity])
@endsection
