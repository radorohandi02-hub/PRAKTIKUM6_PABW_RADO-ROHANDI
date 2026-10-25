@extends('layouts.app')

@section('title', 'Buat Laporan')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Form Pelaporan Banjir</h1>

    @if ($errors->any())
        <x-alert type="danger">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </x-alert>
    @endif

    <form action="{{ route('lapor.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium mb-1" for="nama_pelapor">Nama Pelapor</label>
            <input type="text" id="nama_pelapor" name="nama_pelapor" value="{{ old('nama_pelapor') }}"
                   class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1" for="lokasi">Lokasi (Kecamatan)</label>
            <input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi') }}"
                   class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1" for="tinggi_genangan">Tinggi Genangan (cm)</label>
            <input type="number" id="tinggi_genangan" name="tinggi_genangan" min="0" value="{{ old('tinggi_genangan') }}"
                   class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1" for="tanggal_kejadian">Tanggal Kejadian</label>
            <input type="date" id="tanggal_kejadian" name="tanggal_kejadian" value="{{ old('tanggal_kejadian') }}"
                   class="w-full border rounded px-3 py-2" required>
        </div>

        <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-800">
            Kirim Laporan
        </button>
    </form>
@endsection
