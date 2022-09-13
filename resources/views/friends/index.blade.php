@extends('layouts.app')

@section('container')
    <div class="pb-12 sm:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
            <!-- Friend List -->
            <x-list-container :title="$title" :source="$friends" class="lg:col-span-2 order-0 lg:order-1" :scrollY="false">
                @forelse ($friends as $friend)
                    <x-friends.list-item :friend="$friend">
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
                    </x-friends.list-item>
                @empty
                    <p class="p-3 text-center">No friends were found</p>
                @endforelse
            </x-list-container>

            <div class="grid order-1 md:gap-6">
                <!-- Incoming Requests -->
                <x-list-container :title="'Incoming Requests'" :source="Auth::user()->incomingRequests" :paginate="false">
                    @forelse (Auth::user()->incomingRequests as $friendRequest)
                        <x-friends.request :request="$friendRequest" :from="$friendRequest->user" :to="$friendRequest->friend" :canAccept="true" />
                    @empty
                        <p class="p-3 text-center">No pending friend requests</p>
                    @endforelse
                </x-list-container>

                <!-- Outgoing Requests -->
                <x-list-container :title="'Outgoing Requests'" :source="Auth::user()->outgoingRequests" :paginate="false">
                    @forelse (Auth::user()->outgoingRequests as $friendRequest)
                        <x-friends.request :request="$friendRequest" :from="$friendRequest->user" :to="$friendRequest->friend" :canAccept="false" />
                    @empty
                        <p class="p-3 text-center">No pending friend requests</p>
                    @endforelse
                </x-list-container>
            </div>
        </div>
    </div>
@endsection
