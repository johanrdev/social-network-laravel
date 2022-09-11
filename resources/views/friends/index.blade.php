@extends('layouts.app')

@section('container')
    <div class="pb-12 sm:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-3 lg:gap-6">
            <div class="order-1 lg:order-0">
                <!-- Incoming Requests -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg grow flex flex-col mb-0 sm:mb-6">
                    <div class="bg-white border-b border-gray-200 grow">
                        <div class="flex flex-col p-6">
                            <div class="flex flex-col pt-3">
                                <div class="flex flex-col pb-3">
                                    <h2 class="text-2xl font-bold">{{ count(Auth::user()->incomingRequests) }} {{ count(Auth::user()->incomingRequests) == 1 ? 'Incoming Request' : 'Incoming Requests' }}</h2>
                                </div>
                                
                                @forelse (Auth::user()->incomingRequests as $friendRequest)
                                    <x-friends.request :request="$friendRequest" :from="$friendRequest->user" :to="$friendRequest->friend" />
                                @empty
                                    <p>No incoming friend requests</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
    
                <!-- Outgoing Requests -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg grow flex flex-col mb-3 lg:mb-0">
                    <div class="bg-white border-b border-gray-200 grow">
    
                        <div class="flex flex-col p-6 ">
                            <div class="flex flex-col pb-3">
                                <div class="flex flex-col pb-3">
                                    <h2 class="text-2xl font-bold">{{ count(Auth::user()->outgoingRequests) }} {{ count(Auth::user()->outgoingRequests) == 1 ? 'Outgoing Request' : 'Outgoing Requests' }}</h2>
                                </div>
                                
                                @forelse (Auth::user()->outgoingRequests as $friendRequest)
                                    <x-friends.request :request="$friendRequest" :from="$friendRequest->user" :to="$friendRequest->friend" :canAccept="false" />
                                @empty
                                    <p>No outgoing friend requests</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg grow flex flex-col mb-6 lg:mb-0 col-span-2 order-0 lg:order-1">
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
                        
                        @forelse ($friends as $friend)
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
                                            <x-button :type="'transparent'">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M22 10.5h-6m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                                                  </svg>                                                  
                                            </x-button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>No friends were found</p>
                        @endforelse

                        @if ($friends->hasPages())
                            <div class="py-6 px-6 sm:px-0">
                                {{ $friends->appends(request()->input())->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
