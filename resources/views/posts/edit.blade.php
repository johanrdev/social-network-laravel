@extends('dashboard')

@section('content')
    @if ($errors->any())
            @foreach ($errors->all() as $error)
                <x-alert :message="$error"></x-alert>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('posts.destroy', $post) }}">
        @method('DELETE')
        @csrf

        <div class="flex justify-end">
            <input type="submit" class="py-2 px-4 rounded bg-red-500 text-white cursor-pointer" value="Delete" />
        </div>
    </form>

    <form method="POST" action="{{ route('posts.update', $post) }}">
        @method('PUT')
        @csrf

        <div class="flex flex-col mb-3">
            <label for="name">Title:</label>
            <input type="text" id="title" name="title" value="{{ $post->title }}" />
        </div>

        @if (count($categories) > 0)
            <div class="flex flex-col mb-3">
                <label for="category_id">Categories:</label>
                <select id="category_id" name="category_id">
                    @foreach ($categories as $category)
                        @if (!is_null($post->category))
                            <option value="{{ $category->id }}" @selected($category->id == $post->category->id)>{{ $category->name }}</option>
                        @else
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        @endif

        <div class="flex flex-col mb-3">
            <label for="content">Content:</label>
            <textarea name="content" id="content" cols="30" rows="10">{{ $post->content }}</textarea>
        </div>

        <div class="flex justify-end">
            <input type="submit" class="py-2 px-4 rounded bg-green-500 text-white cursor-pointer" value="Update" />
        </div>
    </form>
@endsection