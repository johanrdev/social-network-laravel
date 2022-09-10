@switch ($type)
    @case('green')
        @php
            $classes = 'bg-teal-500 hover:bg-teal-700 text-white border-teal-700 border-b-2 hover:border-teal-900';
        @endphp
        @break
    @case('red')
        @php
            $classes = 'bg-rose-500 hover:bg-rose-700 text-white border-rose-700 border-b-2 hover:border-rose-900';
        @endphp
        @break
    @case('transparent')
        @php
            $classes = 'py-0 px-0 bg-transparent hover:bg-transparent text-rose-500 hover:text-rose-700 underline border-transparent border-b-0 hover:border-transparent';
        @endphp
        @break
    @default
        @php
            $classes = 'bg-teal-500 hover:bg-teal-700 text-white border-teal-700 border-b-2 hover:border-teal-900';
        @endphp
        @break
@endswitch

<button {{ $attributes->merge(['type' => 'submit', 'class' => 'py-3 rounded mb-0 transition-all duration-150 cursor-pointer font-black text-sm uppercase tracking-widest ' . $classes]) }}>
    {{ $slot }}
</button>