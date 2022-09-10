<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="flex justify-between items-center py-3">
            <h2 class="text-2xl font-bold text-gray-400">Login</h2>
            <ul>
                <li>
                    <a href="{{ URL::previous() }}" class="transition-all duration-150 cursor-pointer font-black text-sm uppercase tracking-widest text-teal-500 hover:text-teal-700 underline">Go back</a>
                </li>
            </ul>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        {{-- <x-auth-validation-errors class="mb-4" :errors="$errors" /> --}}

        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <x-alert :message="$error" :type="'danger'"></x-alert>
                @endforeach
            </ul>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full bg-gray-900 border-2 border-gray-600 focus:border-teal-400 text-gray-400 font-semibold" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full bg-gray-900 border-2 border-gray-600 focus:border-teal-400 text-gray-400 font-semibold"
                         type="password"
                         name="password"
                         required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-gray-400 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-400 font-semibold">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-between mt-4">
                <div class="flex flex-col">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-400 hover:text-gray-200 font-semibold" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <a class="underline text-sm text-gray-400 hover:text-gray-200 font-semibold" href="{{ route('register') }}">
                        {{ __('Don\'t have an account?') }}
                    </a>
                </div>

                <x-button type="green" class="ml-3 px-3">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
