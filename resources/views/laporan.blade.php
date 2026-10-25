@extends('layouts.app')

@section('title', 'Daftar Laporan')

@section('content')

<div class="page-header">

    <div class="small-title">
        Monitoring Laporan
    </div>

    <h1>
        Daftar Laporan Banjir
    </h1>

    <p>
        Informasi laporan banjir yang telah masuk
        ke dalam sistem LaporBanjir.
    </p>

</div>


<div class="report-grid">

    @forelse($laporan as $item)

        @include('partials.laporan-card', [
            'item' => $item
        ])

    @empty

        <div class="card">

            <div class="card-title">
                Belum Ada Laporan
            </div>

            <div class="card-description">
                Belum terdapat laporan banjir di dalam sistem.
            </div>

            <a href="{{ route('form') }}" class="btn btn-secondary">
                Buat Laporan
            </a>

        </div>

    @endforelse

</div>

@endsection