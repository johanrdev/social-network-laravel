{{-- @extends('layouts.app')

@section('container')
    <div class="pb-12 sm:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-list-container :title="'Messages'" :source="$messages">
                @forelse ($messages as $message)
                    <div class="px-3 py-2 odd:bg-gray-100 last:border-b-0 border-b border-gray-200">
                        <div class="flex">
                            <div class="bg-gray-800 rounded-full w-10 h-10 mr-0 mr-3 shrink-0 flex flex-col items-center justify-center self-center sm:self-start">
                                <span class="uppercase text-gray-600 font-bold text-xl">U</span>
                            </div>
                            <div class="flex sm:text-left grow justify-between items-center">
                                <div class="flex items-center">
                                    <h2 class="text-lg font-bold">
                                        <a href="{{ route('messages.show', $message) }}">{{ $message }}</a>
                                    </h2>
                                </div>
                                <form method="POST" action="{{ route('messages.destroy', $message) }}">
                                    @method('DELETE')
                                    @csrf
                                    
                                    <x-button :type="'transparent'">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3l1.664 1.664M21 21l-1.5-1.5m-5.485-1.242L12 17.25 4.5 21V8.742m.164-4.078a2.15 2.15 0 011.743-1.342 48.507 48.507 0 0111.186 0c1.1.128 1.907 1.077 1.907 2.185V19.5M4.664 4.664L19.5 19.5" />
                                        </svg>                                                                                             
                                    </x-button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="p-3 text-center">No messages were found</p>
                @endforelse
            </x-list-container>
        </div>
    </div>
@endsection --}}
