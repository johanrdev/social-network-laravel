@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-4 pt-1 border-b-4 border-indigo-400 text-md font-semibold leading-5 text-gray-200 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out bg-gray-600'
            : 'inline-flex items-center px-4 pt-1 border-b-4 border-transparent text-md font-semibold leading-5 text-gray-400 hover:text-gray-200 hover:border-indigo-200 focus:outline-none focus:text-gray-200 focus:border-indigo-200 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
