<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    // Daftar laporan (dari database)
    public function index()
    {
        $laporan = Laporan::all();

        return view('laporan.index', compact('laporan'));
    }

    // Form pelaporan
    public function create()
    {
        return view('laporan.form');
    }

    // Simpan ke tabel laporan
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_pelapor'     => 'required|string|max:255',
            'lokasi'           => 'required|string|max:255',
            'tinggi_genangan'  => 'required|integer|min:0',
            'tanggal_kejadian' => 'required|date',
        ]);

        $laporan = Laporan::create($data);

        return redirect()->route('laporan.konfirmasi', $laporan);
    }

    // Halaman konfirmasi (pakai <x-alert>)
    public function konfirmasi(Laporan $laporan)
    {
        return view('laporan.konfirmasi', compact('laporan'));
    }
}