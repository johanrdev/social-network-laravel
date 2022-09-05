@extends('dashboard')

@section('content')
    <div class="flex justify-between py-3">
        <h2 class="text-2xl font-bold">Edit category</h2>

        <form method="POST" action="{{ route('categories.destroy', $category) }}">
            @method('DELETE')
            @csrf
    
            <div class="flex mb-3">
                <x-button type="transparent">Delete</x-button>
            </div>
        </form>
    </div>
    
    @if ($errors->any())
            @foreach ($errors->all() as $error)
                <x-alert :message="$error"></x-alert>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('categories.update', $category) }}">
        @method('PUT')
        @csrf

        <div class="flex flex-col mb-3">
            <label for="name">Name:</label>
            <x-input type="text" name="name" id="name" value="{{ $category->name }}" required />
        </div>

        <div class="flex justify-end">
            <x-button type="green">Update</x-button>
        </div>
    </form>
@endsection