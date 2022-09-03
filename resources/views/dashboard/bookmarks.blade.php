@if (count($bookmarks) > 0)
    <div class="overflow-x-auto rounded-lg bg-gray-200 mb-3">
        <table class="w-full text-left">
            <thead class="bg-gray-300">
                <tr>
                    <th class="py-3 px-6 w-20">
                        <div class="flex items-center">
                            <input type="checkbox">
                        </div>
                    </th>
                    <th class="py-3 px-6">Bookmark</th>
                    <th class="py-3 px-6 w-40">Type</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookmarks as $bookmark)
                    <tr class="border-b border-gray-300 last:border-b-0">
                        <td class="py-3 px-6">
                            <div class="flex items-center">
                                <input type="checkbox">
                            </div>
                        </td>
                        <td class="py-3 px-6">{{ $bookmark->bookmarkable_type == 'App\Models\Blog' ? $bookmark->bookmarkable->name : $bookmark->bookmarkable->title }}</td>
                        <td class="py-3 px-6">{{ $bookmark->bookmarkable_type == 'App\Models\Blog' ? 'Blog' : 'Post' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="flex justify-end">
        <input type="button" class="py-2 px-4 rounded bg-red-500 text-white cursor-pointer" value="Remove" />
    </div>

    @if ($bookmarks->hasPages())
        <div class="pt-6">
            {{ $bookmarks->appends(request()->input())->links() }}
        </div>
    @endif
@else
    <p>No bookmark was found</p>
@endif