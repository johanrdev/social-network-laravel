@if (count($bookmarks) > 0)
    <div class="overflow-x-auto rounded-lg bg-gray-200">
        <table class="w-full text-left">
            <thead class="bg-gray-300">
                <tr>
                    <th class="py-3 px-6">Bookmark</th>
                    <th class="py-3 px-6">Type</th>
                    <th class="py-3 px-6">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookmarks as $bookmark)
                    <tr class="border-b border-gray-300 last:border-b-0">
                        <td class="py-3 px-6">{{ $bookmark->bookmarkable_type == 'App\Models\Blog' ? $bookmark->bookmarkable->name : $bookmark->bookmarkable->title }}</td>
                        <td class="py-3 px-6">{{ $bookmark->bookmarkable_type == 'App\Models\Blog' ? 'Blog' : 'Post' }}</td>
                        <td class="py-3 px-6">
                            <a href="#">Edit</a>
                            <a href="#">Remove</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="pt-6">
        {{ $bookmarks->appends(request()->input())->links() }}
    </div>
@else
    <p>No bookmark was found</p>
@endif