@extends('dashboard')

@section('content')
    <div class="flex flex-col py-3">
        @if (empty(request()->get('blog_id')))
            <h2 class="text-2xl font-bold">New post</h2>
        @else
            <h2 class="text-2xl font-bold">New post to "{{ $selected_blog->name }}"</h2>
        @endif
    </div>
    
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li><x-alert :message="$error" :type="'danger'"></x-alert></li>
            @endforeach
        </ul>
    @endif

    @if (empty(request()->get('blog_id')))
        <form method="GET" action="{{ route('posts.create') }}">
            <div class="flex flex-col mb-3">
                <x-label for="blog_id" :value="__('Blog')" />
                <x-select name="blog_id" id="blog_id" class="grow mr-1">
                    @foreach ($blogs as $blog)
                        <option value="{{ $blog->id }}" @selected(request('blog_id') == $blog->id)>{{ $blog->name }}</option>
                    @endforeach
                </x-select>
            </div>
            <div class="flex justify-end">
                <x-button type="green" class="px-3">Select</x-button>
            </div>
        </form>
    @endif
    
    @if (!empty(request()->get('blog_id')))
        <form method="POST" action="{{ route('posts.store') }}">
            @csrf

            <input type="hidden" name="blog_id" value="{{ request()->get('blog_id') }}">

            <div class="flex flex-col mb-3">
                <x-label for="name" :value="__('Title')" />
                <x-input type="text" id="title" name="title" required />
            </div>

            <div class="flex flex-col mb-3">
                <x-label for="category_id" :value="__('Category')" />
                <x-select id="category_id" name="category_id">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </x-select>
            </div>

            <div class="flex flex-col mb-3">
                <x-label for="content" :value="__('Content')" />
                <x-textbox name="content" id="content" cols="30" rows="20" required></x-textbox>
            </div>

            <div class="flex justify-end">
                <x-button type="green" class="px-3">Publish</x-button>
            </div>
        </form>
    @endif
@endsection