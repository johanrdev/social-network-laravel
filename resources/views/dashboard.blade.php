@extends('layouts.app')

@section('container')
    <div class="pb-12 sm:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-12 gap-6">
            <div class="col-span-12 lg:col-span-3 flex flex-col order-1 lg:order-0">  
                <x-sidebar :title="'Dashboard'" :sections="[
                    [
                        'title' => 'Dashboard',
                        'links' => [
                            'Blogs' => '?tab=blogs',
                            'Posts' => '?tab=posts',
                            'Categories' => '?tab=categories',
                            'Comments' => '?tab=comments',
                            'Bookmarks' => '?tab=bookmarks',
                            'Friends' => '?tab=friends'
                        ]
                    ]
                ]" />
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg col-span-12 lg:col-span-9 flex flex-col order-0 lg:order-1">
                <div class="p-6 bg-white border-b border-gray-200 grow">
                    @if (session()->has('message'))
                        <x-alert :type="'success'" :message="session()->get('message')"></x-alert>
                    @endif

                    @yield('content')
                </div>
            </div>
        </div>
    </div>
@endsection
