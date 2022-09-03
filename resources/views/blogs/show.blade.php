@extends('layouts.app')

@section('container')
    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @foreach ($posts as $post)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg grow flex flex-col mb-3">
                    <div class="bg-white border-b border-gray-200 grow grid grid-cols-3">

                        <div class="w-full h-80 bg-gray-800 flex justify-center items-center">
                            <span class="uppercase text-gray-600 font-bold text-3xl">Image</span>
                        </div>

                        <div class="flex flex-col p-6 col-span-2">
                            <h2 class="text-xl font-bold">
                                <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                            </h2>
                            <p>{{ $post->content }}</p>
                        </div>
                    </div>
                </div>
            @endforeach

            @if ($posts->hasPages())
                <div class="pt-6 -mt-3">
                    {{ $posts->appends(request()->input())->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
