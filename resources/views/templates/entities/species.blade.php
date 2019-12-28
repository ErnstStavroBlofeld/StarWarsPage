<div class="entity-card">
    <label for="species:{{ $instance->id }}">{{ $instance->name }}</label>

    @if($link ?? false)
        <a href="{{ url('species/' . $instance->id) }}">
            <h2>{{ $instance->name }}</h2>
        </a>
    @else
        <h2>{{ $instance->name }}</h2>
    @endif

    <table class="entity-properties">
        <tr>
            <td>Classification</td>
            <td>{{ $instance->classification }}</td>
        </tr>
        <tr>
            <td>Designation</td>
            <td>{{ $instance->designation }}</td>
        </tr>
        <tr>
            <td>Average height</td>
            <td>{{ $instance->averageHeight }}</td>
        </tr>
        <tr>
            <td>Skin colors</td>
            <td>{{ $instance->skinColors }}</td>
        </tr>
        <tr>
            <td>Hair colors</td>
            <td>{{ $instance->hairColors }}</td>
        </tr>
        <tr>
            <td>Eye colors</td>
            <td>{{ $instance->eyeColors }}</td>
        </tr>
        <tr>
            <td>Average lifespan</td>
            <td>{{ $instance->averageLifespan }}</td>
        </tr>
        <tr>
            <td>People</td>
            <td>
                @foreach($instance->people as $peopleId)
                    @include('templates.entity-link', ['category' => 'people', 'id' => $peopleId])
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
