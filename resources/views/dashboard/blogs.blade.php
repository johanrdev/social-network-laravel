@if (count($blogs) > 0)
    <table class="w-full text-left">
        <thead class="bg-gray-200">
            <tr>
                <th class="py-3 px-6">Name</th>
                <th class="py-3 px-6">Posts</th>
                <th class="py-3 px-6">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($blogs as $blog)
                <tr class="border-b">
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

    <div class="pt-6">
        {{ $blogs->links() }}
    </div>
@else
    <p>No blogs was found</p>
@endif