<div class="entity-card">
    <label for="films:{{ $instance->id }}">{{ $instance->title }}</label>

    @if($link ?? false)
        <a href="{{ url('films/' . $instance->id) }}">
            <h2>{{ $instance->title }}</h2>
        </a>
    @else
        <h2>{{ $instance->title }}</h2>
    @endif

    <table class="entity-properties">
        <tr>
            <td>Episode</td>
            <td>{{ $instance->episodeId }}</td>
        </tr>
        <tr>
            <td>Opening crawl</td>
            <td>{{ $instance->openingCrawl }}</td>
        </tr>
        <tr>
            <td>Director</td>
            <td>{{ $instance->director }}</td>
        </tr>
        <tr>
            <td>Producer</td>
            <td>{{ $instance->producer }}</td>
        </tr>
        <tr>
            <td>Release date</td>
            <td>{{ $instance->releaseDate }}</td>
        </tr>
        <tr>
            <td>Characters</td>
            <td>
                @foreach($instance->characters as $characterId)
                    @include('templates.entity-link', ['category' => 'people', 'id' => $characterId])
                @endforeach
            </td>
        </tr>
        <tr>
            <td>Planets</td>
            <td>
                @foreach($instance->planets as $planetId)
                    @include('templates.entity-link', ['category' => 'planets', 'id' => $planetId])
                @endforeach
            </td>
        </tr>
        <tr>
            <td>Starships</td>
            <td>
                @foreach($instance->starships as $starshipId)
                    @include('templates.entity-link', ['category' => 'starships', 'id' => $starshipId])
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
        <tr>
            <td>Species</td>
            <td>
                @foreach($instance->species as $specieId)
                    @include('templates.entity-link', ['category' => 'species', 'id' => $specieId])
                @endforeach
            </td>
        </tr>
    </table>
</div>
