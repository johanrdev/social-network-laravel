@extends('layouts.app')

@section('container')
    <div class="pb-12 sm:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg grow flex flex-col">
                <div class="bg-white border-b border-gray-200 grow flex flex-col">
                    <div class="p-6 flex flex-col mx-0 sm:mx-20 md:mx-40 lg:mx-60">
                        <div class="flex flex-col py-3">
                            <h2 class="text-2xl font-bold">Edit profile</h2>
                        </div>
                        
                        @if ($errors->any())
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <x-alert :message="$error"></x-alert>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ route('users.update', $user) }}">
                            @method('PUT')
                            @csrf

                            <!-- Name -->
                            <div>
                                <x-label for="name" :value="__('Name')" />
                
                                <x-input id="name" class="w-full block mt-1 font-semibold" type="text" name="name" value="{{ $user->name }}" required autofocus />
                            </div>
                
                            <!-- Email Address -->
                            <div class="mt-4">
                                <x-label for="email" :value="__('Email')" />
                
                                <x-input id="email" class="w-full block mt-1 font-semibold" type="email" name="email" value="{{ $user->email }}" required autofocus />
                            </div>
                
                            <!-- Password -->
                            <div class="mt-4">
                                <x-label for="password" :value="__('Password')" />
                
                                <x-input id="password" class="w-full block mt-1 font-semibold" type="password" name="password" required />
                            </div>

                            <!-- Confirm Password -->
                            <div class="mt-4">
                                <x-label for="password_confirmation" :value="__('Confirm Password')" />
                
                                <x-input id="password_confirmation" class="w-full block mt-1 font-semibold" type="password" name="password_confirmation" required />
                            </div>

                            <!-- Description -->
                            <div class="mt-4">
                                <x-label for="description" :value="__('Description')" />
                
                                <x-textbox rows="5" id="description" class="w-full block mt-1 font-semibold" type="text" name="description" required autofocus>
                                    {{ $user->description }}
                                </x-textbox>
                            </div>

                            <hr class="my-6">

                            <!-- Current Password -->
                            <div class="mt-4">
                                <x-label for="current_password" :value="__('Current Password')" />
                
                                <x-input id="current_password" class="w-full block mt-1 font-semibold" type="password" name="current_password" required />
                            </div>
                
                            <div class="flex items-center justify-end mt-6">
                                <x-button type="green" class="ml-3">
                                    {{ __('Update') }}
                                </x-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
