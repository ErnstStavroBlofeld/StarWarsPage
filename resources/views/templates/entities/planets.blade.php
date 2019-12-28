<div class="entity-card">
    <label for="planets:{{ $instance->id }}">{{ $instance->name }}</label>

    @if($link ?? false)
        <a href="{{ url('planets/' . $instance->id) }}">
            <h2>{{ $instance->name }}</h2>
        </a>
    @else
        <h2>{{ $instance->name }}</h2>
    @endif

    <table class="entity-properties">
        <tr>
            <td>Rotation period</td>
            <td>{{ $instance->rotationPeriod }}</td>
        </tr>
        <tr>
            <td>Orbital period</td>
            <td>{{ $instance->orbitalPeriod }}</td>
        </tr>
        <tr>
            <td>Diameter</td>
            <td>{{ $instance->diameter }}</td>
        </tr>
        <tr>
            <td>Climate</td>
            <td>{{ $instance->climate }}</td>
        </tr>
        <tr>
            <td>Gravity</td>
            <td>{{ $instance->gravity }}</td>
        </tr>
        <tr>
            <td>Terrain</td>
            <td>{{ $instance->terrain }}</td>
        </tr>
        <tr>
            <td>Surface water</td>
            <td>{{ $instance->surfaceWater }}</td>
        </tr>
        <tr>
            <td>Population</td>
            <td>{{ $instance->population }}</td>
        </tr>
        <tr>
            <td>Residents</td>
            <td>
                @foreach($instance->residents as $residentId)
                    @include('templates.entity-link', ['category' => 'people', 'id' => $residentId])
                @endforeach
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
    </table>
</div>
