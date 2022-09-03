@if (count($posts) > 0)
    <table class="w-full text-left">
        <thead class="bg-gray-200">
            <tr>
                <th class="py-3 px-6">Title</th>
                {{-- <th class="py-3 px-6">Posts</th> --}}
                <th class="py-3 px-6">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr class="border-b">
                    <td class="py-3 px-6">{{ $post->title }}</td>
                    {{-- <td class="py-3 px-6">{{ count($post->posts) }}</td> --}}
                    <td class="py-3 px-6">
                        <a href="#">Edit</a>
                        <a href="#">Remove</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pt-6">
        {{ $posts->appends(request()->input())->links() }}
    </div>
@else
    <p>No posts was found</p>
@endif