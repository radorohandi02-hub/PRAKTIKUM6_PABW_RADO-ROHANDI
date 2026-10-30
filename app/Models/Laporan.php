<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'laporan';

    public const STATUS = ['Menunggu', 'Diproses', 'Selesai'];

    public const KECAMATAN = [
        'Arjasari', 'Baleendah', 'Banjaran', 'Bojongsoang', 'Cangkuang', 'Cicalengka',
        'Cikancung', 'Cilengkrang', 'Cileunyi', 'Cimaung', 'Cimenyan', 'Ciparay',
        'Ciwidey', 'Dayeuhkolot', 'Ibun', 'Katapang', 'Kertasari', 'Kutawaringin',
        'Majalaya', 'Margaasih', 'Margahayu', 'Nagreg', 'Pacet', 'Pameungpeuk',
        'Pangalengan', 'Paseh', 'Pasirjambu', 'Rancabali', 'Rancaekek',
        'Solokanjeruk', 'Soreang',
    ];

    protected $fillable = [
        'nama_pelapor',
        'no_hp',
        'lokasi',
        'kecamatan',
        'tinggi_air',
        'keterangan',
        'foto',
        'status',
    ];

    protected $attributes = [
        'status' => 'Menunggu',
    ];

    protected $casts = [
        'tinggi_air' => 'integer',
    ];


    /**
     * Menentukan kategori banjir berdasarkan tinggi genangan.
     */
    public function getKategoriBanjirAttribute(): string
    {
        if ($this->tinggi_air < 30) {
            return 'Waspada';
        }

        if ($this->tinggi_air <= 70) {
            return 'Siaga';
        }

        return 'Awas';
    }
    /** URL publik foto (memakai host request, jadi aman untuk artisan serve / Laragon / XAMPP). */
    public function getFotoUrlAttribute(): ?string
    {
        return $this->foto ? asset('storage/'.$this->foto) : null;
    }
}
