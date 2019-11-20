@php
$reflection = new ReflectionClass($entity);
$processed = [];
$categoryAliases = [
    'pilots' => 'people',
    'characters' => 'people',
    'residents' => 'people'
];

foreach ($reflection->getProperties() as $property) {
    $value = $property->getValue($entity);

    if (is_array($value)) {
        $category = $property->getName();
        $category = $categoryAliases[$category] ?? $category;

        $value = array_map(function ($objectId) use ($category) {
            return url('/' . $category . '/' . $objectId);
        }, $value);
    } else if ($value instanceof DateTime) {
        $value = $value->format('Y-m-d H:i:s');
    }

    $processed[$property->getName()] = $value;
}
@endphp
<div class="entity">
    <div class="title">{{ $entity->getTitle() }}</div>
    @foreach ($processed as $name => $value)
    <div class="property">
        <div class="name">{{ Str::ucfirst($name) }}</div>
        <div class="value">
        @if(is_array($value))
        @foreach($value as $item)
            <div class="row">{{ $item }}</div>
        @endforeach
        @else{{ $value }}@endif
        </div>
    </div>
    @endforeach
</div>
