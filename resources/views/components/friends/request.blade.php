<div class="flex flex-col last:border-0 border-b border-gray-200 p-3 odd:bg-gray-100">
    <div class="flex">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-1">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244" />
        </svg>
            
            
        <div class="flex flex-col grow">
            <span>
                From
                
                @if ($from->id == Auth::user()->id)
                    you
                @else
                    <a href="{{ route('users.show', $from->id) }}" class="text-rose-500 font-bold underline">{{ $from->name }}</a>
                @endif
                
                to
                
                @if ($to->id == Auth::user()->id)
                    you
                @else
                    <a href="{{ route('users.show', $to->id) }}" class="text-rose-500 font-bold underline">{{ $to->name }}</a>
                @endif
            </span>

            <div class="flex items-center justify-between">
                <span class="text-sm font-bold">{{ $request->created_at->diffForHumans() }}</span>
                <div class="flex justify-end border-b sm:border-0 border-gray-200">
                    @if ($canAccept)
                        <form method="POST" action="{{ route('acceptFriendRequest', $request) }}">
                            @csrf
                            
                            <x-button :type="'green'" class="mr-1 px-1 py-0.5">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                            </x-button>
                        </form>
                    @endif
                    <form method="POST" action="{{ route('declineFriendRequest', $request) }}">
                        @method('DELETE')
                        @csrf
                        
                        <x-button :type="'red'" class="mr-0 px-1 py-0.5">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>
                        </x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>