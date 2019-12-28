@extends('../layout')

@section('title', Str::ucfirst($category))

@section('head')
    <link rel="stylesheet" href="{{ url('css/pages/entity.css') }}">
    <script src="{{ url('js/pages/entity.js') }}"></script>
@endsection

@section('content')
    @include('templates.entities.' . $category, ['instance' => $entity])
@endsection
