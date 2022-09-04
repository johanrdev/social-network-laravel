@extends('layouts.app')

@section('container')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if ($blogs->hasPages())
                <div class="py-6">
                    {{ $blogs->appends(request()->input())->links() }}
                </div>
            @endif

            <div class="grid grid-cols-3 gap-6">
                @foreach ($blogs as $blog)
                    <a href="{{ route('blogs.show', $blog->id) }}" class="flex flex-col">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg grow flex flex-col">
                            <div class="bg-white border-b border-gray-200 grow flex flex-col">
                                
                                <div class="h-40 bg-gray-800 flex justify-center items-center">
                                    <span class="uppercase text-gray-600 font-bold text-3xl">Image</span>
                                </div>
        
                                <div class="p-6 grow">
                                    <h2 class="text-xl font-bold text-center">{{ $blog->name }}</h2>
                                    <p class="text-center">{{ $blog->description }}</p>
                                </div>

                                <span class="p-1 m-2 text-center font-bold">By {{ $blog->user->name }}</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            @if ($blogs->hasPages())
                <div class="pt-6">
                    {{ $blogs->appends(request()->input())->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
