@extends('layouts.app')

@section('container')
    <div class="pb-12 sm:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-list-container :title="'Conversations'" :source="$conversations" :paginate="false">
                @forelse ($conversations as $conversation)
                    <div class="px-3 py-2 odd:bg-gray-100 last:border-b-0 border-b border-gray-200">
                        <div class="flex">
                            <div class="bg-gray-800 rounded-full w-10 h-10 mr-0 mr-3 shrink-0 flex flex-col items-center justify-center self-center sm:self-start ring-4 ring-slate-400">
                                <span class="uppercase text-gray-600 font-bold text-xl">U</span>
                            </div>
                            <div class="flex sm:text-left grow justify-between items-center">
                                <div class="flex items-center">
                                    <h2 class="text-lg font-bold">
                                        <a href="{{ route('conversations.show', $conversation->id) }}">{{ $conversation->users->implode('name', ', ') }}</a>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="p-3 text-center">No conversations were found</p>
                @endforelse
            </x-list-container>
        </div>
    </div>
@endsection
