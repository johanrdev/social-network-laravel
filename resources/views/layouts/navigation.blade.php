<nav x-data="{ open: false }" class="bg-gray-700 border-b border-gray-700 shadow-sm">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                
                    <a href="{{ route('dashboard') }}" class="flex items-center">
                        <div class="shrink-0 flex items-center text-gray-400 hover:text-gray-200 stroke-gray-400 hover:stroke-gray-200 transition-all duration-150 cursor-pointer">
                            <x-application-logo />
                            <span class="text-xl uppercase font-black ml-1">TextBox</span>
                        </div>
                    </a>
                

                <!-- Navigation Links -->
                <div class="hidden sm:-my-px sm:ml-10 sm:flex">
                    @if (Auth::check())
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                    @endif

                    <x-nav-link :href="route('explore')" :active="request()->routeIs('explore')">
                        {{ __('Explore') }}
                    </x-nav-link>

                    <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.index')">
                        {{ __('Users') }}
                    </x-nav-link>

                    <x-nav-link :href="route('messages.index')" :active="request()->routeIs('messages.index')" class="relative">
                        {{ __('Messages') }}

                        @if ($new_messages > 0)
                            <span class="bg-rose-500 rounded-sm font-semibold px-1 uppercase text-xs text-white pointer-events-none select-none absolute -right-2 top-4">
                                {{ $new_messages }}
                            </span>
                        @endif
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            @if (Auth::check())
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center font-medium text-gray-400 hover:text-gray-200 hover:border-indigo-200 focus:outline-none focus:text-gray-200 focus:border-indigo-200 transition duration-150 ease-in-out">
                                <div class="text-right">
                                    <div class="font-bold text-xs">Signed in as {{ Auth::user()->name }}</div>
                                    <div class="font-bold text-xs">{{ Auth::user()->email }}</div>
                                </div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('users.show', Auth::user())">
                                {{ __('Show profile') }}
                            </x-dropdown-link>
                            <hr>
                            <x-dropdown-link :href="route('users.edit', Auth::user())">
                                {{ __('Edit profile') }}
                            </x-dropdown-link>
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            @endif

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-sm text-gray-400 bg-gray-700 hover:text-gray-200 focus:outline-none focus:text-gray-200 transition duration-500 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    @if (Auth::check())
        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
            <div class="pt-2">
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('explore')" :active="request()->routeIs('explore')">
                    {{ __('Explore') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('users.index')" :active="request()->routeIs('users')">
                    {{ __('Users') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('messages.index')" :active="request()->routeIs('messages')" class="relative">
                    {{ __('Messages') }}

                    @if ($new_messages > 0)
                            <span class="bg-rose-500 rounded-sm font-semibold px-1 uppercase text-xs text-white pointer-events-none select-none ml-2">
                                {{ $new_messages }}
                            </span>
                        @endif
                </x-responsive-nav-link>
            </div>

            <!-- Responsive Settings Options -->
            <div class="border-t border-gray-500">
                <x-responsive-nav-link :href="route('users.show', Auth::user())" :active="request()->routeIs('users.show')">
                    <div>
                        <div class="text-xs font-bold uppercase">Signed in as {{ Auth::user()->name }}</div>
                        <div class="text-xs font-bold">{{ Auth::user()->email }}</div>
                    </div>
                </x-responsive-nav-link>
                

                <div class="space-y-1 border-0 border-gray-500">
                    <!-- Authentication -->
                    <x-responsive-nav-link :href="route('users.edit', Auth::user())">Edit profile</x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        </div>
    @endif
</nav>