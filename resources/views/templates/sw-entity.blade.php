<sw-entity>
    @foreach($entity->properties as $property => $value)
    <span data-key="{{ $property }}">
        @foreach ((($value instanceof Illuminate\Support\Collection) ? $value : collect($value)) as $data)
        <pre>{{ var_dump($data) }}</pre>
        @endforeach
    </span>
    <br>
    @endforeach
</sw-entity>