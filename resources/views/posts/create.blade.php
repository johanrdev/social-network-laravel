@extends('dashboard')

@section('content')
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
            <input type="text" id="title" name="title" />
        </div>

        <div class="flex flex-col mb-3">
            <label for="category_id">Categories:</label>
            <select id="category_id" name="category_id">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex flex-col mb-3">
            <label for="content">Content:</label>
            <textarea name="content" id="content" cols="30" rows="10"></textarea>
        </div>

        <div class="flex justify-end">
            <input type="submit" class="py-2 px-4 rounded bg-green-500 text-white cursor-pointer" value="Publish" />
        </div>
    </form>
@endsection