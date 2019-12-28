@extends('../layout')

@section('title', Str::ucfirst($category))

@section('head')
    <link rel="stylesheet" href="{{ url('css/pages/entities.css') }}">
    <script src="{{ url('js/pages/entities.js') }}"></script>
@endsection

@section('content')
    <div class="entities">
        @foreach ($entities as $entity)
            @include('templates.entities.' . $category, [
                'instance' => $entity,
                'link' => true
            ])
        @endforeach
    </div>
@endsection
