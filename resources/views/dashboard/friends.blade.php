<div class="mb-6 pb-6 border-b border-gray-200">
    <div class="flex flex-col py-3">
        <h2 class="text-2xl font-bold">{{ count(Auth::user()->incomingRequests) }} {{ count(Auth::user()->incomingRequests) == 1 ? 'Incoming Request' : 'Incoming Requests' }}</h2>
    </div>
    
    @if (count(Auth::user()->incomingRequests) > 0)
        @foreach (Auth::user()->incomingRequests as $friendRequest)
            <div class="flex flex-col mb-6 sm:mb-0 sm:flex-row sm:items-start sm:justify-between">
                <div class="flex">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244" />
                    </svg>
                      
                      
                    <span class="mb-3">
                        <a href="{{ route('users.show', $friendRequest->user->id) }}" class="text-rose-500 font-bold underline">{{ $friendRequest->user->name }}</a> wants to be your friend!
                        <br>
                        <span class="text-sm font-bold">{{ $friendRequest->created_at->diffForHumans() }}</span>
                    </span>
                </div>
                
                <div class="flex shrink-0 sm:shrink-1 border-b sm:border-0 border-gray-200 pb-6 sm:pb-0">
                    <form method="POST" action="{{ route('acceptFriendRequest', $friendRequest) }}">
                        @csrf
                        
                        <x-button :type="'transparent'" class="grow">Accept</x-button>
                    </form>
                    <form method="POST" action="{{ route('declineFriendRequest', $friendRequest) }}">
                        @method('DELETE')
                        @csrf
                        
                        <x-button :type="'transparent'" class="grow">Decline</x-button>
                    </form>
                </div>
            </div>
        @endforeach
    @else
        <p>No pending incoming friend requests</p>
    @endif
</div>

<div class="mb-6 pb-6 border-b border-gray-200">
    <div class="flex flex-col py-3 mt-6">
        <h2 class="text-2xl font-bold">{{ count(Auth::user()->outgoingRequests) }} {{ count(Auth::user()->outgoingRequests) == 1 ? 'Outgoing Request' : 'Outgoing Requests' }}</h2>
    </div>
    
    @if (count(Auth::user()->outgoingRequests) > 0)
        @foreach (Auth::user()->outgoingRequests as $request)
            <div class="flex">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244" />
                </svg>
                  
                  
                <span class="mb-3">
                    You requested a friendship with <a href="{{ route('users.show', $request->friend->id) }}" class="text-rose-500 font-bold underline">{{ $request->friend->name }}</a>
                    <br>
                    <span class="text-sm font-bold">{{ $request->created_at->diffForHumans() }}</span>
                </span>
            </div>
        @endforeach
    @else
        <p>No pending outgoing friend requests</p>
    @endif
</div>

<div class="mb-6 pb-6 border-b-0">
    <div class="flex flex-col py-3">
        <h2 class="text-2xl font-bold">{{ count(Auth::user()->friends) }} {{ count(Auth::user()->friends) == 1 ? 'Friend' : 'Friends' }}</h2>
    </div>
    
    @if (count(Auth::user()->friends) > 0)
        @foreach (Auth::user()->friends as $friend)

            <div class="px-3 py-2 odd:bg-gray-100 last:border-b-0 border-b border-gray-200">
                <div class="flex">
                    <div class="bg-gray-800 rounded-full w-10 h-10 mr-0 mr-3 shrink-0 flex flex-col items-center justify-center self-center sm:self-start">
                        <span class="uppercase text-gray-600 font-bold text-xl">U</span>
                    </div>
                    <div class="flex text-center sm:text-left grow justify-between items-center">
                        <h2 class="text-xl font-bold"><a href="{{ route('users.show', $friend) }}">{{ $friend->name }}</a></h2>
                        <form method="POST" action="{{ route('friends.destroy', $friend) }}">
                            @method('DELETE')
                            @csrf
                            
                            <input type="hidden" name="friend_id" value="{{ $friend->id }}" />
                            <x-button :type="'transparent'">Remove friend</x-button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <p>No friends were found</p>
    @endif
</div>