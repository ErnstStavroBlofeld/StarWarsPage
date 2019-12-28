<div class="entity-card">
    <label for="people:{{ $instance->id }}">{{ $instance->name }}</label>

    @if($link ?? false)
        <a href="{{ url('people/' . $instance->id) }}">
            <h2>{{ $instance->name }}</h2>
        </a>
    @else
        <h2>{{ $instance->name }}</h2>
    @endif

    <table class="entity-properties">
        <tr>
            <td>Height</td>
            <td>{{ $instance->height }}</td>
        </tr>
        <tr>
            <td>Mass</td>
            <td>{{ $instance->mass }}</td>
        </tr>
        <tr>
            <td>Hair color</td>
            <td>{{ $instance->hairColor }}</td>
        </tr>
        <tr>
            <td>Skin color</td>
            <td>{{ $instance->skinColor }}</td>
        </tr>
        <tr>
            <td>Eye color</td>
            <td>{{ $instance->eyeColor }}</td>
        </tr>
        <tr>
            <td>Birth year</td>
            <td>{{ $instance->birthYear }}</td>
        </tr>
        <tr>
            <td>Gender</td>
            <td>{{ $instance->gender }}</td>
        </tr>
        <tr>
            <td>Homeworld</td>
            <td>
                @include('templates.entity-link', ['category' => 'planets', 'id' => $instance->id])
            </td>
        </tr>
        <tr>
            <td>Films</td>
            <td>
                @foreach($instance->films as $filmId)
                    @include('templates.entity-link', ['category' => 'films', 'id' => $filmId])
                @endforeach
            </td>
        </tr>
        <tr>
            <td>Species</td>
            <td>
                @foreach($instance->species as $specieId)
                    @include('templates.entity-link', ['category' => 'species', 'id' => $specieId])
                @endforeach
            </td>
        </tr>
        <tr>
            <td>Vehicles</td>
            <td>
                @foreach($instance->vehicles as $vehicleId)
                    @include('templates.entity-link', ['category' => 'vehicles', 'id' => $vehicleId])
                @endforeach
            </td>
        </tr>
    </table>
</div>
