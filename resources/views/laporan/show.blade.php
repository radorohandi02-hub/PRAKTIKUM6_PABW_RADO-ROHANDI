@extends('layouts.app')

@section('title', 'Detail Laporan')

@section('content')
    <div class="mb-4 flex items-center justify-between">
        <h1 class="text-2xl font-bold">Detail Laporan #{{ $laporan->id }}</h1>
        <x-status-badge :status="$laporan->status" class="text-sm" />
    </div>

    <div class="grid gap-6 md:grid-cols-2">
        <div class="bg-white p-4 rounded-lg shadow">
            @if ($laporan->foto_url)
                <img src="{{ $laporan->foto_url }}" alt="Foto bukti banjir" class="w-full rounded object-cover">
                <a href="{{ $laporan->foto_url }}" download class="mt-3 inline-block text-sm text-blue-700 hover:underline">Unduh foto</a>
            @else
                <div class="flex h-48 items-center justify-center rounded bg-gray-100 text-gray-400">Tidak ada foto</div>
            @endif
        </div>

        <dl class="bg-white p-6 rounded-lg shadow space-y-3 text-sm">
            <div><dt class="text-gray-500">Nama Pelapor</dt><dd class="font-medium">{{ $laporan->nama_pelapor }}</dd></div>
            <div><dt class="text-gray-500">No. HP</dt><dd class="font-medium">{{ $laporan->no_hp }}</dd></div>
            <div><dt class="text-gray-500">Lokasi</dt><dd class="font-medium">{{ $laporan->lokasi }}, Kec. {{ $laporan->kecamatan }}</dd></div>
            <div><dt class="text-gray-500">Tinggi Air</dt><dd class="font-medium">{{ $laporan->tinggi_air }} cm</dd></div>
            <div><dt class="text-gray-500">Kategori Banjir</dt><dd class="font-medium">{{ $laporan->kategori_banjir }}</dd></div>
            <div><dt class="text-gray-500">Keterangan</dt><dd class="font-medium">{{ $laporan->keterangan ?: '-' }}</dd></div>
            <div><dt class="text-gray-500">Dilaporkan</dt><dd class="font-medium">{{ $laporan->created_at->translatedFormat('d F Y H:i') }}</dd></div>
            <div><dt class="text-gray-500">Terakhir diperbarui</dt><dd class="font-medium">{{ $laporan->updated_at->translatedFormat('d F Y H:i') }}</dd></div>
        </dl>
    </div>

    <div class="mt-6 flex flex-wrap gap-3">
        <a href="{{ route('laporan.index') }}" class="rounded-md border border-gray-300 px-4 py-2 text-gray-700 hover:bg-gray-50">Kembali</a>
        <a href="{{ route('laporan.edit', $laporan) }}" class="rounded-md bg-amber-500 px-4 py-2 text-white hover:bg-amber-600">Edit / Ubah Status</a>
        <form action="{{ route('laporan.destroy', $laporan) }}" method="POST"
              onsubmit="return confirm('Hapus laporan ini beserta fotonya?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="rounded-md bg-red-600 px-4 py-2 text-white hover:bg-red-700">Hapus</button>
        </form>
    </div>
@endsection
