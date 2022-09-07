@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-semibold text-sm text-gray-400']) }}>
    {{ $value ?? $slot }}
</label>
