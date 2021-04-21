<?php

namespace Tests\Feature\Http\Controllers\Admin;

use App\Pegawai;
use App\PeminjamanAuditoriumPegawai;
use App\Room;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PeminjamanPegawaiControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_peminjaman_pegawai()
    {
        //FACTORY
        $pegawai = \factory(Pegawai::class)->create();
        $room = factory(Room::class)->create();

        //upload file
        Storage::fake('local');

        $this->post('administator/pegawai', [
            'image' => $file = UploadedFile::fake()->image('avatar.jpg'),
        ])->assertStatus(302);
    
        //create data
        $peminjaman = PeminjamanAuditoriumPegawai::create([
            'pegawai_id' => $pegawai->id,
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

        //cek apakah ada di table peminjaman_auditorium_pegawais
        $this->assertDatabaseHas('peminjaman_auditorium_pegawais', [
            'pegawai_id' => 1,
            'room_id' => 1,
        ]);

        //UPDATE DATA tgl pinjam
        PeminjamanAuditoriumPegawai::find($peminjaman->id)->update([
            'tglPinjam' => '2021-01-15', //dari tgl 2021-01-10 ke tgl 2021-01-15
        ]);

        //cek apakah ada di table peminjaman_auditorium_pegawais
        $this->assertDatabaseHas('peminjaman_auditorium_pegawais', [
            'tglPinjam' => '2021-01-15',
        ]);

        //DELETE data
        PeminjamanAuditoriumPegawai::destroy($peminjaman->id);
        $this->assertDatabaseMissing('peminjaman_auditorium_pegawais', [
            'pegawai_id' => 1,
            'room_id' => 1,
        ]);

        $view = $this->get(route('admin.pegawai.index'));
        $view->assertStatus(302);
    }
}
