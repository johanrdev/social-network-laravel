@if ($type == 'green')
    @php
        $classes = 'bg-teal-500 hover:bg-teal-700 text-white';
    @endphp
@elseif ($type == 'red')
    @php
        $classes = 'bg-rose-500 hover:bg-rose-700 text-white';
    @endphp
@else
    @php
        $classes = 'bg-teal-500 hover:bg-teal-700 text-white';
    @endphp
@endif

<button {{ $attributes->merge(['type' => 'submit', 'class' => 'py-2 px-5 rounded mb-3 transition-all duration-150 cursor-pointer ' . $classes]) }}>
    {{ $slot }}
</button>