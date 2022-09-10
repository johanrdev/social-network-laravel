<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="flex justify-between items-center py-3">
            <h2 class="text-2xl font-bold text-gray-400">Reset password</h2>
            <ul>
                <li>
                    <a href="{{ URL::previous() }}" class="transition-all duration-150 cursor-pointer font-black text-sm uppercase tracking-widest text-teal-500 hover:text-teal-700 underline">Go back</a>
                </li>
            </ul>
        </div>

        <div class="mb-4 text-sm text-gray-400">
            {{ __('Forgot your password? No problem. Enter your email address in the field below and we\'ll send a password reset link to your inbox.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full bg-gray-900 border-2 border-gray-600 focus:border-teal-400 text-gray-400 font-semibold" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button type="green" class="px-3">
                    {{ __('Send Link') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
