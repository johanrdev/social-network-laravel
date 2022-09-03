@if (count($blogs) > 0)
    <div class="overflow-x-auto rounded-lg bg-gray-200">
        <table class="w-full text-left">
            <thead class="bg-gray-300">
                <tr>
                    <th class="py-3 px-6">Name</th>
                    <th class="py-3 px-6">Posts</th>
                    <th class="py-3 px-6">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($blogs as $blog)
                    <tr class="border-b border-gray-300 last:border-b-0">
                        <td class="py-3 px-6">{{ $blog->name }}</td>
                        <td class="py-3 px-6">{{ count($blog->posts) }}</td>
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
        {{ $blogs->appends(request()->input())->links() }}
    </div>
@else
    <p>No blogs was found</p>
@endif