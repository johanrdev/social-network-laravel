@extends('layouts.app')

@section('container')
    <div class="pb-12 sm:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-12 flex flex-col justify-center items-center">
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-black">{{ $blog->name }}</h2>
                <ul class="flex flex-col sm:flex-row mt-3">
                    <li class="text-center">
                        <span class="bg-transparent text-sm font-bold mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">
                            <a href="#">{{ $blog->user->name }}</a>
                        </span>
                    </li>
                    <li class="text-center">
                        <span class="bg-transparent text-sm font-bold mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">
                            <a href="#">{{ $blog->created_at->diffForHumans() }}</a>
                        </span>
                    </li>
                </ul>
                <p class="text-xl leading-loose py-6 text-center">{{ $blog->description }}</p>
                <x-bookmark :bookmark="$bookmark" :id="$blog->id" :type="'blog'" />
            </div>

            @if ($posts->hasPages())
                <div class="py-6 px-6 sm:px-0">
                    {{ $posts->appends(request()->input())->links() }}
                </div>
            @endif

            @foreach ($posts as $post)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg grow flex flex-col mb-3">
                    <div class="bg-white border-b border-gray-200 grow grid grid-cols-1 lg:grid-cols-3">

                        <div class="w-full h-80 bg-gray-800 flex justify-center items-center">
                            <span class="uppercase text-gray-600 font-bold text-3xl">Image</span>
                        </div>

                        <div class="flex flex-col p-6 col-span-2">
                            <h2 class="text-xl font-bold my-3">
                                <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                            </h2>
                            <ul class="flex mb-3 flex-wrap">
                                <li>
                                    <span class="bg-gray-200 text-gray-800 text-sm font-bold mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300 whitespace-nowrap">
                                        <a href="#">{{ $post->user->name }}</a>
                                    </span>
                                </li>
                                <li>
                                    <span class="bg-gray-200 text-gray-800 text-sm font-bold mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300 whitespace-nowrap">
                                        <a href="#">{{ $post->created_at->diffForHumans() }}</a>
                                    </span>
                                </li>
                                <li>
                                    <span class="bg-gray-200 text-gray-800 text-sm font-bold mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300 whitespace-nowrap">
                                        <a href="#">{{ !is_null($post->category) ? $post->category->name : 'Uncategorized' }}</a>
                                    </span>
                                </li>
                            </ul>
                            <p class="text-lg leading-loose">{!! substr(nl2br($post->content), 0, 200) !!} <a href="{{ route('posts.show', $post) }}" class="font-bold text-rose-500 underline">Read More</a></p>
                        </div>
                    </div>
                </div>
            @endforeach

            @if ($posts->hasPages())
                <div class="pt-6 -mt-3 px-6 sm:px-0">
                    {{ $posts->appends(request()->input())->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
