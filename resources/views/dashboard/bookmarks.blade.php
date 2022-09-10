<div class="flex flex-col py-3">
    <h2 class="text-2xl font-bold">{{ $bookmarks->total() }} {{ $bookmarks->total() == 1 ? 'Bookmark' : 'Bookmarks' }}</h2>
</div>

@if (count($bookmarks) > 0)
    @if ($bookmarks->hasPages())
        <div class="pb-6">
            {{ $bookmarks->appends(request()->input())->links() }}
        </div>
    @endif

    <div class="overflow-x-auto rounded-sm mb-3">
        <table class="w-full text-left">
            <thead>
                <tr class="border-b-2 bg-slate-300 border-slate-400">
                    <th class="py-3 px-6 w-20">
                        <div class="flex items-center">
                            <input type="checkbox" id="check-all" data-type="bookmarks">
                        </div>
                    </th>
                    <th class="py-2 px-2 sm:py-3 sm:px-6">Bookmark</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookmarks as $bookmark)
                    <tr class="border-b border-gray-300 last:border-b-0 hover:bg-teal-100 bg-slate-100 odd:bg-slate-200">
                        <td class="py-3 px-6">
                            <div class="flex items-center">
                                <input type="checkbox" class="remove-checkbox" data-post-id="{{ $bookmark->id }}">
                            </div>
                        </td>
                        <td class="py-2 px-2 sm:py-3 sm:px-6 break-words flex items-center">
                            <span class="relative mr-2">
                                @if ($bookmark->bookmarkable_type == 'App\Models\Blog')
                                    <a href="{{ route('blogs.show', $bookmark->bookmarkable_id) }}">{{ $bookmark->bookmarkable->name }}</a>
                                @elseif ($bookmark->bookmarkable_type == 'App\Models\Post')
                                    <a href="{{ route('posts.show', $bookmark->bookmarkable_id) }}">{{ $bookmark->bookmarkable->title }}</a>
                                @endif
                            </span>

                            @if ($bookmark->has_changes)
                                <span class="bg-rose-500 rounded-sm font-semibold px-1 uppercase text-xs text-white pointer-events-none select-none">
                                    Updated
                                </span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="flex justify-end">
        <form method="POST" action="{{ route('deleteCheckedBookmarks') }}">
            @method('DELETE')
            @csrf

            <input type="hidden" id="ids" name="ids" />
            <x-button type="red" id="remove" class="px-3">Remove checked</x-button>
        </form>
    </div>

    @if ($bookmarks->hasPages())
        <div class="pt-6">
            {{ $bookmarks->appends(request()->input())->links() }}
        </div>
    @endif
@else
    <p>No bookmark was found</p>
@endif