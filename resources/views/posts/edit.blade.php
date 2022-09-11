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

        <input type="hidden" name="blog_id" value="{{ $post->blog_id }}">

        <div class="flex flex-col mb-3">
            <x-label for="name" :value="__('Title')" />
            <x-input type="text" id="title" name="title" value="{{ $post->title }}" required />
        </div>

        <div class="flex flex-col mb-3">
            <x-label for="category_id" :value="__('Category')" />
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

        {{-- <div class="flex flex-col mb-3">
            <x-label for="blog_id" :value="__('Blog')" />
            <x-select name="blog_id" id="blog_id">
                @foreach ($blogs as $blog)
                    <option value="{{ $blog->id }}" @selected($category->blog_id == $blog->id)>{{ $blog->name }}</option>
                @endforeach
            </x-select>
        </div> --}}

        <div class="flex flex-col mb-3">
            <x-label for="content" :value="__('Content')" />
            <x-textbox name="content" id="content" cols="30" rows="10" required>{{ $post->content }}</x-textbox>
        </div>

        <div class="flex justify-end">
            <x-button type="green" class="px-3">Update</x-button>
        </div>
    </form>
@endsection