
<nav x-data="{ open: false }" class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- Logo dan nama aplikasi -->
            <div class="flex items-center">
                <a href="{{ route('lapor.create') }}"
                   class="text-xl font-bold text-blue-700">
                    LaporBanjir
                </a>

                <!-- Navigasi desktop -->
                <div class="hidden sm:flex sm:ms-10 sm:space-x-8">
                    <a href="{{ route('lapor.create') }}"
                       class="inline-flex items-center px-1 border-b-2 text-sm font-medium
                       {{ request()->routeIs('lapor.create') ? 'border-blue-500 text-blue-700' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
                        Buat Laporan
                    </a>

                    @auth
                        <a href="{{ route('laporan.index') }}"
                           class="inline-flex items-center px-1 border-b-2 text-sm font-medium
                           {{ request()->routeIs('laporan.*') ? 'border-blue-500 text-blue-700' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
                            Daftar Laporan
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Menu desktop bagian kanan -->
            <div class="hidden sm:flex sm:items-center sm:gap-4">
                @guest
                    <a href="{{ route('login') }}"
                       class="text-sm text-gray-600 hover:text-blue-700">
                        Login
                    </a>
                @else
                    <span class="text-sm text-gray-600">
                        {{ Auth::user()->name }}
                    </span>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="text-sm text-red-600 hover:text-red-800">
                            Logout
                        </button>
                    </form>
                @endguest
            </div>

            <!-- Tombol menu mobile -->
            <div class="flex items-center sm:hidden">
                <button @click="open = !open"
                        type="button"
                        class="inline-flex items-center justify-center rounded-md p-2 text-gray-500 hover:bg-gray-100"
                        aria-label="Buka menu">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path x-show="!open" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path x-show="open" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="2"
                              d="M6 6l12 12M18 6L6 18" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Navigasi mobile -->
    <div x-show="open" x-cloak class="sm:hidden border-t border-gray-200">
        <div class="space-y-1 px-4 py-3">
            <a href="{{ route('lapor.create') }}"
               class="block rounded-md px-3 py-2 text-sm text-gray-700 hover:bg-gray-100">
                Buat Laporan
            </a>

            @auth
                <a href="{{ route('laporan.index') }}"
                   class="block rounded-md px-3 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    Daftar Laporan
                </a>

                <div class="border-t border-gray-200 pt-3">
                    <p class="px-3 py-1 text-sm text-gray-500">
                        {{ Auth::user()->name }}
                    </p>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="block w-full rounded-md px-3 py-2 text-left text-sm text-red-600 hover:bg-gray-100">
                            Logout
                        </button>
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}"
                   class="block rounded-md px-3 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    Login
                </a>
            @endauth
        </div>
    </div>
</nav>
