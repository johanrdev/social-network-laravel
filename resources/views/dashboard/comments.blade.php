@if (count($comments) > 0)
    <div class="overflow-x-auto rounded-lg bg-gray-200">
        <table class="w-full text-left">
            <thead class="bg-gray-300">
                <tr>
                    <th class="py-3 px-6 w-20">
                        <div class="flex items-center">
                            <input type="checkbox">
                        </div>
                    </th>
                    <th class="py-3 px-6">Comment</th>
                    <th class="py-3 px-6 w-60">Post</th>
                    <th class="py-3 px-6 w-40">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($comments as $comment)
                    <tr class="border-b border-gray-300 last:border-b-0">
                        <td class="py-3 px-6">
                            <div class="flex items-center">
                                <input type="checkbox">
                            </div>
                        </td>
                        <td class="py-3 px-6">{{ $comment->content }}</td>
                        <td class="py-3 px-6">{{ $comment->commentable->title }}</td>
                        <td class="py-3 px-6">
                            <a href="#">Edit</a>
                            <a href="#">Remove</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if ($comments->hasPages())
        <div class="pt-6">
            {{ $comments->appends(request()->input())->links() }}
        </div>
    @endif
@else
    <p>No comment was found</p>
@endif