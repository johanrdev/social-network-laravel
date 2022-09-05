@extends('dashboard')

@section('content')
    <div class="flex flex-col py-3">
        <h2 class="text-2xl font-bold">New category</h2>
    </div>
    
    @if ($errors->any())
            @foreach ($errors->all() as $error)
                <x-alert :message="$error"></x-alert>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('categories.store') }}">
        @csrf

        <div class="flex flex-col mb-3">
            <label for="name">Name:</label>
            <x-input type="text" name="name" id="name" required />
        </div>

        <div class="flex justify-end">
            <x-button type="green">Publish</x-button>
        </div>
    </form>
@endsection