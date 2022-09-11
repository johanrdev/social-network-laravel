<div class="px-3 py-2 odd:bg-gray-100 last:border-b-0 border-b border-gray-200">
    <div class="flex">
        <div class="bg-gray-800 rounded-full w-10 h-10 mr-0 mr-3 shrink-0 flex flex-col items-center justify-center self-center sm:self-start">
            <span class="uppercase text-gray-600 font-bold text-xl">U</span>
        </div>
        <div class="flex sm:text-left grow justify-between items-center">
            <h2 class="text-lg font-bold"><a href="{{ route('users.show', $friend) }}">{{ $friend->name }}</a></h2>
            <form method="POST" action="{{ route('friends.destroy', $friend) }}">
                @method('DELETE')
                @csrf
                
                <input type="hidden" name="friend_id" value="{{ $friend->id }}" />
                <x-button :type="'transparent'">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M22 10.5h-6m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                      </svg>                                                  
                </x-button>
            </form>
        </div>
    </div>
</div>