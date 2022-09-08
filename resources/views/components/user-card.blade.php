<a href="{{ route('users.show', $user) }}" class="flex flex-col">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg grow flex flex-col">
        <div class="bg-white border-b border-gray-200 grow flex flex-col">

            <div class="p-6 grow flex flex-col">
                <div class="flex">
                    <div class="bg-gray-800 rounded-full w-20 h-20 mr-6 shrink-0 self-center flex flex-col items-center justify-center">
                        <span class="uppercase text-gray-600 font-bold text-3xl">U</span>
                    </div>
                    <div class="flex flex-col">
                        <h2 class="text-xl font-bold">{{ $user->name }}</h2>
                        <p>{{ substr($user->description, 0, 60) }}</p>
                    </div>
                </div>
                @if ($showInfo)
                    <hr class="my-6">
                    <ul class="font-bold text-sm">
                        <li>Joined {{ $user->created_at->diffForHumans() }}</li>
                    </ul>
                @endif
            </div>
        </div>
    </div>
</a>