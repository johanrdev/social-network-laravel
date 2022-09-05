@extends('dashboard')

@section('content')
    @if ($errors->any())
            @foreach ($errors->all() as $error)
                <x-alert :message="$error"></x-alert>
            @endforeach
        </ul>
    @endif
    
    <form method="POST" action="{{ route('comments.destroy', $comment) }}">
        @method('DELETE')
        @csrf

        <div class="flex justify-end">
            <x-button type="transparent">Delete</x-button>
        </div>
    </form>

    <form method="POST" action="{{ route('comments.update', $comment) }}">
        @method('PUT')
        @csrf

        <div class="flex flex-col mb-3">
            <label for="content">Content:</label>
            <textarea name="content" id="content" cols="30" rows="10" required>{{ $comment->content }}</textarea>
        </div>

        <div class="flex justify-end">
            <x-button type="green">Update</x-button>
        </div>
    </form>
@endsection