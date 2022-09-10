@extends('dashboard')

@section('content')
    <div class="flex flex-col py-3">
        <h2 class="text-2xl font-bold">{{ !$recipient ? 'New message' : 'Reply' }}</h2>
        @if (!is_null($message) && !is_null($recipient))
            <p><strong>{{ $recipient->name }} said ({{ $message->created_at->diffForHumans() }}):</strong> <br> {{ $message->content }}</p>
        @endif
    </div>
    
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li><x-alert :message="$error" :type="'danger'"></x-alert></li>
            @endforeach
        </ul>
    @endif
    
    <form method="POST" action="{{ route('messages.store') }}">
        @csrf

        <div class="flex flex-col mb-3">
            <label for="content">Message:</label>
            <x-textbox name="content" id="content" cols="30" rows="7" required></x-textbox>
        </div>

        <div class="flex justify-end">
            <input type="hidden" name="recipient_id" value="{{ request('recipient_id') }}">
            <x-button type="green" class="px-3">Publish</x-button>
        </div>
    </form>
@endsection