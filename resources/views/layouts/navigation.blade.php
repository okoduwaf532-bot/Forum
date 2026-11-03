w tell <nav x-data="{ open: false }" class="relative z-10 border-b border-slate-200 bg-white/95 backdrop-blur-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-2">
                        <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-600 text-lg font-black text-white">F</span>
                        <span class="text-xl font-bold tracking-tight text-slate-900">Forum <span class="text-blue-600">Gang</span></span>
                    </a>
                </div>

                <div class="hidden items-center space-x-8 sm:ms-10 sm:flex">
                    <a href="{{ route('home') }}" class="text-sm font-semibold {{ request()->routeIs('home', 'threads.*', 'thread.*', 'topic.*') ? 'text-blue-600' : 'text-slate-500 hover:text-slate-900' }}">Forum</a>
                    @auth
                        @if (Auth::user()->isAdmin())
                            <a href="{{ route('users.index') }}" class="text-sm font-semibold {{ request()->routeIs('users.*') ? 'text-blue-600' : 'text-slate-500 hover:text-slate-900' }}">Users</a>
                        @endif
                    @endauth
                </div>
            </div>

            @auth
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-semibold text-slate-600 transition hover:bg-slate-50 hover:text-slate-900">
                                <span class="flex h-8 w-8 items-center justify-center rounded-full bg-blue-100 text-xs font-bold text-blue-700">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                                <div>{{ Auth::user()->name }}</div>
                                <div>
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">Profile</x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                    <form method="POST" action="{{ route('logout') }}" class="ms-2">
                        @csrf
                        <button type="submit" class="rounded-lg px-3 py-2 text-sm font-semibold text-slate-500 transition hover:bg-red-50 hover:text-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                            Log out
                        </button>
                    </form>
                </div>
            @else
                <div class="hidden sm:flex sm:items-center sm:ms-6 space-x-4">
                    <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-gray-900">Log in</a>
                    <a href="{{ route('register') }}" class="text-sm text-gray-600 hover:text-gray-900">Register</a>
                </div>
            @endauth

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home', 'threads.*', 'thread.*', 'topic.*')">Forum</x-responsive-nav-link>
            @auth
                @if (Auth::user()->isAdmin())
                    <x-responsive-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')">
                        Users
                    </x-responsive-nav-link>
                @endif
            @endauth
        </div>

        <!-- Responsive Settings Options -->
        @auth
            <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit" class="block w-full px-4 py-2 text-start text-sm font-medium text-slate-600 transition hover:bg-slate-100 hover:text-slate-900">
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </div>
            </div>
        @else
            <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                <div class="px-4 space-y-3">
                    <a href="{{ route('login') }}" class="block text-sm text-gray-600 hover:text-gray-900">Log in</a>
                    <a href="{{ route('register') }}" class="block text-sm text-gray-600 hover:text-gray-900">Register</a>
                </div>
            </div>
        @endauth
    </div>
</nav>
