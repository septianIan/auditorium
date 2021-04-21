<?php

namespace Tests\Feature\Http\Controllers\Admin;

use App\PeminjamanUmum;
use App\Room;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use MahasiswaSeeder;
use Tests\TestCase;

class PeminjamanUmumControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_peminjaman_umum()
    {
        //upload file
        Storage::fake('local');

        $this->post('administator/peminjaman', [
            'image' => $file = UploadedFile::fake()->image('avatar.jpg'),
        ])->assertStatus(302);

        //FACTORY
        $room = factory(Room::class)->create();
        
         //CREATE data
        $peminjaman = PeminjamanUmum::create([
            'room_id' => $room->id,
            'nik' => 122324235435,
            'nama' => 'budi',
            'alamat' => 'malang',
            'noTelp' => '0862764761',
            'email' => 'adamwahyu929@gmail.com',
            'tglPinjam' => '2021-01-10',
            'dariJam' => '07:00',
            'sampaiJam' => '10:00',
            'kegiatan' => 'seminar',
            'image' => UploadedFile::fake()->image('avatar.jpg'),
            'status' => 1
        ]);

        //cek apakah ada di table peminjaman_umums
        $this->assertDatabaseHas('peminjaman_umums', [
            'room_id' => 1,
            'nik' => 122324235435,
            'nama' => 'budi',
        ]);

        //UPDATE DATA, pada kolom tanggal
        PeminjamanUmum::find($peminjaman->id)->update([
            'tglPinjam' => '2021-01-15', //dari tgl 2021-01-10 ke tgl 2021-01-15
        ]);

        //cek apakah ada di table peminjaman_umums
        $this->assertDatabaseHas('peminjaman_umums', [
            'tglPinjam' => '2021-01-15',
        ]);

        //DELETE data
        PeminjamanUmum::destroy($peminjaman->id);
        $this->assertDatabaseMissing('peminjaman_umums', [
            'room_id' => 1,
            'nik' => 122324235435,
            'nama' => 'budi',
        ]);

        $view = $this->get(route('admin.peminjaman.index'));
        $view->assertStatus(302);
    }
}
