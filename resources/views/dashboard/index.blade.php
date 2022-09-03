@extends('dashboard')

@section('content')

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

@endsection