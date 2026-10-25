@php
    $badge = match ($item->status) {
        'Awas'   => 'bg-red-600',
        'Siaga'  => 'bg-orange-500',
        default  => 'bg-yellow-500',
    };
@endphp

<div class="bg-white rounded-lg shadow p-4 flex flex-col gap-2">
    <div class="flex items-start justify-between">
        <h3 class="font-semibold">{{ $item->lokasi }}</h3>
        <span class="text-white text-xs font-bold px-2 py-1 rounded {{ $badge }}">
            {{ $item->status }}
        </span>
    </div>
    <p class="text-sm text-slate-600">Pelapor: {{ $item->nama_pelapor }}</p>
    <p class="text-sm">Tinggi genangan: <strong>{{ $item->tinggi_genangan }} cm</strong></p>
    <p class="text-xs text-slate-500">
        Tanggal kejadian: {{ $item->tanggal_kejadian->translatedFormat('d F Y') }}
    </p>
</div>