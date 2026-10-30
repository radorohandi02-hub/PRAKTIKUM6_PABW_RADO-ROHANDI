@extends('layouts.app')

@section('title', 'Edit Laporan')

@section('content')
    <div class="max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold mb-4">Edit Laporan #{{ $laporan->id }}</h1>

        <form action="{{ route('laporan.update', $laporan) }}" method="POST" enctype="multipart/form-data"
              class="bg-white p-6 rounded-lg shadow space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="status" class="block text-sm font-medium mb-1">Status Penanganan</label>
                <select id="status" name="status"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @foreach (\App\Models\Laporan::STATUS as $st)
                        <option value="{{ $st }}" @selected(old('status', $laporan->status) === $st)>{{ $st }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('status')" class="mt-1" />
            </div>

            @include('laporan._fields', ['laporan' => $laporan])

            <div class="flex gap-3">
                <button type="submit" class="rounded-md bg-blue-700 px-5 py-2 text-white hover:bg-blue-800">Simpan Perubahan</button>
                <a href="{{ route('laporan.show', $laporan) }}" class="rounded-md border border-gray-300 px-5 py-2 text-gray-700 hover:bg-gray-50">Batal</a>
            </div>
        </form>
    </div>
@endsection
