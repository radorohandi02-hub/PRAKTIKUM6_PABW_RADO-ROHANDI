```blade
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'LaporBanjir') - BPBD Kabupaten Bandung</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-100 text-slate-800 flex flex-col">

    <nav class="bg-blue-700 text-white shadow">
        <div class="max-w-5xl mx-auto w-full px-4 py-3 flex items-center justify-between">
            <a href="{{ route('lapor.create') }}" class="font-bold text-lg">
                LaporBanjir
            </a>

            <div class="flex items-center gap-4 text-sm">
                <a href="{{ route('lapor.create') }}" class="hover:underline">
                    Buat Laporan
                </a>

                @auth
                    <a href="{{ route('laporan.index') }}" class="hover:underline">
                        Daftar Laporan
                    </a>

                    <a href="{{ route('profil') }}" class="hover:underline">
                        Profil
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="hover:underline">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="hover:underline">
                        Login Petugas
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="max-w-5xl mx-auto w-full px-4 py-6 flex-grow">
        @yield('content')
    </main>

    <footer class="text-center text-xs text-slate-500 py-6">
        &copy; {{ date('Y') }} BPBD Kabupaten Bandung
    </footer>

</body>
</html>