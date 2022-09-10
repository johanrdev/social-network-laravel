@extends('layouts.app')

@section('container')
    <div class="pb-12 sm:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-3 lg:gap-6">
            <div class="order-1 lg:order-0">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg grow flex flex-col mb-6">
                    <div class="bg-white border-b border-gray-200 grow">
                        <div class="flex flex-col p-6">
                            <div class="flex flex-col pt-3">
                                <div class="flex flex-col pb-3">
                                    <h2 class="text-2xl font-bold">{{ count(Auth::user()->incomingRequests) }} {{ count(Auth::user()->incomingRequests) == 1 ? 'Friend Request' : 'Friend Requests' }}</h2>
                                </div>
                                
                                @if (count(Auth::user()->incomingRequests) > 0)
                                    @foreach (Auth::user()->incomingRequests as $friendRequest)
                                        <div class="flex flex-col py-3 last:border-0 border-b border-gray-200">
                                            <div class="flex">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-1">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244" />
                                                </svg>
                                                  
                                                  
                                                <div class="flex flex-col grow">
                                                    <span>
                                                        <a href="{{ route('users.show', $friendRequest->user->id) }}" class="text-rose-500 font-bold underline">{{ $friendRequest->user->name }}</a> wants to be your friend!
                                                    </span>
    
                                                    <div class="flex items-center justify-between">
                                                        <span class="text-sm font-bold">{{ $friendRequest->created_at->diffForHumans() }}</span>
                                                        <div class="flex justify-end border-b sm:border-0 border-gray-200">
                                                            <form method="POST" action="{{ route('acceptFriendRequest', $friendRequest) }}">
                                                                @csrf
                                                                
                                                                <x-button :type="'green'" class="mr-1 px-1 py-0.5">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                                                                </x-button>
                                                            </form>
                                                            <form method="POST" action="{{ route('declineFriendRequest', $friendRequest) }}">
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
                                    @endforeach
                                @else
                                    <p>No incoming friend requests</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg grow flex flex-col mb-3">
                    <div class="bg-white border-b border-gray-200 grow">
    
                        <div class="flex flex-col p-6 ">
                            <div class="flex flex-col pb-3">
                                <div class="flex flex-col pb-3">
                                    <h2 class="text-2xl font-bold">{{ count(Auth::user()->outgoingRequests) }} {{ count(Auth::user()->outgoingRequests) == 1 ? 'Sent Request' : 'Sent Requests' }}</h2>
                                </div>
                                
                                @if (count(Auth::user()->outgoingRequests) > 0)
                                    @foreach (Auth::user()->outgoingRequests as $friendRequest)
                                        <div class="flex flex-col py-3 last:border-0 border-b border-gray-200">
                                            <div class="flex">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-1">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244" />
                                                </svg>
                                                  
                                                  
                                                <div class="flex flex-col grow">
                                                    <span>
                                                        You requested a friendship with <a href="{{ route('users.show', $friendRequest->friend->id) }}" class="text-rose-500 font-bold underline">{{ $friendRequest->friend->name }}</a>
                                                    </span>
    
                                                    <div class="flex items-center justify-between">
                                                        <span class="text-sm font-bold">{{ $friendRequest->created_at->diffForHumans() }}</span>
                                                        <div class="flex justify-end border-b sm:border-0 border-gray-200">
                                                            <x-button :type="'red'" class="mr-0 px-1 py-0.5">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>
                                                            </x-button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <p>No outgoing friend requests</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg grow flex flex-col mb-6 col-span-2 order-0 lg:order-1">
                <div class="bg-white border-b border-gray-200 grow">
                    <div class="flex flex-col p-6">
                        <div class="flex flex-col py-3">
                            <h2 class="text-2xl font-bold">{{ count(Auth::user()->friends) }} {{ count(Auth::user()->friends) == 1 ? 'Friend' : 'Friends' }}</h2>
                        </div>

                        @if ($friends->hasPages())
                            <div class="py-6 px-6 sm:px-0">
                                {{ $friends->appends(request()->input())->links() }}
                            </div>
                        @endif
                        
                        @if ($friends->total() > 0)
                            @foreach ($friends as $friend)
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

                        @if ($friends->hasPages())
                            <div class="py-6 px-6 sm:px-0">
                                {{ $friends->appends(request()->input())->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- @if ($messages->hasPages())
                <div class="pt-3 px-6 sm:px-0">
                    {{ $messages->appends(request()->input())->links() }}
                </div>
            @endif --}}
        </div>
    </div>
@endsection
