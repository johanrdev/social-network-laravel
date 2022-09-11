<nav x-data="{ open: false }" class="bg-gray-800 sm:bg-gray-700 border-b border-gray-700 shadow-sm">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 bg-gray-700">
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
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
                            </svg>                                                                                      
                            
                            @if (request()->routeIs('dashboard'))
                                {{ __('Dashboard') }}
                            @endif
                        </x-nav-link>
                    @endif

                    <x-nav-link :href="route('browse')" :active="request()->routeIs('browse')">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 6.878V6a2.25 2.25 0 012.25-2.25h7.5A2.25 2.25 0 0118 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 004.5 9v.878m13.5-3A2.25 2.25 0 0119.5 9v.878m0 0a2.246 2.246 0 00-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0121 12v6a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18v-6c0-.98.626-1.813 1.5-2.122" />
                        </svg>
                          
                        @if (request()->routeIs('browse'))
                            {{ __('Browse') }}
                        @endif
                    </x-nav-link>

                    <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.index')">
                        <svg class="w-6 h-6 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>

                        @if (request()->routeIs('users.index'))
                            {{ __('Users') }}
                        @endif
                    </x-nav-link>

                    <x-nav-link :href="route('messages.index')" :active="request()->routeIs('messages.index')" class="relative">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 9.75a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 01.778-.332 48.294 48.294 0 005.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                        </svg>

                        @if (request()->routeIs('messages.index'))
                            {{ __('Messages') }}
                        @endif

                        @if ($new_messages > 0)
                            <span class="bg-rose-500 rounded-sm font-semibold px-1 uppercase text-xs text-white pointer-events-none select-none absolute right-1 top-1">
                                {{ $new_messages }}
                            </span>
                        @endif
                    </x-nav-link>

                    <x-nav-link :href="route('friends.index')" :active="request()->routeIs('friends.index')" class="relative">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                        </svg>

                        @if (request()->routeIs('friends.index'))
                            {{ __('Friends') }}
                        @endif

                        @if ($new_requests > 0)
                            <span class="bg-rose-500 rounded-sm font-semibold px-1 uppercase text-xs text-white pointer-events-none select-none absolute right-1 top-1">
                                {{ $new_requests }}
                            </span>
                        @endif
                    </x-nav-link>

                    <x-nav-link :href="route('bookmarks.index')" :active="request()->routeIs('bookmarks.index')" class="relative">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" />
                        </svg>

                        @if (request()->routeIs('bookmarks.index'))
                            {{ __('Bookmarks') }}
                        @endif

                        @if ($new_requests > 0)
                            <span class="bg-rose-500 rounded-sm font-semibold px-1 uppercase text-xs text-white pointer-events-none select-none absolute right-1 top-1">
                                {{ $new_requests }}
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
                <x-responsive-nav-link :href="route('browse')" :active="request()->routeIs('browse')">
                    {{ __('Browse') }}
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
                <x-responsive-nav-link :href="route('friends.index')" :active="request()->routeIs('friends')" class="relative">
                    {{ __('Friends') }}

                    @if ($new_requests > 0)
                        <span class="bg-rose-500 rounded-sm font-semibold px-1 uppercase text-xs text-white pointer-events-none select-none ml-2">
                            {{ $new_requests }}
                        </span>
                    @endif
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('bookmarks.index')" :active="request()->routeIs('bookmarks')" class="relative">
                    {{ __('Bookmarks') }}

                    @if ($new_requests > 0)
                        <span class="bg-rose-500 rounded-sm font-semibold px-1 uppercase text-xs text-white pointer-events-none select-none ml-2">
                            {{ $new_requests }}
                        </span>
                    @endif
                </x-responsive-nav-link>
            </div>

            <!-- Responsive Settings Options -->
            <div class="border-t border-gray-700 sm:border-gray-500">
                <x-responsive-nav-link :href="route('users.show', Auth::user())" :active="request()->routeIs('users.show')">
                    <div>
                        <div class="text-xs font-bold uppercase">Signed in as {{ Auth::user()->name }}</div>
                        <div class="text-xs font-bold">{{ Auth::user()->email }}</div>
                    </div>
                </x-responsive-nav-link>
                

                <div class="space-y-1 border-t border-gray-700 sm:border-gray-500">
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