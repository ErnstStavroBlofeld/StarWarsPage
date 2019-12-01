@extends('../layout')

@section('title', $categoryDisplayName)

@section('head')
<link rel="stylesheet" href="{{ url('css/pages/entity.css') }}">
<script src="{{ url('js/pages/entity.js') }}"></script>
@endsection

@section('content')
@include('templates.entity-card', [ 
    'entity' => $entity, 
    'link' => false, 
    'category' => $category,
    'id' => $entity->id
])
@endsection
