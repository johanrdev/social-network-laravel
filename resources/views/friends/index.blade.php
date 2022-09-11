@extends('layouts.app')

@section('container')
    <div class="pb-12 sm:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-3 lg:gap-6">
            <div class="order-1 lg:order-0">
                <!-- Incoming Requests -->
                <div class="bg-white overflow-hidden shadow-sm rounded-0 xs:rounded-lg sm:rounded-t-lg grow flex flex-col mb-0">
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
                <div class="bg-white overflow-hidden shadow-sm rounded-0 xs:rounded-lg sm:rounded-b-lg grow flex flex-col mb-3 lg:mb-0">
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

            <!-- Friend List -->
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
                            <x-friends.list-item :friend="$friend" />
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
