@extends('layouts.app')

@section('title', 'Laporan Terkirim')

@section('content')
    <x-alert type="success">
        <p class="font-semibold">Terima kasih, {{ $laporan->nama_pelapor }}!</p>
        <p>
            Laporan banjir di <strong>{{ $laporan->lokasi }}</strong>
            (tinggi genangan {{ $laporan->tinggi_genangan }} cm,
            status <strong>{{ $laporan->status }}</strong>) berhasil disimpan.
        </p>
    </x-alert>

    <div class="flex gap-3">
        <a href="{{ route('laporan.index') }}" class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-800">
            Lihat Daftar Laporan
        </a>
        <a href="{{ route('lapor.create') }}" class="border border-blue-700 text-blue-700 px-4 py-2 rounded hover:bg-blue-50">
            Buat Laporan Lagi
        </a>
    </div>
@endsection
