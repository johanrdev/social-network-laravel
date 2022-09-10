@props(['active'])

@php
$classes = ($active ?? false)
            ? 'border-indigo-400 text-gray-200 focus:outline-none focus:border-indigo-700 bg-gray-600'
            : 'border-transparent text-gray-400 hover:text-gray-200 hover:border-indigo-200 focus:outline-none focus:text-gray-200 focus:border-indigo-200';
@endphp

<a {{ $attributes->merge(['class' => 'inline-flex items-center px-4 pt-1 border-b-4 uppercase leading-5 text-xs tracking-widest font-bold transition duration-150 ease-in-out mt-2 pb-2 rounded-t ' . $classes]) }}>
    {{ $slot }}
</a>
