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
                    
                    <form method="POST" action="{{ route('blogs.update', $blog) }}">
                        @method('PUT')
                        @csrf

                        <div class="flex flex-col mb-3">
                            <label for="name">Name:</label>
                            <input type="text" id="name" name="name" value="{{ $blog->name }}" />
                        </div>
    
                        <div class="flex flex-col mb-3">
                            <label for="description">Content:</label>
                            <textarea name="description" id="description" cols="30" rows="10">{{ $blog->description }}</textarea>
                        </div>
    
                        <div class="flex justify-end">
                            <input type="submit" class="py-2 px-4 rounded bg-green-500 text-white cursor-pointer" value="Update" />
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
