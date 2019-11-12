@extends('../layout')
@section('head')
<link rel="stylesheet" href="{{ url('css/404.css') }}">
@endsection
@section('content')
<h1>Error - not found</h1>
<div class="file-search">
    <img class="file" src="{{ url('img/file.svg') }}" alt="File icon">
    <img class="search" src="{{ url('img/search.svg') }}" alt="Search icon">
</div>
<h2>404</h2>
<p>It appears that page you're looking for does not exists!</p>
@endsection