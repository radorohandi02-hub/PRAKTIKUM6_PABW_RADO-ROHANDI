@props(['status'])

@php
    $warna = match ($status) {
        'Diproses' => 'bg-yellow-100 text-yellow-800',
        'Selesai'  => 'bg-green-100 text-green-800',
        default    => 'bg-red-100 text-red-800',
    };
@endphp

<span {{ $attributes->merge(['class' => "inline-block rounded-full px-3 py-1 text-xs font-semibold $warna"]) }}>
    {{ $status }}
</span>
