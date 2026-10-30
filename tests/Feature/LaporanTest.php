<?php

namespace Tests\Feature;

use App\Models\Laporan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class LaporanTest extends TestCase
{
    use RefreshDatabase;

    private function payload(array $override = []): array
    {
        return array_merge([
            'nama_pelapor' => 'Budi Santoso',
            'no_hp'        => '081234567890',
            'lokasi'       => 'Jl. Raya Dayeuhkolot No. 5',
            'kecamatan'    => 'Dayeuhkolot',
            'tinggi_air'   => 60,
            'keterangan'   => 'Air masuk rumah',
            'foto'         => UploadedFile::fake()->image('banjir.jpg'),
        ], $override);
    }

    private function petugas(): User
    {
        return User::factory()->create();
    }

    private function laporanDenganFoto(): Laporan
    {
        Storage::fake('public');
        Storage::disk('public')->put('laporan/lama.jpg', 'x');

        return Laporan::factory()->create(['foto' => 'laporan/lama.jpg']);
    }

    // ---------- Warga ----------

    public function test_warga_dapat_membuka_form_tanpa_login(): void
    {
        $this->get('/lapor')->assertOk()->assertSee('Foto Bukti Banjir');
        $this->get('/')->assertRedirect('/lapor');
    }

    public function test_warga_dapat_mengirim_laporan_dengan_foto(): void
    {
        Storage::fake('public');

        $this->post('/lapor', $this->payload())
            ->assertRedirect(route('lapor.create'))
            ->assertSessionHas('success');

        $laporan = Laporan::first();
        $this->assertSame('Menunggu', $laporan->status);
        Storage::disk('public')->assertExists($laporan->foto);
    }

    public function test_foto_wajib_diisi(): void
    {
        $this->post('/lapor', $this->payload(['foto' => null]))
            ->assertSessionHasErrors(['foto' => 'Foto bukti banjir wajib diunggah.']);

        $this->assertDatabaseCount('laporan', 0);
    }

    public function test_foto_harus_jpg_jpeg_png(): void
    {
        Storage::fake('public');

        $this->post('/lapor', $this->payload(['foto' => UploadedFile::fake()->create('berkas.pdf', 100, 'application/pdf')]))
            ->assertSessionHasErrors('foto');

        $this->post('/lapor', $this->payload(['foto' => UploadedFile::fake()->image('anim.gif')]))
            ->assertSessionHasErrors('foto');

        $this->assertDatabaseCount('laporan', 0);
    }

    public function test_foto_maksimal_2_mb(): void
    {
        Storage::fake('public');

        $this->post('/lapor', $this->payload(['foto' => UploadedFile::fake()->image('besar.jpg')->size(2049)]))
            ->assertSessionHasErrors(['foto' => 'Ukuran foto maksimal 2 MB.']);

        $this->post('/lapor', $this->payload(['foto' => UploadedFile::fake()->image('pas.png')->size(2048)]))
            ->assertSessionDoesntHaveErrors('foto');
    }

    public function test_pesan_galat_tampil_di_bawah_input(): void
    {
        $this->from('/lapor')->followingRedirects()
            ->post('/lapor', [])
            ->assertSee('nama pelapor wajib diisi.')
            ->assertSee('Foto bukti banjir wajib diunggah.');
    }

    // ---------- Proteksi auth ----------

    public function test_halaman_petugas_hanya_untuk_yang_login(): void
    {
        $l = Laporan::factory()->create();

        $this->get('/laporan')->assertRedirect('/login');
        $this->get("/laporan/{$l->id}")->assertRedirect('/login');
        $this->get("/laporan/{$l->id}/edit")->assertRedirect('/login');
        $this->put("/laporan/{$l->id}", [])->assertRedirect('/login');
        $this->delete("/laporan/{$l->id}")->assertRedirect('/login');
        $this->assertDatabaseHas('laporan', ['id' => $l->id]);
    }

    public function test_petugas_bisa_login(): void
    {
        $u = User::factory()->create(['password' => bcrypt('rahasia123')]);

        $this->post('/login', ['email' => $u->email, 'password' => 'rahasia123'])
            ->assertRedirect(route('laporan.index', absolute: false));
        $this->assertAuthenticatedAs($u);
    }

    public function test_registrasi_publik_dinonaktifkan(): void
    {
        $this->get('/register')->assertNotFound();
    }

    // ---------- Petugas ----------

    public function test_daftar_laporan_memakai_pagination_dan_thumbnail(): void
    {
        Laporan::factory()->count(11)->create();
        $this->laporanDenganFoto();

        $res = $this->actingAs($this->petugas())->get('/laporan')->assertOk();
        $res->assertViewHas('laporan', fn ($p) => $p->count() === 10 && $p->total() === 12);
        $res->assertSee('storage/laporan/lama.jpg', false);

        $this->actingAs($this->petugas())->get('/laporan?page=2')->assertOk()
            ->assertViewHas('laporan', fn ($p) => $p->count() === 2);
    }

    public function test_detail_laporan(): void
    {
        $l = Laporan::factory()->create(['nama_pelapor' => 'Siti Aminah']);

        $this->actingAs($this->petugas())->get("/laporan/{$l->id}")
            ->assertOk()->assertSee('Siti Aminah');
    }

    public function test_ubah_status_tanpa_ganti_foto_mempertahankan_foto_lama(): void
    {
        Storage::fake('public');
        $l = $this->laporanDenganFoto();

        $this->actingAs($this->petugas())
            ->put("/laporan/{$l->id}", $this->payload(['status' => 'Diproses', 'foto' => null]))
            ->assertRedirect(route('laporan.show', $l))
            ->assertSessionHas('success');

        $this->assertSame('Diproses', $l->fresh()->status);
        $this->assertSame('laporan/lama.jpg', $l->fresh()->foto);
        Storage::disk('public')->assertExists('laporan/lama.jpg');
    }

    public function test_ganti_foto_menghapus_foto_lama(): void
    {
        Storage::fake('public');
        $l = $this->laporanDenganFoto();

        $this->actingAs($this->petugas())
            ->put("/laporan/{$l->id}", $this->payload(['status' => 'Selesai']))
            ->assertSessionHas('success');

        $baru = $l->fresh()->foto;
        $this->assertNotSame('laporan/lama.jpg', $baru);
        Storage::disk('public')->assertExists($baru);
        Storage::disk('public')->assertMissing('laporan/lama.jpg');
    }

    public function test_status_harus_salah_satu_nilai_yang_diizinkan(): void
    {
        $l = Laporan::factory()->create();

        $this->actingAs($this->petugas())
            ->put("/laporan/{$l->id}", $this->payload(['status' => 'Ngawur', 'foto' => null]))
            ->assertSessionHasErrors('status');
    }

    public function test_hapus_laporan_ikut_menghapus_foto(): void
    {
        Storage::fake('public');
        $l = $this->laporanDenganFoto();

        $this->actingAs($this->petugas())
            ->delete("/laporan/{$l->id}")
            ->assertRedirect(route('laporan.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('laporan', ['id' => $l->id]);
        Storage::disk('public')->assertMissing('laporan/lama.jpg');
    }
}
