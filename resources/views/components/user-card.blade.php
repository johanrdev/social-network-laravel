<a href="{{ route('users.show', $user) }}" class="flex flex-col">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg grow flex flex-col">
        <div class="bg-white border-b border-gray-200 grow flex flex-col">

            <div class="p-6 grow flex flex-col">
                <div class="flex flex-col sm:flex-row">
                    <div class="bg-gray-800 rounded-full w-20 h-20 mr-0 sm:mr-6 shrink-0 flex flex-col items-center justify-center self-center sm:self-start mb-3 sm:mb-0">
                        <span class="uppercase text-gray-600 font-bold text-3xl">U</span>
                    </div>
                    <div class="flex flex-col text-center sm:text-left grow self-center">
                        <h2 class="text-xl font-bold">{{ $user->name }}</h2>
                        @if ($showDescription)
                            @if ($showFullDescription)
                                    <p>{{ $user->description }}</p>
                                @else
                                    <p>{{ substr($user->description, 0, 60) }}</p>
                                @endif
                        @endif
                    </div>
                </div>
                @if ($showInfo)
                    <hr class="my-6">
                    <div class="font-bold text-sm flex justify-between flex-wrap">
                        <span>Joined {{ $user->created_at->diffForHumans() }}</span>
                        
                        @if (Auth::user()->id !== $user->id)
                            <div class="uppercase underline text-rose-500 font-bold flex flex-col sm:flex-row">
                                <a href="{{ route('messages.create') }}?recipient_id={{ $user->id }}" class="py-3 px-5 rounded mb-0 transition-all duration-150 cursor-pointer font-black text-sm uppercase tracking-widest py-0 px-0 bg-transparent hover:bg-transparent text-rose-500 hover:text-rose-700 underline border-transparent border-b-0 hover:border-transparent">Send message</a>
                                {{-- <a href="#" class="mr-0 sm:mr-4 py-1">Send friend request</a> --}}
                                <form method="POST" action="{{ route('friends.store') }}">
                                    @method('POST')
                                    @csrf

                                    <input type="hidden" name="friend_id" value="{{ $user->id }}" />
                                    <x-button :type="'transparent'">Friend request</x-button>
                                </form>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</a>