w tell <nav x-data="{ open: false }" @keydown.escape.window="open = false" class="relative z-20 border-b border-slate-200 bg-white/95 backdrop-blur-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex min-w-0 items-center gap-2">
                        <span class="forum-logo" aria-hidden="true"><span>F</span></span>
                        <span class="truncate text-xl font-bold tracking-tight text-slate-900">Forum <span class="text-blue-600">Gang</span></span>
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
                <button @click="open = ! open" :aria-expanded="open.toString()" aria-controls="mobile-navigation" aria-label="Toggle navigation" class="mobile-menu-toggle inline-flex items-center justify-center rounded-full text-slate-500 transition focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div x-cloak x-show="open" x-transition.opacity @click="open = false" class="fixed inset-0 top-16 z-30 bg-slate-950/30 backdrop-blur-[2px] sm:hidden" aria-hidden="true"></div>

    <!-- Responsive Navigation Drawer -->
    <div id="mobile-navigation" x-cloak x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full" class="mobile-navigation-drawer fixed inset-y-0 left-0 top-16 z-40 w-[min(84vw,19rem)] overflow-y-auto border-r border-slate-200 bg-white shadow-2xl sm:hidden">
        <div class="border-b border-slate-100 px-5 py-5">
            <p class="text-xs font-bold uppercase tracking-[0.18em] text-slate-400">Forum navigation</p>
            <p class="mt-1 text-sm text-slate-500">Find your way around the community.</p>
        </div>
        <div class="space-y-1 px-3 py-4">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home', 'threads.*', 'thread.*', 'topic.*')">Forum</x-responsive-nav-link>
            @auth
                @if (Auth::user()->isAdmin())
                    <x-responsive-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')">
                        Users
                    </x-responsive-nav-link>
                @endif
            @endauth
        </div>

        @auth
            <div class="border-t border-slate-100 px-3 py-5">
                <div class="rounded-2xl bg-slate-50 px-4 py-3">
                    <div class="font-semibold text-slate-800">{{ Auth::user()->name }}</div>
                    <div class="mt-1 truncate text-sm text-slate-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit" class="block w-full rounded-xl px-4 py-3 text-start text-sm font-semibold text-slate-600 transition hover:bg-red-50 hover:text-red-600">
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </div>
            </div>
        @else
            <div class="border-t border-slate-100 px-3 py-5">
                <div class="space-y-2">
                    <a href="{{ route('login') }}" class="block text-sm text-gray-600 hover:text-gray-900">Log in</a>
                    <a href="{{ route('register') }}" class="block text-sm text-gray-600 hover:text-gray-900">Register</a>
                </div>
            </div>
        @endauth
    </div>
</nav>
