@extends('dashboard')

@section('content')
    <div class="flex justify-between items-center py-3">
        <h2 class="text-2xl font-bold">Edit comment</h2>

        <form method="POST" action="{{ route('comments.destroy', $comment) }}">
            @method('DELETE')
            @csrf

            <div class="flex">
                <x-button type="transparent">Delete</x-button>
            </div>
        </form>
    </div>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <x-alert :message="$error" :type="'danger'"></x-alert>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('comments.update', $comment) }}">
        @method('PUT')
        @csrf

        <div class="flex flex-col mb-3">
            <label for="content">Content:</label>
            <x-textbox name="content" id="content" cols="30" rows="10" required>{{ $comment->content }}</x-textbox>
        </div>

        <div class="flex justify-end">
            <x-button type="green" class="px-3">Update</x-button>
        </div>
    </form>
@endsection