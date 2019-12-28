@extends('../layout')

@section('title', 'Home')

@section('head')
    <link rel="stylesheet" href="{{ url('css/pages/home.css') }}">
@endsection

@section('content')
    <h2>Welcome to StarWars information base</h2>
    <p>This page is dedicated to searching and discovering StarWars related informations.
        To simplify this process we've created 6 categories to choose from.
        If you like this page be sure to share it with your friends!</p>
@endsection
