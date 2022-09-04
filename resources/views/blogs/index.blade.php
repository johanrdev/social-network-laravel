@extends('layouts.app')

@section('container')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if ($blogs->hasPages())
                <div class="py-6">
                    {{ $blogs->appends(request()->input())->links() }}
                </div>
            @endif

            <div class="grid grid-cols-3 gap-6">
                @foreach ($blogs as $blog)
                    <x-blog-card :blog="$blog"></x-blog-card>
                @endforeach
            </div>

            @if ($blogs->hasPages())
                <div class="pt-6">
                    {{ $blogs->appends(request()->input())->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
