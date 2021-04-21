<?php

namespace Tests\Feature\Http\Controllers\Admin;

use App\Pegawai;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PegawaiControllerTest extends TestCase
{
    use WithFaker, RefreshDatabase;
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

    public function getDataPegawai()
    {
        $data = [
            'nik' => 12345,
            'nama' => 'yono',
            'alamat' => 'jl candi malang', 
            'noTelp' => '08644162453',
            'email' => 'yono@hmail.com'
        ];

        return $data;
    }

    public function test_getData_index()
    {
        $view = $this->get(route('admin.pegawai.index'));
        $view->assertStatus(302);

        $pegawais = Pegawai::all();
        foreach($pegawais as $pegawai){
            $pegawai->nik;
            $pegawai->name;
            $pegawai->alamat;
            $pegawai->noTelp;
            $pegawai->email;
        }
    }

    public function test_pegawai()
    {   
        //create data
        $pegawai = Pegawai::create([
            'nik' => $nik = $this->faker->randomNumber(3),
            'nama' => $nama = $this->faker->name(),
            'alamat' => $alamat = $this->faker->cityPrefix(), 
            'noTelp' => $noTelp = $this->faker->randomNumber(3),
            'email' => $email = $this->faker->email() 
        ]);

        $view = $this->get(route('admin.masterPegawai.index'));
        $view->assertStatus(302);

        //update data
        $updatePegawai = Pegawai::find($pegawai->id)->update([
            'nik' => $nik = $this->faker->randomNumber(3),
            'nama' => $nama = $this->faker->name(),
            'alamat' => $alamat = $this->faker->cityPrefix(), 
            'noTelp' => $noTelp = $this->faker->randomNumber(3),
            'email' => $email = $this->faker->email() 
        ]);
        //kita cek apakah data nya benarh sudah di update atau tidak.
        $this->assertDatabaseHas('pegawais', [
            'nik' => $nik,
            'nama' => $nama,
            'alamat' => $alamat,
            'noTelp' => $noTelp,
            'email' => $email,
        ]);

        //kita hapus data pegawai yang baru di update tadi.
        Pegawai::destroy(1);
        //lalu cek di database apakah data pegawai tadi apakah sudah tidak ada.
        $this->assertDatabaseMissing('pegawais', [
            'nik' => 12345,
            'nama' => 'yono',
            'alamat' => 'jl candi malang', 
            'noTelp' => '08644162453',
            'email' => 'yono@hmail.com'
        ]);

        $view = $this->get(route('admin.masterPegawai.index'));
        $view->assertStatus(302);
    }
}
