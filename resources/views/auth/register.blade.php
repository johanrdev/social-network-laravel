<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="flex justify-between items-center py-3">
            <h2 class="text-2xl font-bold text-gray-400">Register</h2>
            <ul>
                <li>
                    <a href="{{ URL::previous() }}" class="transition-all duration-150 cursor-pointer font-black text-sm uppercase tracking-widest text-teal-500 hover:text-teal-700 underline">Go back</a>
                </li>
            </ul>
        </div>

        <!-- Validation Errors -->
        {{-- <x-auth-validation-errors class="mb-4" :errors="$errors" /> --}}
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <x-alert :message="$error" :type="'danger'"></x-alert>
                @endforeach
            </ul>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full bg-gray-900 border-2 border-gray-600 focus:border-teal-400 text-gray-400 font-semibold" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full bg-gray-900 border-2 border-gray-600 focus:border-teal-400 text-gray-400 font-semibold" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full bg-gray-900 border-2 border-gray-600 focus:border-teal-400 text-gray-400 font-semibold"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full bg-gray-900 border-2 border-gray-600 focus:border-teal-400 text-gray-400 font-semibold"
                         type="password"
                         name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-between mt-4">
                <div class="flex flex-col">
                    <a class="underline text-sm text-gray-400 hover:text-gray-200 font-semibold" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>
                </div>

                <x-button type="green" class="ml-4 px-3">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
