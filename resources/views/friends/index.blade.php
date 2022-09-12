@extends('layouts.app')

@section('container')
    <div class="pb-12 sm:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-3 lg:gap-6 items-start">
            <!-- Friend List -->
            <x-list-container :title="$title" :source="$friends">
                @forelse ($friends as $friend)
                    <x-friends.list-item :friend="$friend" />
                @empty
                    <p class="p-3 text-center">No friends were found</p>
                @endforelse
            </x-list-container>

            <div>
                <!-- Incoming Requests -->
                <x-list-container :title="'Incoming Requests'" :source="Auth::user()->incomingRequests" :paginate="false" class="max-h-80 overflow-y-auto">
                    @forelse (Auth::user()->incomingRequests as $friendRequest)
                        <x-friends.request :request="$friendRequest" :from="$friendRequest->user" :to="$friendRequest->friend" :canAccept="true" />
                    @empty
                        <p class="p-3 text-center">No pending friend requests</p>
                    @endforelse
                </x-list-container>

                <!-- Outgoing Requests -->
                <x-list-container :title="'Outgoing Requests'" :source="Auth::user()->outgoingRequests" :paginate="false" class="max-h-80 overflow-y-auto">
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
