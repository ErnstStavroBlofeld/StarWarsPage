@extends('../layout')

@section('head')
<link rel="stylesheet" href="{{ url('css/errors/404.css') }}">
@endsection

@section('content')
<h1>Error - not found</h1>
<div class="file-search">
    <img class="file" src="{{ url('img/scroll.svg') }}" alt="Icon">
    <img class="search" src="{{ url('img/search.svg') }}" alt="Icon">
</div>
<h2>404</h2>
<p>It appears that page you're looking for does not exists!</p>
@endsection
