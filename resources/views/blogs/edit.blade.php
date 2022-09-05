@extends('dashboard')

@section('content')
    @if ($errors->any())
            @foreach ($errors->all() as $error)
                <x-alert :message="$error"></x-alert>
            @endforeach
        </ul>
    @endif
    
    <form method="POST" action="{{ route('blogs.destroy', $blog) }}">
        @method('DELETE')
        @csrf

        <div class="flex justify-end">
            <x-button type="transparent">Delete</x-button>
        </div>
    </form>

    <form method="POST" action="{{ route('blogs.update', $blog) }}">
        @method('PUT')
        @csrf

        <div class="flex flex-col mb-3">
            <label for="name">Name:</label>
            <x-input type="text" id="name" name="name" value="{{ $blog->name }}" required />
        </div>

        <div class="flex flex-col mb-3">
            <label for="description">Content:</label>
            <x-textbox name="description" id="description" cols="10" rows="7" required>{{ $blog->description }}</x-textbox>
        </div>

        <div class="flex justify-end">
            <x-button type="green">Update</x-button>
        </div>
    </form>
@endsection