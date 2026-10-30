<?php

namespace App\Http\Requests;

use App\Models\Laporan;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Dipakai bersama oleh form warga (store) dan form petugas (update).
 * - store  : foto WAJIB
 * - update : foto opsional (jika kosong, foto lama dipertahankan) + status wajib
 */
class LaporanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // akses petugas dijaga middleware auth di routes/web.php
    }

    public function rules(): array
    {
        $isUpdate = $this->isMethod('PUT') || $this->isMethod('PATCH');

        $rules = [
            'nama_pelapor' => ['required', 'string', 'max:100'],
            'no_hp'        => ['required', 'regex:/^(\+62|62|0)8[0-9]{8,12}$/'],
            'lokasi'       => ['required', 'string', 'max:255'],
            'kecamatan'    => ['required', Rule::in(Laporan::KECAMATAN)],
            'tinggi_air'   => ['required', 'integer', 'min:0', 'max:1000'],
            'keterangan'   => ['nullable', 'string', 'max:1000'],
            'foto'         => [
                $isUpdate ? 'nullable' : 'required',
                'file', 'image', 'mimes:jpg,jpeg,png', 'max:2048', // 2048 KB = 2 MB
            ],
        ];

        if ($isUpdate) {
            $rules['status'] = ['required', Rule::in(Laporan::STATUS)];
        }

        return $rules;
    }

    public function attributes(): array
    {
        return [
            'nama_pelapor' => 'nama pelapor',
            'no_hp'        => 'nomor HP',
            'tinggi_air'   => 'tinggi air',
            'keterangan'   => 'keterangan',
        ];
    }

    public function messages(): array
    {
        return [
            'required'        => ':attribute wajib diisi.',
            'string'          => ':attribute harus berupa teks.',
            'max.string'      => ':attribute maksimal :max karakter.',
            'integer'         => ':attribute harus berupa angka bulat.',
            'min.numeric'     => ':attribute minimal :min.',
            'max.numeric'     => ':attribute maksimal :max.',
            'in'              => ':attribute yang dipilih tidak valid.',
            'no_hp.regex'     => 'Nomor HP tidak valid. Contoh: 081234567890.',
            'foto.required'   => 'Foto bukti banjir wajib diunggah.',
            'foto.file'       => 'Foto gagal diunggah. Coba pilih file lagi.',
            'foto.image'      => 'File harus berupa gambar.',
            'foto.mimes'      => 'Foto harus berformat JPG, JPEG, atau PNG.',
            'foto.max'        => 'Ukuran foto maksimal 2 MB.',
            'foto.uploaded'   => 'Foto gagal diunggah. Pastikan ukurannya tidak lebih dari 2 MB.',
        ];
    }
}
