@extends('layouts.app')

@section('container')
    <div class="pb-12 sm:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
            <x-list-container :title="'Messages'" :source="$messages" :paginate="false" class="lg:col-span-2 order-0 lg:order-1">
                <div class="p-6">
                    <form method="POST" action="{{ route('publishMessage', $conversation) }}">
                        @csrf
                        
                        <x-textbox class="w-full rounded mb-3" name="content" rows="5" required></x-textbox>
                        <div class="flex justify-end">
                            <x-button type="green" class="px-3">Publish</x-button>
                        </div>
                    </form>
                </div>

                <div class="max-h-128 overflow-y-auto">
                @forelse ($messages as $message)
                    <div class="px-3 py-2 odd:bg-gray-100 last:border-b-0 border-b border-gray-200">
                        <div class="flex">
                            <div class="bg-gray-800 rounded-full w-10 h-10 mr-0 mr-3 shrink-0 flex flex-col items-center justify-center self-center sm:self-start ring-4 ring-slate-400">
                                <span class="uppercase text-gray-600 font-bold text-xl">U</span>
                            </div>
                            <div class="flex sm:text-left grow justify-between items-center">
                                <div class="flex flex-col">
                                    <h2 class="text-lg font-bold">
                                        <a href="{{ route('users.show', $message->user->id) }}">{{ $message->user->name }}</a>
                                    </h2>
                                    <p class="text-xs font-bold mb-3">{{ $message->created_at->diffForHumans() }}</p>
                                    <p>{{ $message->content }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="p-3 text-center">No messages were found</p>
                @endforelse
                </div>
            </x-list-container>

            <div class="grid order-1 md:gap-6">
                <!-- Incoming Requests -->
                <x-list-container :title="'Members'" :source="$conversation->users" :paginate="false" class="max-h-80 overflow-y-auto">
                    @forelse ($conversation->users as $user)
                        <x-friends.list-item :friend="$user" />
                    @empty
                        <p class="p-3 text-center">No users in this conversation</p>
                    @endforelse
                </x-list-container>
            </div>
        </div>
    </div>
@endsection
