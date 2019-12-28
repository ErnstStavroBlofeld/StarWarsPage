<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', App::getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#222">
    <link rel="icon" href="{{ url('img/planets.svg') }}">
    @yield('head')
    <title>StarWars - @yield('title')</title>
</head>
<body>
<main id="app">
    <header>
        <h1>StarWars</h1>
        @if(isset($navigation))
            <nav class="route-buttons">
                @foreach ($navigation as $route)
                    <a href="{{ url('/' . $route) }}" {{ $route == $location ? 'current' : '' }}>
                        <img src="{{ url('img/' . $route . '.svg') }}" alt="Icon">
                        <p>{{ Str::ucfirst($route) }}</p>
                    </a>
                @endforeach
            </nav>
        @endif
    </header>
    <article>
        <h1>@yield('title')</h1>
        <div class="content">
            @yield('content')
        </div>
    </article>
</main>
</body>
</html>
