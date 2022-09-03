<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-12 gap-6">
            <div class="overflow-hidden col-span-3">
                <!-- Sidebar section -->
                <div class="p-6 bg-white border-b border-gray-200 mb-6">
                    <h2 class="pb-3 text-center font-bold">Dashboard</h2>
                    <ul>
                        <li class="flex border-b hover:bg-green-100 transition-colors duration-250"><a href="?tab=blogs" class="grow p-2">Blogs</a></li>
                        <li class="flex border-b hover:bg-green-100 transition-colors duration-250"><a href="?tab=posts" class="grow p-2">Posts</a></li>
                        <li class="flex border-b hover:bg-green-100 transition-colors duration-250"><a href="?tab=categories" class="grow p-2">Categories</a></li>
                        <li class="flex border-b hover:bg-green-100 transition-colors duration-250"><a href="?tab=comments" class="grow p-2">Comments</a></li>
                        <li class="flex hover:bg-green-100 transition-colors duration-250"><a href="?tab=bookmarks" class="grow p-2">Bookmarks</a></li>
                    </ul>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg col-span-9">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    @include('dashboard.blogs')
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
