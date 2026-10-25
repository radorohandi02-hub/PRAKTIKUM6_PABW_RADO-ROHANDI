```blade
@extends('layouts.app')

@section('title', 'Form Laporan Banjir')

@section('content')

<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-md p-6 md:p-8">

        <div class="mb-6">
            <h1 class="text-2xl font-bold text-blue-700">
                Form Laporan Banjir
            </h1>

            <p class="text-gray-600 mt-2">
                Silakan isi data kejadian banjir dengan benar.
            </p>
        </div>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-5">
                <p class="font-semibold mb-2">
                    Periksa kembali data yang kamu masukkan:
                </p>

                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-5">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('lapor.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label for="nama_pelapor" class="block font-medium text-gray-700 mb-2">
                    Nama Pelapor
                </label>

                <input
                    type="text"
                    id="nama_pelapor"
                    name="nama_pelapor"
                    value="{{ old('nama_pelapor') }}"
                    required
                    maxlength="255"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Masukkan nama lengkap">
            </div>

            <div>
                <label for="lokasi" class="block font-medium text-gray-700 mb-2">
                    Lokasi Kejadian
                </label>

                <input
                    type="text"
                    id="lokasi"
                    name="lokasi"
                    value="{{ old('lokasi') }}"
                    required
                    maxlength="255"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Contoh: Dayeuhkolot, Kabupaten Bandung">
            </div>

            <div>
                <label for="tinggi_genangan" class="block font-medium text-gray-700 mb-2">
                    Tinggi Genangan Air (cm)
                </label>

                <input
                    type="number"
                    id="tinggi_genangan"
                    name="tinggi_genangan"
                    value="{{ old('tinggi_genangan') }}"
                    min="0"
                    required
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Contoh: 50">
            </div>

            <div>
                <label for="tanggal_kejadian" class="block font-medium text-gray-700 mb-2">
                    Tanggal Kejadian
                </label>

                <input
                    type="date"
                    id="tanggal_kejadian"
                    name="tanggal_kejadian"
                    value="{{ old('tanggal_kejadian') }}"
                    required
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="flex flex-col sm:flex-row gap-3 pt-2">
                <button
                    type="submit"
                    class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-5 rounded-lg transition">
                    Kirim Laporan
                </button>

                <button
                    type="reset"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-3 px-5 rounded-lg transition">
                    Reset
                </button>
            </div>
        </form>

        <p class="text-sm text-gray-500 mt-6">
            Pastikan lokasi dan tinggi genangan yang dilaporkan sesuai
            dengan kondisi di lapangan.
        </p>

    </div>
</div>

@endsection
```