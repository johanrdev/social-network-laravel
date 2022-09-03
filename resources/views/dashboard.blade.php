@extends('layouts.app')

@section('container')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-12 gap-6">
            
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

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg col-span-9 flex flex-col">
                <div class="p-6 bg-white border-b border-gray-200 grow">
                    
                    @yield('content')
                    
                </div>
            </div>
        </div>
    </div>
@endsection
