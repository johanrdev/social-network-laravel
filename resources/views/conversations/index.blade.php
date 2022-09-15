@extends('layouts.app')

@section('container')
    <div class="pb-12 sm:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-list-container :title="'Conversations'" :source="$conversations" :scrollY="false">
                @forelse ($conversations as $conversation)
                    <div class="px-3 py-2 odd:bg-gray-100 last:border-b-0 border-b border-gray-200">
                        <div class="flex">
                            <div class="bg-gray-800 rounded-full w-10 h-10 mr-0 mr-3 shrink-0 flex flex-col items-center justify-center self-center sm:self-start ring-4 ring-slate-400">
                                <span class="uppercase text-gray-600 font-bold text-xl">U</span>
                            </div>
                            <div class="flex sm:text-left justify-between items-center">
                                <div class="flex flex-col">
                                    <h2 class="text-lg font-bold">
                                        <a href="{{ route('conversations.show', $conversation->id) }}">
                                            {{ $conversation->users->slice(0, 3)->implode('name', ', ') }} 
                                            {{ count($conversation->users) > 3 ? '... (+' . count($conversation->users) - 3 . ' others)' : '' }}
                                        </a>
                                    </h2>
                                    <p class="text-xs font-bold">{{ $conversation->updated_at->diffForHumans() }}</p>
                                    {{-- <p>{{ $conversation->users->find(Auth::user()->id)->pivot->last_visited }}</p> --}}
                                </div>
                                
                            </div>
                            <div class="relative">
                                {{-- @php
                                    $new_messages_count = $conversation->messages->where('user_id', '!=', Auth::user()->id)
                                            ->where('created_at', '>=', $conversation->users->find(Auth::user()->id)->pivot->last_visited)->count();
                                @endphp
                            
                                @if ($new_messages_count > 0)
                                    <span class="bg-rose-500 rounded-sm font-semibold px-1 uppercase text-xs text-white pointer-events-none select-none ml-2">
                                        {{ $new_messages_count }} new
                                    </span>
                                @endif --}}

                                @if ($conversation->getNewMessagesCount() > 0)
                                    <span class="bg-rose-500 rounded-sm font-semibold px-1 uppercase text-xs text-white pointer-events-none select-none ml-2">
                                        {{ $conversation->getNewMessagesCount() }} new
                                    </span>
                                @endif
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
