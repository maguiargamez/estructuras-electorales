@props([
    'disabled'=> false,
    'placeholder'=> 'Select',
    'options' => []
    ])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class'=>"form-select p-2"]) !!}>
    <option value="">{{ $placeholder }}</option>
    @foreach ($options as $id => $label)
        <option value="{{ $id }}">{{ $label }}</option>
    @endforeach
</select>