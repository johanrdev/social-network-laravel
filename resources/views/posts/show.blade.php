@extends('layouts.app')

@section('container')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg grow flex flex-col mb-3">
                <div class="bg-white border-b border-gray-200 grow">

                    <div class="w-full h-128 bg-gray-800 flex justify-center items-center">
                        <span class="uppercase text-gray-600 font-bold text-3xl">Image</span>
                    </div>

                    <div class="flex flex-col p-24 pb-40 col-span-2">
                        <x-bookmark :bookmark="$bookmark" :id="$post->id" :type="'post'" />

                        <h2 class="text-xl font-bold">
                            <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                        </h2>
                        <p>{{ $post->content }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg grow flex flex-col mb-3">
                <div class="bg-white border-b border-gray-200 grow">
                    <form method="POST" action="{{ route('comments.store') }}">
                        @csrf

                        <div class="flex flex-col p-6">
                            <h2 class="text-2xl font-bold mb-3">Comment on "{{ $post->title }}":</h2>
                            <input type="hidden" name="post_id" value="{{ $post->id }}" />
                            <input type="hidden" name="post_type" value="'post'" />
                            <textarea class="w-full rounded mb-3" name="content" rows="5"></textarea>
                            <div class="flex justify-end">
                                <button type="submit" class="py-2 px-4 rounded bg-green-500 text-white cursor-pointer">Publish</button>
                            </div>
                        </div>
                    </form>

                    <div class="p-6">
                        <h2 class="text-2xl font-bold my-3">Comments ({{ $comments->total() }})</h2>
                        @foreach ($comments as $comment)
                            <div class="overflow-hidden grow flex flex-col mb-3">
                                <div class="border-b border-gray-200 grow">
                                    <div class="flex flex-col p-6">
                                        <h3 class="font-bold">{{ $comment->user->name }} said ({{ $comment->created_at->diffForHumans() }}): </h3>
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
            </div>
        </div>
    </div>
@endsection
