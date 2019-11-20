<div class="entity">
    <label hidden for="{{ $entity::category() . ':' . $entity->id }}">{{ $entity->getTitle() }}</label>
    <a href="{{ url('/' . $entity::category() . '/' . $entity->id ) }}" class="title">{{ $entity->getTitle() }}</a>
    @foreach ($entity->getDisplayProperties() as $name => $value)
    @if($value != '')
    <div class="property">
        <div class="name">{{ $name }}</div>
        <div class="value">{!! $value !!}</div>
    </div>
    @endif
    @endforeach
</div>
