<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-12 gap-6">
            
            <x-sidebar :title="'Dashboard'" :sections="[
                [
                    'title' => 'Dashboard',
                    'links' => [
                        'Blogs (' . $blogs->total() . ')' => '?tab=blogs',
                        'Posts (' . $posts->total() . ')' => '?tab=posts',
                        'Categories (' . $categories->total() . ')' => '?tab=categories',
                        'Comments (' . $comments->total() . ')' => '?tab=comments',
                        'Bookmarks (' . $bookmarks->total() . ')' => '?tab=bookmarks'
                    ]
                ]
            ]" />

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg col-span-9 flex flex-col">
                <div class="p-6 bg-white border-b border-gray-200 grow">
                    
                    @if (request('tab') == 'blogs' || empty(request('tab')))
                        <h2 class="text-2xl font-bold p-6">{{ $blogs->total() }} Blogs</h2>
                        @include('dashboard.blogs')
                    @elseif (request('tab') == 'posts')
                        <h2 class="text-2xl font-bold p-6">{{ $posts->total() }} Posts</h2>
                        @include('dashboard.posts')
                    @elseif (request('tab') == 'categories')
                        <h2 class="text-2xl font-bold p-6">{{ $categories->total() }} Categories</h2>
                        @include('dashboard.categories')
                    @elseif (request('tab') == 'comments')
                        <h2 class="text-2xl font-bold p-6">{{ $comments->total() }} Comments</h2>
                        @include('dashboard.comments')
                    @elseif (request('tab') == 'bookmarks')
                        <h2 class="text-2xl font-bold p-6">{{ $bookmarks->total() }} Bookmarks</h2>
                        @include('dashboard.bookmarks')
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
