@extends('dashboard')

@section('content')
    <div class="flex flex-col py-3">
        <h2 class="text-2xl font-bold">New category</h2>
    </div>
    
    @if ($errors->any())
            @foreach ($errors->all() as $error)
                <x-alert :message="$error" :type="'danger'"></x-alert>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('categories.store') }}">
        @csrf

        <div class="flex flex-col mb-3">
            <x-label for="blog_id" :value="__('Blog')" />
            <x-select name="blog_id" id="blog_id">
                @foreach ($blogs as $blog)
                    <option value="{{ $blog->id }}" @selected($loop->first)>{{ $blog->name }}</option>
                @endforeach
            </x-select>
        </div>

        <div class="flex flex-col mb-3">
            <x-label for="name" :value="__('Name')" />
            <x-input type="text" name="name" id="name" required />
        </div>

        <div class="flex justify-end">
            <x-button type="green" class="px-3">Publish</x-button>
        </div>
    </form>
@endsection