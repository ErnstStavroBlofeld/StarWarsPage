<!doctype html>
<html lang="{{ str_replace('_', '-', App::getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="{{ url('js/app.js') }}"></script>
    @yield('head')

    <title>StarWars - @yield('title', 'Home Page')</title>
</head>
<body>
    <main id="app">
        <header>
            <h1>StarWars - @yield('title', 'Home Page')</h1>
            <nav>
                @foreach(['home', 'people', 'vehicles', 'planets', 'starships', 'species', 'films'] as $type)
                <a href="{{ url('/' . $type) }}" class="{{ $type == ($category ?? 'none') ? 'active' : 'inactive' }}">
                    <img src="{{ url('img/' . $type . '-icon.png') }}" alt="Icon">
                    <p>{{ Str::ucfirst($type) }}</p>
                </a>
                @endforeach
            </nav>
        </header>
        <article>
            @yield('content')
        </article>
    </main>
</body>
</html>