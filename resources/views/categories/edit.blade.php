@extends('dashboard')

@section('content')
    @if ($errors->any())
            @foreach ($errors->all() as $error)
                <x-alert :message="$error"></x-alert>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('categories.destroy', $category) }}">
        @method('DELETE')
        @csrf

        <div class="flex justify-end">
            <x-button type="transparent">Delete</x-button>
        </div>
    </form>

    <form method="POST" action="{{ route('categories.update', $category) }}">
        @method('PUT')
        @csrf

        <div class="flex flex-col mb-3">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="{{ $category->name }}" required>
        </div>

        <div class="flex justify-end">
            <x-button type="green">Update</x-button>
        </div>
    </form>
@endsection