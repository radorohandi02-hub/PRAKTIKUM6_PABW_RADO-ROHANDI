@extends('layouts.app')

@section('title', 'Lapor Banjir')

@section('content')
    <div class="max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold mb-1">Form Pelaporan Banjir</h1>
        <p class="text-sm text-gray-600 mb-4">Laporkan kondisi banjir di sekitar Anda ke BPBD Kabupaten Bandung.</p>

        <form action="{{ route('lapor.store') }}" method="POST" enctype="multipart/form-data"
              class="bg-white p-6 rounded-lg shadow space-y-4">
            @csrf
            @include('laporan._fields')

            <button type="submit" class="rounded-md bg-blue-700 px-5 py-2 text-white hover:bg-blue-800">
                Kirim Laporan
            </button>
        </form>
    </div>
@endsection
