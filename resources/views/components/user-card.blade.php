
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg grow flex flex-col">
    <div class="bg-white border-b border-gray-200 grow flex flex-col">

        <div class="p-6 grow flex flex-col">
            <div class="flex flex-col sm:flex-row">
                <div class="bg-gray-800 rounded-full w-20 h-20 mr-0 sm:mr-6 shrink-0 flex flex-col items-center justify-center self-center sm:self-start mb-3 sm:mb-0">
                    <span class="uppercase text-gray-600 font-bold text-3xl">U</span>
                </div>
                <div class="flex flex-col text-center sm:text-left grow self-center">
                    <h2 class="text-xl font-bold"><a href="{{ route('users.show', $user) }}">{{ $user->name }}</a></h2>
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
                <div class="font-bold text-sm flex flex-col items-center sm:flex-row sm:justify-between">
                    <span>Joined {{ $user->created_at->diffForHumans() }}</span>
                    
                    @if (Auth::user()->id !== $user->id)
                        <div class="flex flex-col sm:flex-row">
                            <a href="{{ route('createConversation', $user) }}" class="py-3 mr-2 rounded mb-0 transition-all duration-150 cursor-pointer font-black text-sm uppercase tracking-widest py-0 px-0 bg-transparent hover:bg-transparent text-rose-500 hover:text-rose-700 underline border-transparent border-b-0 hover:border-transparent">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                </svg>                                  
                            </a>
                            @if (Auth::user()->friends->contains($user->id))
                                <form method="POST" action="{{ route('friends.destroy', $user) }}">
                                    @method('DELETE')
                                    @csrf
                                    
                                    <input type="hidden" name="friend_id" value="{{ $user->id }}" />
                                    <x-button :type="'transparent'">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M22 10.5h-6m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                                          </svg>                                          
                                    </x-button>
                                </form>
                            @else
                                @if (!$showFriendRequestLink)
                                    <form method="POST" action="{{ route('createFriendRequest') }}">
                                        @csrf

                                        <input type="hidden" name="friend_id" value="{{ $user->id }}" />
                                        <x-button :type="'transparent'">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                                            </svg>                                              
                                        </x-button>
                                    </form>
                                @else
                                    <p class="uppercase">Pending request</p>
                                @endif
                            @endif
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>