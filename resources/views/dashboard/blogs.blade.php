<div class="flex flex-col py-3">
    <h2 class="text-2xl font-bold">{{ $blogs->total() }} {{ $blogs->total() == 1 ? 'Blog' : 'Blogs' }}</h2>
    <ul class="my-3">
        <li><a href="{{ route('blogs.create') }}">New blog</a></li>
    </ul>
</div>

@if (count($blogs) > 0)
    @if ($blogs->hasPages())
        <div class="pb-6">
            {{ $blogs->appends(request()->input())->links() }}
        </div>
    @endif
    <div class="overflow-x-auto rounded-lg bg-gray-200 mb-3">
        <table class="w-full text-left table-fixed">
            <thead class="bg-gray-300">
                <tr>
                    <th class="py-3 px-6 w-20">
                        <div class="flex items-center">
                            <input type="checkbox">
                        </div>
                    </th>
                    <th class="py-2 px-2 sm:py-3 sm:px-6">Name</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($blogs as $blog)
                    <tr class="border-b border-gray-300 last:border-b-0 hover:bg-teal-100">
                        <td class="py-3 px-6 w-10">
                            <div class="flex items-center">
                                <input type="checkbox">
                            </div>
                        </td>
                        <td class="py-2 px-2 sm:py-3 sm:px-6 break-words"><a href="{{ route('blogs.edit', $blog) }}">{{ $blog->name }}</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="flex justify-end">
        <x-button type="red">Remove</x-button>
    </div>

    @if ($blogs->hasPages())
        <div class="pt-6">
            {{ $blogs->appends(request()->input())->links() }}
        </div>
    @endif
@else
    <p>No blogs was found</p>
@endif