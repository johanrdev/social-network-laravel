@extends('dashboard')

@section('content')

<div class="flex flex-col py-3">
    <h2 class="text-2xl font-bold">{{ $comments->total() }} {{ $comments->total() == 1 ? 'Comment' : 'Comments' }}</h2>
</div>

@if (count($comments) > 0)
    @if ($comments->hasPages())
        <div class="pb-6">
            {{ $comments->appends(request()->input())->links() }}
        </div>
    @endif
    <div class="overflow-x-auto rounded-sm bg-gray-200 mb-3">
        <table class="w-full text-left">
            <thead>
                <tr class="border-b-2 bg-slate-300 border-slate-400">
                    <th class="py-3 px-6 w-20">
                        <div class="flex items-center">
                            <input type="checkbox" id="check-all" data-type="comments">
                        </div>
                    </th>
                    <th class="py-2 px-2 sm:py-3 sm:px-6">Comment</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($comments as $comment)
                    <tr class="border-b border-gray-300 last:border-b-0 hover:bg-teal-100 bg-slate-100 odd:bg-slate-200">
                        <td class="py-3 px-6">
                            <div class="flex items-center">
                                <input type="checkbox" class="remove-checkbox" data-post-id="{{ $comment->id }}">
                            </div>
                        </td>
                        <td class="py-2 px-2 sm:py-3 sm:px-6 break-words">
                            <a href="{{ route('comments.edit', $comment) }}">{{ $comment->content }}</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="flex justify-end">
        <form method="POST" action="{{ route('deleteCheckedComments') }}">
            @method('DELETE')
            @csrf

            <input type="hidden" id="ids" name="ids" />
            <x-button type="red" id="remove" class="px-3">Remove checked</x-button>
        </form>
    </div>

    @if ($comments->hasPages())
        <div class="pt-6">
            {{ $comments->appends(request()->input())->links() }}
        </div>
    @endif
@else
    <p>No comment was found</p>
@endif

@endsection