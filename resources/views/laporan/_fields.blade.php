@php($l = $laporan ?? null)

<div>
    <label for="nama_pelapor" class="block text-sm font-medium mb-1">Nama Pelapor</label>
    <input type="text" id="nama_pelapor" name="nama_pelapor" value="{{ old('nama_pelapor', $l?->nama_pelapor) }}"
           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
    <x-input-error :messages="$errors->get('nama_pelapor')" class="mt-1" />
</div>

<div>
    <label for="no_hp" class="block text-sm font-medium mb-1">No. HP</label>
    <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp', $l?->no_hp) }}" placeholder="081234567890"
           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
    <x-input-error :messages="$errors->get('no_hp')" class="mt-1" />
</div>

<div>
    <label for="lokasi" class="block text-sm font-medium mb-1">Lokasi Kejadian (alamat / patokan)</label>
    <input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi', $l?->lokasi) }}"
           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
    <x-input-error :messages="$errors->get('lokasi')" class="mt-1" />
</div>

<div>
    <label for="kecamatan" class="block text-sm font-medium mb-1">Kecamatan</label>
    <select id="kecamatan" name="kecamatan"
            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
        <option value="">-- Pilih kecamatan --</option>
        @foreach (\App\Models\Laporan::KECAMATAN as $kec)
            <option value="{{ $kec }}" @selected(old('kecamatan', $l?->kecamatan) === $kec)>{{ $kec }}</option>
        @endforeach
    </select>
    <x-input-error :messages="$errors->get('kecamatan')" class="mt-1" />
</div>

<div>
    <label for="tinggi_air" class="block text-sm font-medium mb-1">Tinggi Air (cm)</label>
    <input type="number" id="tinggi_air" name="tinggi_air" min="0" value="{{ old('tinggi_air', $l?->tinggi_air) }}"
           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
    <x-input-error :messages="$errors->get('tinggi_air')" class="mt-1" />
</div>

<div>
    <label for="keterangan" class="block text-sm font-medium mb-1">Keterangan (opsional)</label>
    <textarea id="keterangan" name="keterangan" rows="3"
              class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('keterangan', $l?->keterangan) }}</textarea>
    <x-input-error :messages="$errors->get('keterangan')" class="mt-1" />
</div>

<div>
    <label for="foto" class="block text-sm font-medium mb-1">
        {{ $l ? 'Ganti Foto (kosongkan jika tidak diganti)' : 'Foto Bukti Banjir' }}
    </label>

    @if ($l?->foto_url)
        <img src="{{ $l->foto_url }}" alt="Foto saat ini" class="mb-2 h-32 rounded border object-cover">
    @endif

    <input type="file" id="foto" name="foto" accept="image/png,image/jpeg"
           class="block w-full text-sm text-gray-700 file:mr-3 file:rounded file:border-0 file:bg-blue-50 file:px-3 file:py-2 file:text-blue-700 hover:file:bg-blue-100">
    <p class="mt-1 text-xs text-gray-500">Format JPG, JPEG, atau PNG. Maksimal 2 MB.</p>
    <x-input-error :messages="$errors->get('foto')" class="mt-1" />
</div>
