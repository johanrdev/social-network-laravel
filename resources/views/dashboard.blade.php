@extends('layouts.app')

@section('container')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-12 gap-6">
            <div class="col-span-3 flex flex-col">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 last:mb-0">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h2 class="pb-3 text-center font-black text-sm uppercase tracking-widest">Select Blog</h2>
                        
                        <form method="POST" action="{{ route('set_current_blog') }}">
                            @method('PUT')
                            @csrf

                            <select class="w-full mb-3" name="selected_blog_id">
                                @foreach ($userBlogs as $blog)
                                    <option value="{{ $blog->id }}" @selected(Auth::user()->selected_blog_id == $blog->id)>{{ $blog->name }}</option>
                                @endforeach
                            </select>
                            <div class="flex justify-end">
                                <x-button type="green">Select</x-button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <x-sidebar :title="'Dashboard'" :sections="[
                    [
                        'title' => 'Dashboard',
                        'links' => [
                            'Blogs' => '?tab=blogs',
                            'Posts' => '?tab=posts',
                            'Categories' => '?tab=categories',
                            'Comments' => '?tab=comments',
                            'Bookmarks' => '?tab=bookmarks'
                        ]
                    ]
                ]" />
                </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg col-span-9 flex flex-col">
                <div class="p-6 bg-white border-b border-gray-200 grow">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
@endsection
