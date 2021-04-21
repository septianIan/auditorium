<?php

namespace Tests\Feature\Http\Controllers\Admin;

use App\Mahasiswa;
use App\Pegawai;
use App\PeminjamanAuditorium;
use App\Room;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use MahasiswaSeeder;
use Tests\TestCase;

class PeminjamanMahasiswaControllerTest extends TestCase
{
    use WithFaker ,RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function getDataPeminjam()
    {   
        $mahsiswa = \factory(Mahasiswa::class)->create();
        $room = factory(Room::class)->create();
        $data = [
            [
                'mahasiswa_id' => $mahsiswa->id,
                'room_id' => $room->id,
                'tglPinjam' => '2021-01-10',
                'dariJam' => '07:00',
                'sampaiJam' => '10:00',
                'kegiatan' => 'seminar',
                'noTelp' => '0862764761',
                'email' => 'adamwahyu929@gmail.com',
                'image' => UploadedFile::fake()->image('avatar.jpg'),
                'status' => 1
            ]
        ];

        return $data;
    }

    public function test_peminjaman_pegawai()
    {
        //upload file
        Storage::fake('local');

        $this->post('administator/peminjaman', [
            'image' => $file = UploadedFile::fake()->image('avatar.jpg'),
        ])->assertStatus(302);

        $mahsiswa = \factory(Mahasiswa::class)->create();
        $room = factory(Room::class)->create();

        //CREATE data
        $peminjaman = PeminjamanAuditorium::create([
            'mahasiswa_id' => $mahsiswa->id,
            'room_id' => $room->id,
            'tglPinjam' => '2021-01-10',
            'dariJam' => '07:00',
            'sampaiJam' => '10:00',
            'kegiatan' => 'seminar',
            'noTelp' => '0862764761',
            'email' => 'adamwahyu929@gmail.com',
            'image' => UploadedFile::fake()->image('avatar.jpg'),
            'status' => 1
        ]);

        //cek apakah ada di table peminjaman_auditoria
        $this->assertDatabaseHas('peminjaman_auditoria', [
            'mahasiswa_id' => 1,
            'room_id' => 1,
        ]);

        //UPDATE DATA, pada kolom tanggal
        PeminjamanAuditorium::find($peminjaman->id)->update([
            'tglPinjam' => '2021-01-15', //dari tgl 2021-01-10 ke tgl 2021-01-15
        ]);

        //cek apakah ada di table peminjaman_auditoria
        $this->assertDatabaseHas('peminjaman_auditoria', [
            'tglPinjam' => '2021-01-15',
        ]);

        //DELETE data
        PeminjamanAuditorium::destroy($peminjaman->id);
        $this->assertDatabaseMissing('peminjaman_auditoria', [
            'mahasiswa_id' => 1,
            'room_id' => 1,
        ]);

        $view = $this->get(route('admin.peminjaman.index'));
        $view->assertStatus(302);
    }
}
