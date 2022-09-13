@props(['bodyClasses' => '', 'containerClasses' => ''])

<div {{ $attributes->merge(['class' => 'bg-white overflow-hidden shadow-sm md:rounded-lg grow flex flex-col ' . $containerClasses]) }}>
    <div class="bg-white border-b border-gray-200">
        <div class="flex flex-col p-0">
            <div class="flex flex-col py-3">
                <h2 class="text-center font-black text-md uppercase tracking-widest">{{ $title }}</h2>
            </div>

            @if ($paginate)
                @if ($source->hasPages())
                    <div class="p-3">
                        {{ $source->appends(request()->input())->links() }}
                    </div>
                @endif
            @endif
            
            <div {{ $attributes->merge(['class' => ($scrollY ? 'overflow-y-scroll ' . $maxHeight : '') . ' ' . $bodyClasses]) }}>
                {{ $slot }}
            </div>

            @if ($paginate)
                @if ($source->hasPages())
                    <div class="p-3">
                        {{ $source->appends(request()->input())->links() }}
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>