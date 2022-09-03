@if (count($posts) > 0)
    <div class="overflow-x-auto rounded-lg bg-gray-200">
        <table class="w-full text-left table-fixed">
            <thead class="bg-gray-300">
                <tr>
                    <th class="py-3 px-6 w-20">
                        <div class="flex items-center">
                            <input type="checkbox">
                        </div>
                    </th>
                    <th class="py-3 px-6">Title</th>
                    <th class="py-3 px-6 w-40">Category</th>
                    <th class="py-3 px-6 w-40">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr class="border-b border-gray-300 last:border-b-0 hover:bg-green-100">
                        <td class="py-3 px-6">
                            <div class="flex items-center">
                                <input type="checkbox">
                            </div>
                        </td>
                        <td class="py-3 px-6">{{ $post->title }}</td>
                        <td class="py-3 px-6">{{ $post->category->name }}</td>
                        <td class="py-3 px-6">
                            <a href="#">Edit</a>
                            <a href="#">Remove</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if ($posts->hasPages())
        <div class="pt-6">
            {{ $posts->appends(request()->input())->links() }}
        </div>
    @endif
@else
    <p>No posts was found</p>
@endif