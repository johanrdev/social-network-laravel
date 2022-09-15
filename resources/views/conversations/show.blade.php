@extends('layouts.app')

@section('container')
    <div class="pb-12 sm:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
            
            <x-list-container :title="'Messages'" :source="$messages" :paginate="true" :scrollY="false" class="lg:col-span-2">
                <div class="p-3">
                    <form method="POST" action="{{ route('publishMessage', $conversation) }}">
                        @csrf
    
                        <x-textbox class="w-full rounded mb-3" name="content" rows="5" required></x-textbox>
                        <div class="flex justify-end">
                            <x-button type="green" class="px-3">Publish</x-button>
                        </div>
                    </form>
                </div>
                    @forelse ($messages as $message)
                        <div class="px-3 py-2 odd:bg-gray-100 last:border-b-0 border-b border-gray-200">
                            <div class="flex">
                                <div class="bg-gray-800 rounded-full w-10 h-10 mr-0 mr-3 shrink-0 flex flex-col items-center justify-center self-center sm:self-start ring-4 ring-slate-400">
                                    <span class="uppercase text-gray-600 font-bold text-xl">U</span>
                                </div>
                                <div class="flex sm:text-left grow justify-between items-center">
                                    <div class="flex flex-col relative grow">
                                        <h2 class="text-lg font-bold">
                                            <a href="{{ route('users.show', $message->user->id) }}">{{ $message->user->name }}</a>
                                        </h2>
                                        <p class="text-xs font-bold mb-3">{{ $message->created_at->diffForHumans() }}</p>
                                        <p>{{ $message->content }}</p>
                                        @if ($conversation->users->find($message->user->id)->pivot->last_visited < $message->created_at && $message->user->id != Auth::user()->id)
                                            <span class="bg-rose-500 text-white absolute right-0 top-0 px-1 text-xs font-bold rounded-sm uppercase">New</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="p-3 text-center">No messages were found</p>
                    @endforelse
            </x-list-container>

            <div class="grid order-1 md:gap-6">
                <!-- Incoming Requests -->
                <x-list-container :title="'Members'" :source="$conversation->users" :paginate="false">
                    @forelse ($conversation->users as $user)
                        <x-friends.list-item :friend="$user"></x-friends.list-item>
                    @empty
                        <p class="p-3 text-center">No users in this conversation</p>
                    @endforelse
                </x-list-container>
            </div>
        </div>
    </div>
@endsection
