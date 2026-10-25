@extends('layouts.app')

@section('title', 'Daftar Laporan')

@section('content')
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Daftar Laporan Banjir</h1>
        <span class="text-sm text-slate-500">Total: {{ $laporan->count() }} laporan</span>
    </div>

    @if ($laporan->isEmpty())
        <x-alert type="info">Belum ada laporan yang masuk.</x-alert>
    @else
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($laporan as $item)
                @include('partials.laporan-card', ['item' => $item])
            @endforeach
        </div>
    @endif
@endsection