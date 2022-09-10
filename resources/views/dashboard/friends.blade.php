<div class="flex flex-col py-3">
    <h2 class="text-2xl font-bold">{{ count(Auth::user()->friends) }} {{ count(Auth::user()->friends) == 1 ? 'Friend' : 'Friends' }}</h2>
    {{-- <ul class="my-3">
        <li><a href="{{ route('blogs.create') }}" class="transition-all duration-150 cursor-pointer font-black text-sm uppercase tracking-widest text-teal-500 hover:text-teal-700 underline">New blog</a></li>
    </ul> --}}
</div>

@if (count($blogs) > 0)
    {{-- @if ($blogs->hasPages())
        <div class="pb-6">
            {{ $blogs->appends(request()->input())->links() }}
        </div>
    @endif --}}
    @foreach (Auth::user()->friends as $friend)
        <x-user-card :user="$friend" :showInfo="false" :showDescription="false" :showFullDescription="false"></x-user-card>
    @endforeach

    {{-- @if ($blogs->hasPages())
        <div class="pt-6">
            {{ $blogs->appends(request()->input())->links() }}
        </div>
    @endif --}}
@else
    <p>No friends was found</p>
@endif