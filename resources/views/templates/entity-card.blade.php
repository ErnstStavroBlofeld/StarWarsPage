<div class="entity-card">
    <label for="{{ $category }}:{{ $id }}">{{ $entity->getTitle() }}</label>
    @if($link)
    <a href="{{ url($category . '/' . $id) }}"><h2>{{ $entity->getTitle() }}</h2></a>
    @else
    <h2>{{ $entity->getTitle() }}</h2>
    @endif
    <table class="entity-properties">
        @foreach ($entity->getDisplayProperties() as $property => $value)
        <tr>
            <td>{{ $property }}</td>
            <td>{!! $value == '' ? 'none' : $value !!}</td>
        </tr>        
        @endforeach
    </table>
</div>