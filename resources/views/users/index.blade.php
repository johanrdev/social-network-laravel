@extends('layouts.app')

@section('container')
    <div class="pb-12 sm:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if ($users->hasPages())
                <div class="py-6 px-6 sm:px-0">
                    {{ $users->appends(request()->input())->links() }}
                </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 lg:grid-cols-3">
                @foreach ($users as $user)
                    <x-user-card :user="$user" :showInfo="false" :showFullDescription="false"></x-user-card>
                @endforeach
            </div>

            @if ($users->hasPages())
                <div class="pt-6 px-6 sm:px-0">
                    {{ $users->appends(request()->input())->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
