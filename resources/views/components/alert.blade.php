@switch ($type)
    @case('success')
        @php
            $classes = 'bg-teal-500 border-teal-700';
        @endphp
        @break
    @case('danger')
        @php
            $classes = 'bg-rose-500 border-rose-700';
        @endphp
        @break
    @case('warning')
        @php
            $classes = 'bg-amber-500 border-amber-700';
        @endphp
        @break
    @case('info')
        @php
            $classes = 'bg-sky-500 border-sky-700';
        @endphp
        @break
    @default
        @php
            $classes = 'bg-teal-500 border-teal-700';
        @endphp
        @break
@endswitch

<div {{ $attributes->merge(['class' => 'border-b-2 text-white rounded px-6 py-3 mb-3 ' . $classes]) }}>
    {{ $message }}
</div>