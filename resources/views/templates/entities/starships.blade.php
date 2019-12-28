<div class="entity-card">
    <label for="starships:{{ $instance->id }}">{{ $instance->name }}</label>

    @if($link ?? false)
        <a href="{{ url('starships/' . $instance->id) }}">
            <h2>{{ $instance->name }}</h2>
        </a>
    @else
        <h2>{{ $instance->name }}</h2>
    @endif

    <table class="entity-properties">
        <tr>
            <td>Model</td>
            <td>{{ $instance->model }}</td>
        </tr>
        <tr>
            <td>Manufacturer</td>
            <td>{{ $instance->manufacturer }}</td>
        </tr>
        <tr>
            <td>Const (in credits)</td>
            <td>{{ $instance->costInCredits }}</td>
        </tr>
        <tr>
            <td>Length</td>
            <td>{{ $instance->length }}</td>
        </tr>
        <tr>
            <td>Maximum atmosphering speed</td>
            <td>{{ $instance->maxAtmospheringSpeed }}</td>
        </tr>
        <tr>
            <td>Crew</td>
            <td>{{ $instance->crew }}</td>
        </tr>
        <tr>
            <td>Passengers</td>
            <td>{{ $instance->passengers }}</td>
        </tr>
        <tr>
            <td>Cargo capacity</td>
            <td>{{ $instance->cargoCapacity }}</td>
        </tr>
        <tr>
            <td>Consumables</td>
            <td>{{ $instance->consumables }}</td>
        </tr>
        <tr>
            <td>Hyperdrive rating</td>
            <td>{{ $instance->hyperdriveRating }}</td>
        </tr>
        <tr>
            <td>MGLT</td>
            <td>{{ $instance->MGLT }}</td>
        </tr>
        <tr>
            <td>Class</td>
            <td>{{ $instance->starshipClass }}</td>
        </tr>
        <tr>
            <td>Pilots</td>
            <td>
                @foreach($instance->pilots as $pilotId)
                    @include('templates.entity-link', ['category' => 'people', 'id' => $pilotId])
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
