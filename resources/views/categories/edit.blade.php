@extends('dashboard')

@section('content')
    <form method="POST" action="{{ route('categories.destroy', $category) }}">
        @method('DELETE')
        @csrf

        <div class="flex justify-end">
            <input type="submit" class="py-2 px-4 rounded bg-red-500 text-white cursor-pointer" value="Delete" />
        </div>
    </form>

    <form method="POST" action="{{ route('categories.update', $category) }}">
        @method('PUT')
        @csrf

        <div class="flex flex-col mb-3">
            <label for="name">Name:</label>
            <input type="text" name="name" value="{{ $category->name }}">
        </div>

        <div class="flex justify-end">
            <input type="submit" class="py-2 px-4 rounded bg-green-500 text-white cursor-pointer" value="Update" />
        </div>
    </form>
@endsection