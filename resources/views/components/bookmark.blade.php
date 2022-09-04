<div>
    @if (!is_null($bookmark))
        <form method="POST" action="{{ route('bookmarks.destroy', $bookmark) }}">
            @method('DELETE')
            @csrf

            <button type="submit" class="bg-gray-400 py-2 px-3 rounded-full flex text-white">
                <svg class="w-6 h-6" fill="none" stroke="white" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                </svg>
                Remove bookmark
            </button>
        </form>
    @else
        <form method="POST" action="{{ route('bookmarks.store') }}">
            @csrf
            <input type="hidden" name="post_id" value="{{ $id }}">
            <input type="hidden" name="post_type" value="{{ $type }}">
            <button type="submit" class="bg-gray-400 py-2 px-3 rounded-full flex text-white">
                <svg class="w-6 h-6" fill="none" stroke="white" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                </svg>
                Add bookmark
            </button>
        </form>
    @endif
</div>