@props([
    'disabled'=> false,
    'placeholder'=> null,
    'options' => []
    ])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class'=>"form-select p-3"]) !!}>
    @if($placeholder!=null)
    <option value="">{{ $placeholder }}</option>
    @endif
    @foreach ($options as $id => $label)
        <option value="{{ $id }}">{{ $label }}</option>
    @endforeach
</select>