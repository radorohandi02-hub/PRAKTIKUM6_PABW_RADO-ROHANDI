<?php

namespace App\Http\Controllers;

use App\Http\Requests\LaporanRequest;
use App\Models\Laporan;

/** Sisi warga (publik): hanya form pengiriman laporan. */
class LaporController extends Controller
{
    public function create()
    {
        return view('lapor.create');
    }

    public function store(LaporanRequest $request)
    {
        $data = $request->validated();

        // store() menghasilkan nama acak unik; disimpan di storage/app/public/laporan
        $data['foto'] = $request->file('foto')->store('laporan', 'public');
        $data['status'] = 'Menunggu';

        Laporan::create($data);

        return redirect()
            ->route('lapor.create')
            ->with('success', 'Laporan berhasil dikirim. Terima kasih, petugas BPBD akan segera menindaklanjuti.');
    }
}
