<?php

namespace Tests\Feature\Http\Controllers\Admin;

use App\Mahasiswa;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MahasiswaControllerTest extends TestCase
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

    public function test_index_data()
    {
        $view = $this->get(\route('admin.mahasiswa.index'));
        $view->assertStatus(302);

        $students = Mahasiswa::all();
        foreach ($students as $student) {
            $student->nim;
            $student->nama;
            $student->fakultas;
            $student->jurusan;
            $student->alamat;
            $student->noTelp;
            $student->email;
        }
    }

    public function test_data_student()
    {
        $data = [
            [
                'nim' => 12345,
                'nama' => 'Ian',
                'fakultas' => 'Teknologi Informasi',
                'jurusan' => 'Teknik Informatika',
                'alamat' => 'Jl mongin sidi bojonegoro',
                'noTelp' => '085775088148',
                'email' => 'ian@gmail.test'
            ],
        ];

        /**
         * Create
         */

        //kita membuat data baru dengan array di atas
        Mahasiswa::insert($data);
        //kita cek apakah benar data tersebut sudah ada di database
        $this->assertDatabaseHas('mahasiswas', [
            $data
        ]);

        /**
         * Update
         */

        //Update student
        $updateStudent = Mahasiswa::find(1)->update([
            'nim' => 81131526,
            'nama' => 'ian Update',
            'fakultas' => 'Teknologi Informasi Update',
            'jurusan' => 'Teknik Informatika Update',
            'alamat' => 'Jl mongin sidi bojonegoro Update',
            'noTelp' => '085818681',
            'email' => 'ian@gmail.test Update'
        ]);
        //kita cek apakah data nya benarh sudah di update atau tidak.
        $this->assertDatabaseHas('mahasiswas', [
            'nim' => 81131526,
            'nama' => 'ian Update',
            'fakultas' => 'Teknologi Informasi Update',
            'jurusan' => 'Teknik Informatika Update',
            'alamat' => 'Jl mongin sidi bojonegoro Update',
            'noTelp' => '085818681',
            'email' => 'ian@gmail.test Update'
        ]);

        /**
         * Delete
         */

        //kita hapus data mahasiswa yang baru di update tadi.
        Mahasiswa::destroy(1);
        //lalu cek di database apakah data mahasiswa tadi apakah sudah tidak ada.
        $this->assertDatabaseMissing('mahasiswas', [
            'nim' => 81131526,
            'nama' => 'ian Update',
            'fakultas' => 'Teknologi Informasi Update',
            'jurusan' => 'Teknik Informatika Update',
            'alamat' => 'Jl mongin sidi bojonegoro Update',
            'noTelp' => '085818681',
            'email' => 'ian@gmail.test Update'
        ]);

        // $students->assertStatus(302);
        // $students->assertRedirect(\route('admin.mahasiswa.index'));
    }
}
