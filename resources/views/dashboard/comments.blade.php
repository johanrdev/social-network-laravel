<h2 class="text-2xl font-bold p-6">{{ $comments->total() }} Comments</h2>

@if (count($comments) > 0)
    <div class="overflow-x-auto rounded-lg bg-gray-200 mb-3">
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
                </tr>
            </thead>
            <tbody>
                @foreach ($comments as $comment)
                    <tr class="border-b border-gray-300 last:border-b-0 hover:bg-green-100">
                        <td class="py-3 px-6">
                            <div class="flex items-center">
                                <input type="checkbox">
                            </div>
                        </td>
                        <td class="py-3 px-6">
                            <a href="{{ route('comments.edit', $comment) }}">{{ $comment->content }}</a>
                        </td>
                        <td class="py-3 px-6">{{ !is_null($comment->commentable) ? $comment->commentable->title : 'NULL' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="flex justify-end">
        <input type="button" class="py-2 px-4 rounded bg-red-500 text-white cursor-pointer" value="Remove" />
    </div>

    @if ($comments->hasPages())
        <div class="pt-6">
            {{ $comments->appends(request()->input())->links() }}
        </div>
    @endif
@else
    <p>No comment was found</p>
@endif