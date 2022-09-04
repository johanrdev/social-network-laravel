@extends('layouts.app')

@section('container')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg grow flex flex-col mb-3">
                <div class="bg-white border-b border-gray-200 grow">

                    <div class="w-full h-128 bg-gray-800 flex justify-center items-center">
                        <span class="uppercase text-gray-600 font-bold text-3xl">Image</span>
                    </div>

                    <div class="flex flex-col p-6 col-span-2">
                        <x-bookmark :bookmark="$bookmark" :id="$post->id" :type="'post'" />

                        <h2 class="text-xl font-bold">
                            <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                        </h2>
                        <p>{{ $post->content }}</p>
                    </div>
                </div>
            </div>

            <h2 class="text-2xl font-bold">Comments ({{ $comments->total() }})</h2>
            @foreach ($comments as $comment)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg grow flex flex-col mb-3">
                    <div class="bg-white border-b border-gray-200 grow">
                        <div class="flex flex-col p-6">
                            <h3 class="font-bold">{{ $comment->user->name }} said: </h3>
                            <p>{{ $comment->content }}</p>
                        </div>
                    </div>
                </div>
            @endforeach

            @if ($comments->hasPages())
                <div class="pt-6 -mt-3">
                    {{ $comments->appends(request()->input())->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
