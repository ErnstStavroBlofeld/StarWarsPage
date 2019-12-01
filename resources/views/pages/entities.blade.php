@extends('../layout')

@section('title', $categoryDisplayName)

@section('head')
<link rel="stylesheet" href="{{ url('css/pages/entities.css') }}">
<script src="{{ url('js/pages/entities.js') }}"></script>
@endsection

@section('content')
<div class="entities">
    @foreach ($entities as $entity)
        @include('templates.entity-card', [ 
            'entity' => $entity, 
            'link' => true,
            'category' => $category,
            'id' => $entity->id
        ])
    @endforeach
</div>
@endsection
