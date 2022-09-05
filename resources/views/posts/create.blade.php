@extends('dashboard')

@section('content')
    <div class="flex flex-col py-3">
        <h2 class="text-2xl font-bold">New post</h2>
    </div>
    
    @if ($errors->any())
            @foreach ($errors->all() as $error)
                <x-alert :message="$error"></x-alert>
            @endforeach
        </ul>
    @endif
    
    <form method="POST" action="{{ route('posts.store') }}">
        @csrf

        <div class="flex flex-col mb-3">
            <label for="name">Title:</label>
            <x-input type="text" id="title" name="title" required />
        </div>

        <div class="flex flex-col mb-3">
            <label for="category_id">Categories:</label>
            <x-select id="category_id" name="category_id">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </x-select>
        </div>

        <div class="flex flex-col mb-3">
            <label for="content">Content:</label>
            <x-textbox name="content" id="content" cols="30" rows="20" required></x-textbox>
        </div>

        <div class="flex justify-end">
            <x-button type="green">Publish</x-button>
        </div>
    </form>
@endsection