<?php

namespace Tests\Feature;

use App\PeminjamanAuditorium;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UploadImgTest extends TestCase
{
    use WithFaker, WithoutMiddleware;
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

    public function test_avatars_can_be_uploaded()
    {
        Storage::fake('uploads');
        $data = [
            'mahasiswa_id' => '1',
            'room_id' => '1',
            'tglPinjam' => '2021-01-18',
            'dariJam' => '08:00',
            'sampaiJam' => '12:00',
            'kegiatan' => 'Test',
            'noTelp' => '123',
            'email' => 'test@mail.com',
            'image' =>  $file =  UploadedFile::fake()->create('image.png')
        ];

        $this->post(route('admin.peminjaman.store'), $data)
        ->assertStatus(302);

        $peminjamanAuditorium = PeminjamanAuditorium::first();

        $imagePath = 'storage/' . $file->hashName();

        $this->assertEquals($imagePath, $peminjamanAuditorium->image);

        Storage::disk('uploads')->assertExists($imagePath);
    }
}
