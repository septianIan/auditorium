<?php

namespace Tests\Feature\Http\Controllers\Admin;

use App\Room;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RuanganControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_index_data()
    {
        $view = $this->get(route('admin.room.index'));
        $view->assertStatus(302);

        $rooms = Room::get();
        foreach($rooms as $room){
            $room->ruang;
            $room->status;
            $room->statusPinjam;
        }
    }

    public function test_room()
    {
        //create
        $room = Room::create([
            'ruang' => 'LAPANGAN FUTSAL',
            'status' => 0,
            'statusPinjam' => 0,
        ]);

        //cek apakah ada di table rooms
        $this->assertDatabaseHas('rooms', [
            'ruang' => 'LAPANGAN FUTSAL',
            'status' => 0,
            'statusPinjam' => 0,
        ]);

        //edit
        Room::findOrFail($room->id)->update([
            'ruang' => 'LAPANGAN BASKET',
            'status' => 0,
            'statusPinjam' => 0,
        ]);

        //cek apakah ada di table rooms
        $this->assertDatabaseHas('rooms', [
            'ruang' => 'LAPANGAN BASKET',
            'status' => 0,
            'statusPinjam' => 0,
        ]);

        //hapus
        Room::destroy($room->id);
        $this->assertDatabaseMissing('rooms', [
            'ruang' => 'LAPANGAN BASKET',
            'status' => 0,
            'statusPinjam' => 0,
        ]);
    }
}
