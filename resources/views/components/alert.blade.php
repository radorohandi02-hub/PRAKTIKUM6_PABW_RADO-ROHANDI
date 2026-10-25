@props(['type' => 'success'])

@php
    $warna = match ($type) {
        'danger'  => 'bg-red-100 border-red-400 text-red-800',
        'warning' => 'bg-yellow-100 border-yellow-400 text-yellow-800',
        'info'    => 'bg-blue-100 border-blue-400 text-blue-800',
        default   => 'bg-green-100 border-green-400 text-green-800',
    };
@endphp

<div {{ $attributes->merge(['class' => "border-l-4 p-4 rounded mb-4 $warna"]) }} role="alert">
    {{ $slot }}
</div>