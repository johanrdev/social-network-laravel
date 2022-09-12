@extends('layouts.app')

@section('container')
    <div class="pb-12 sm:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-12 gap-6">
            <div class="col-span-12 lg:col-span-3 flex flex-col order-1 lg:order-0">  
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 last:mb-0">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h2 class="pb-3 text-center font-black text-sm uppercase tracking-widest">Dashboard</h2>
                        <ul>
                            <li class="flex border-b last:border-b-0 hover:bg-teal-500 hover:text-white transition-colors duration-250 flex items-center px-1 transition-all duration-150 {{ request()->routeIs('dashboard') ? 'bg-gray-100' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                </svg>
                                
                                <a href="{{ route('dashboard') }}" class="grow p-1">Start</a>
                            </li>
                            <li class="flex border-b last:border-b-0 hover:bg-teal-500 hover:text-white transition-colors duration-250 flex items-center px-1 transition-all duration-150 {{ request()->routeIs('blogs') ? 'bg-gray-100' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 3.75H6.912a2.25 2.25 0 00-2.15 1.588L2.35 13.177a2.25 2.25 0 00-.1.661V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 00-2.15-1.588H15M2.25 13.5h3.86a2.25 2.25 0 012.012 1.244l.256.512a2.25 2.25 0 002.013 1.244h3.218a2.25 2.25 0 002.013-1.244l.256-.512a2.25 2.25 0 012.013-1.244h3.859M12 3v8.25m0 0l-3-3m3 3l3-3" />
                                </svg>
                                
                                <a href="{{ route('blogs') }}" class="grow p-1">Blogs ({{ $num_of_blogs }})</a>
                            </li>
                            <li class="flex border-b last:border-b-0 hover:bg-teal-500 hover:text-white transition-colors duration-250 flex items-center px-1 transition-all duration-150 {{ request()->routeIs('posts') ? 'bg-gray-100' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                </svg>
                                
                                <a href="{{ route('posts') }}" class="grow p-1">Posts ({{ $num_of_posts }})</a>
                            </li>
                            <li class="flex border-b last:border-b-0 hover:bg-teal-500 hover:text-white transition-colors duration-250 flex items-center px-1 transition-all duration-150 {{ request()->routeIs('categories') ? 'bg-gray-100' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                                </svg>
                                
                                <a href="{{ route('categories') }}" class="grow p-1">Categories ({{ $num_of_categories }})</a>
                            </li>
                            <li class="flex border-b last:border-b-0 hover:bg-teal-500 hover:text-white transition-colors duration-250 flex items-center px-1 transition-all duration-150 {{ request()->routeIs('comments') ? 'bg-gray-100' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                                </svg>                              
                                
                                <a href="{{ route('comments') }}" class="grow p-1">Comments ({{ $num_of_comments }})</a>
                            </li>
                        </ul>
                    </div>
                </div>
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
