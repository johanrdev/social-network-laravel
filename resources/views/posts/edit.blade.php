@extends('dashboard')

@section('content')
    <div class="flex justify-between items-center py-3">
        <h2 class="text-2xl font-bold">Edit post</h2>

        <form method="POST" action="{{ route('posts.destroy', $post) }}">
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

    <form method="POST" action="{{ route('posts.update', $post) }}">
        @method('PUT')
        @csrf

        <div class="flex flex-col mb-3">
            <label for="name">Title:</label>
            <x-input type="text" id="title" name="title" value="{{ $post->title }}" required />
        </div>

        @if (count($categories) > 0)
            <div class="flex flex-col mb-3">
                <label for="category_id">Categories:</label>
                <x-select id="category_id" name="category_id">
                    @foreach ($categories as $category)
                        @if (!is_null($post->category))
                            <option value="{{ $category->id }}" @selected($category->id == $post->category->id)>{{ $category->name }}</option>
                        @else
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endif
                    @endforeach
                </x-select>
            </div>
        @endif

        <div class="flex flex-col mb-3">
            <label for="content">Content:</label>
            <x-textbox name="content" id="content" cols="30" rows="10" required>{{ $post->content }}</x-textbox>
        </div>

        <div class="flex justify-end">
            <x-button type="green">Update</x-button>
        </div>
    </form>
@endsection