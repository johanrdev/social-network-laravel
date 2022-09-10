@extends('dashboard')

@section('content')

    @if (request('tab') == 'blogs' || empty(request('tab')))
        @include('dashboard.blogs')
    @elseif (request('tab') == 'posts')
        @include('dashboard.posts')
    @elseif (request('tab') == 'categories')
        @include('dashboard.categories')
    @elseif (request('tab') == 'comments')
        @include('dashboard.comments')
    @elseif (request('tab') == 'bookmarks')
        @include('dashboard.bookmarks')
    @elseif (request('tab') == 'friends')
        @include('dashboard.friends')
    @endif

@endsection