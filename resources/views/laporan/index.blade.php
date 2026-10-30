@extends('layouts.app')

@section('title', 'Daftar Laporan')

@section('content')
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Daftar Laporan Banjir</h1>
        <span class="text-sm text-gray-500">Total: {{ $laporan->total() }} laporan</span>
    </div>

    @if ($laporan->isEmpty())
        <x-alert type="info">Belum ada laporan yang masuk.</x-alert>
    @else
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50 text-left text-gray-600">
                    <tr>
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Foto</th>
                        <th class="px-4 py-3">Pelapor</th>
                        <th class="px-4 py-3">Lokasi</th>
                        <th class="px-4 py-3">Tinggi Air</th>
                        <th class="px-4 py-3">Kategori Banjir</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Masuk</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach ($laporan as $item)
                        <tr class="align-middle">
                            <td class="px-4 py-3">{{ $laporan->firstItem() + $loop->index }}</td>
                            <td class="px-4 py-3">
                                @if ($item->foto_url)
                                    <a href="{{ route('laporan.show', $item) }}">
                                        <img src="{{ $item->foto_url }}" alt="Foto laporan {{ $item->id }}"
                                             class="h-14 w-14 rounded object-cover border">
                                    </a>
                                @else
                                    <span class="flex h-14 w-14 items-center justify-center rounded bg-gray-100 text-xs text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <div class="font-medium">{{ $item->nama_pelapor }}</div>
                                <div class="text-xs text-gray-500">{{ $item->no_hp }}</div>
                            </td>
                            <td class="px-4 py-3">
                                <div>{{ $item->lokasi }}</div>
                                <div class="text-xs text-gray-500">Kec. {{ $item->kecamatan }}</div>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">{{ $item->tinggi_air }} cm</td>
                            <td class="px-4 py-3"><span class="rounded-full bg-blue-100 px-3 py-1 text-blue-700">{{ $item->kategori_banjir }}</span></td>
                            <td class="px-4 py-3"><x-status-badge :status="$item->status" /></td>
                            <td class="px-4 py-3 whitespace-nowrap text-gray-500">{{ $item->created_at->translatedFormat('d M Y H:i') }}</td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <a href="{{ route('laporan.show', $item) }}" class="text-blue-700 hover:underline">Detail</a>
                                <a href="{{ route('laporan.edit', $item) }}" class="ml-2 text-amber-600 hover:underline">Edit</a>
                                <form action="{{ route('laporan.destroy', $item) }}" method="POST" class="inline"
                                      onsubmit="return confirm('Hapus laporan ini beserta fotonya?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="ml-2 text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $laporan->links() }}</div>
    @endif
@endsection
