@extends('layouts.app')

@section('container')
    <div class="pb-12 sm:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <x-user-card :user="$user" :showInfo="true"></x-user-card>

                @if ($blogs->hasPages())
                    <div class="py-6 px-6 sm:px-0">
                        {{ $blogs->appends(request()->input())->links() }}
                    </div>
                @endif

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 lg:grid-cols-3 my-6">
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
@endsection
