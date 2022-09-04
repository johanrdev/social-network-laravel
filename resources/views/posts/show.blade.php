@extends('layouts.app')

@section('container')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg grow flex flex-col mb-3">
                <div class="bg-white border-b border-gray-200 grow">

                    <div class="w-full h-128 bg-gray-800 flex flex-col relative">
                        <div class="absolute right-0 p-3 text-gray-300 font-bold">
                            <x-bookmark :bookmark="$bookmark" :id="$post->id" :type="'post'" />
                        </div>
                        <div class="flex justify-center items-center grow">
                            <span class="uppercase text-gray-600 font-bold text-3xl">Image</span>
                        </div>
                    </div>

                    <div class="flex flex-col p-6 col-span-2">
                        <h2 class="text-2xl font-bold my-3">
                            <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                        </h2>
                        <ul class="flex">
                            <li class="mr-6 font-bold">{{ $post->user->name }}</li>
                            <li class="mr-6 font-bold">{{ $post->created_at->diffForHumans() }}</li>
                            <li class="font-bold">{{ !is_null($post->category) ? $post->category->name : 'Uncategorized' }}</li>
                        </ul>
                        
                        <p>{!! nl2br($post->content) !!}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg grow flex flex-col mb-3">
                <div class="bg-white border-b border-gray-200 grow">
                    <div class="flex flex-col p-6">
                        @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    <x-alert :message="$error"></x-alert>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ route('comments.store') }}">
                            @csrf

                            <h2 class="text-2xl font-bold mb-3">Comment on "{{ $post->title }}":</h2>
                            <input type="hidden" name="post_id" value="{{ $post->id }}" />
                            <input type="hidden" name="post_type" value="post" />
                            <textarea class="w-full rounded mb-3" name="content" rows="5"></textarea>
                            <div class="flex justify-end">
                                <button type="submit" class="py-2 px-4 rounded bg-green-500 text-white cursor-pointer">Publish</button>
                            </div>
                        </form>
                    </div>
                    

                    <div class="p-6">
                        <h2 class="text-2xl font-bold my-3">Comments ({{ $comments->total() }})</h2>
                        @foreach ($comments as $comment)
                            <div class="overflow-hidden grow flex flex-col mb-3">
                                <div class="border-b border-gray-200 grow">
                                    <div class="flex flex-col p-6">
                                        <h3 class="font-bold">{{ $comment->user->name }} said ({{ $comment->created_at->diffForHumans() }}): </h3>
                                        <p>{!! nl2br($comment->content) !!}</p>
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
