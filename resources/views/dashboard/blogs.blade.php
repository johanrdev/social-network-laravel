<h2 class="text-2xl font-bold p-6">{{ $blogs->total() }} Blogs</h2>

@if (count($blogs) > 0)
    <div class="overflow-x-auto rounded-lg bg-gray-200 mb-3">
        <table class="w-full text-left table-fixed">
            <thead class="bg-gray-300">
                <tr>
                    <th class="py-3 px-6 w-20">
                        <div class="flex items-center">
                            <input type="checkbox">
                        </div>
                    </th>
                    <th class="py-3 px-6">Name</th>
                    <th class="py-3 px-6 w-40">Posts</th>
                    {{-- <th class="py-3 px-6 w-40">Action</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($blogs as $blog)
                    <tr class="border-b border-gray-300 last:border-b-0 hover:bg-green-100">
                        <td class="py-3 px-6 w-10">
                            <div class="flex items-center">
                                <input type="checkbox">
                            </div>
                        </td>
                        <td class="py-3 px-6"><a href="{{ route('blogs.edit', $blog) }}">{{ $blog->name }}</a></td>
                        <td class="py-3 px-6">{{ count($blog->posts) }}</td>
                        {{-- <td class="py-3 px-6">
                            <a href="{{ route('blogs.edit', $blog) }}">Edit</a>
                            <a href="#">Remove</a>
                        </td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="flex justify-end">
        <input type="button" class="py-2 px-4 rounded bg-red-500 text-white cursor-pointer" value="Remove" />
    </div>

    @if ($blogs->hasPages())
        <div class="pt-6">
            {{ $blogs->appends(request()->input())->links() }}
        </div>
    @endif
@else
    <p>No blogs was found</p>
@endif