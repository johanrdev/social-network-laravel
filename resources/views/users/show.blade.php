@extends('layouts.app')

@section('container')
    <div class="pb-12 sm:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-6">
            <x-user-card :user="$user" :showInfo="true" :showFullDescription="true" :showFriendRequestLink="$has_request"></x-user-card>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-12 gap-0 lg:gap-6">
            <div class="col-span-12 lg:col-span-8 flex flex-col order-1 lg:order-0">  
                <div class="overflow-hidden shadow-sm">
                    @if ($blogs->hasPages())
                        <div class="py-6 px-6 sm:px-0">
                            {{ $blogs->appends(request()->input())->links() }}
                        </div>
                    @endif
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach ($blogs as $blog)
                            <x-blog-card :blog="$blog"></x-blog-card>
                        @endforeach
                    </div>

                    @if ($blogs->hasPages())
                        <div class="pt-6 px-6 sm:px-0">
                            {{ $blogs->appends(request()->input())->links() }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg col-span-12 lg:col-span-4 flex flex-col order-0 lg:order-1">
                <div class="p-0 lg:p-6 bg-white border-b border-gray-200 grow">
                    <h2 class="pb-3 py-3 lg:pt-0 text-center font-black text-sm uppercase tracking-widest">Friends</h2>
                    <div class="h-80 overflow-scroll">
                        @foreach ($user->friends as $friend)
                        <div class="px-3 py-2 odd:bg-gray-100 last:border-b-0 border-b border-gray-200">
                            <div class="flex">
                                <div class="bg-gray-800 rounded-full w-10 h-10 mr-0 mr-3 shrink-0 flex flex-col items-center justify-center self-center sm:self-start">
                                    <span class="uppercase text-gray-600 font-bold text-xl">U</span>
                                </div>
                                <div class="flex sm:text-left grow justify-between items-center">
                                    <h2 class="text-md font-bold"><a href="{{ route('users.show', $friend) }}">{{ $friend->name }}</a></h2>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>

                <div class="p-0 lg:p-6 bg-white border-b border-gray-200 grow">
                    <h2 class="pb-3 py-3 lg:pt-0 text-center font-black text-sm uppercase tracking-widest">Recent Posts</h2>
                    <div class="h-80 overflow-scroll">
                        @foreach ($posts as $post)
                            <div class="px-3 py-2 odd:bg-gray-100 last:border-b-0 border-b border-gray-200">
                                <div class="flex">
                                    <div class="bg-gray-800 rounded w-10 h-10 mr-0 mr-3 shrink-0 flex flex-col items-center justify-center self-center sm:self-start">
                                        <span class="uppercase text-gray-600 font-bold text-xl">P</span>
                                    </div>
                                    <div class="flex sm:text-left grow justify-between items-center">
                                        <h2 class="text-md font-bold"><a href="{{ route('users.show', $post) }}">{{ $post->title }}</a></h2>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
