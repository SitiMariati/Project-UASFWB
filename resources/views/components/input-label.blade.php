@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-semibold text-base text-gray-700 mb-2']) }}>
    {{ $value ?? $slot }}
</label>
