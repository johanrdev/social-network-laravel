@extends('dashboard')

@section('content')
    @if ($errors->any())
            @foreach ($errors->all() as $error)
                <x-alert :message="$error"></x-alert>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('blogs.store') }}">
        @csrf

        <div class="flex flex-col mb-3">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" />
        </div>

        <div class="flex flex-col mb-3">
            <label for="description">Content:</label>
            <textarea name="description" id="description" cols="30" rows="10"></textarea>
        </div>

        <div class="flex justify-end">
            <input type="submit" class="py-2 px-4 rounded bg-green-500 text-white cursor-pointer" value="Publish" />
        </div>
    </form>
@endsection