<div class="px-3 py-2 odd:bg-gray-100 last:border-b-0 border-b border-gray-200">
    <div class="flex">
        <div class="bg-gray-800 rounded-full w-10 h-10 mr-0 mr-3 shrink-0 flex flex-col items-center justify-center self-center sm:self-start">
            <span class="uppercase text-gray-600 font-bold text-xl">U</span>
        </div>
        <div class="flex sm:text-left grow justify-between items-center">
            <h2 class="text-lg font-bold"><a href="{{ route('users.show', $friend) }}">{{ $friend->name }}</a></h2>
            <div>
                {{ $slot }}
            </div>
        </div>
    </div>
</div>