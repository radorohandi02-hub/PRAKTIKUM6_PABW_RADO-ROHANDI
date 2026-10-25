<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporBanjirController extends Controller
{
    public function form()
    {
        return view('form');
    }

    public function konfirmasi(Request $request)
    {
        $data = [
            'nama' => $request->nama,
            'lokasi' => $request->lokasi,
            'tinggi' => $request->tinggi
        ];

        return view('konfirmasi', compact('data'));
    }

    public function laporan()
    {
        $laporan = [
            [
                'nama' => 'Andi',
                'lokasi' => 'Dayeuhkolot',
                'tinggi' => 20
            ],

            [
                'nama' => 'Budi',
                'lokasi' => 'Baleendah',
                'tinggi' => 50
            ],

            [
                'nama' => 'Citra',
                'lokasi' => 'Banjaran',
                'tinggi' => 90
            ],

            [
                'nama' => 'Dimas',
                'lokasi' => 'Bojongsoang',
                'tinggi' => 80
            ],

            [
                'nama' => 'Salsa',
                'lokasi' => 'Majalaya',
                'tinggi' => 35
            ]
        ];

        return view('laporan', compact('laporan'));
    }
}