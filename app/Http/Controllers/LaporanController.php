<?php

namespace App\Http\Controllers;

use App\Http\Requests\LaporanRequest;
use App\Models\Laporan;
use Illuminate\Support\Facades\Storage;

/** Sisi petugas (middleware auth): index, show, edit, update, destroy. */
class LaporanController extends Controller
{
    public function index()
    {
        $laporan = Laporan::latest()->latest('id')->paginate(10);

        return view('laporan.index', compact('laporan'));
    }

    public function show(Laporan $laporan)
    {
        return view('laporan.show', compact('laporan'));
    }

    public function edit(Laporan $laporan)
    {
        return view('laporan.edit', compact('laporan'));
    }

    public function update(LaporanRequest $request, Laporan $laporan)
    {
        $data = $request->validated();
        $fotoLama = $laporan->foto;

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('laporan', 'public');
        } else {
            unset($data['foto']); // tidak ada upload baru -> pertahankan foto lama
        }

        $laporan->update($data);

        // Hapus foto lama hanya setelah data baru berhasil tersimpan
        if ($request->hasFile('foto') && $fotoLama) {
            Storage::disk('public')->delete($fotoLama);
        }

        return redirect()
            ->route('laporan.show', $laporan)
            ->with('success', 'Laporan berhasil diperbarui.');
    }

    public function destroy(Laporan $laporan)
    {
        $foto = $laporan->foto;

        $laporan->delete();

        if ($foto) {
            Storage::disk('public')->delete($foto);
        }

        return redirect()
            ->route('laporan.index')
            ->with('success', 'Laporan berhasil dihapus.');
    }
}
