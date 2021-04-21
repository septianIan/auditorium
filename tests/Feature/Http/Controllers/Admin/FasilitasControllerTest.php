<?php

namespace Tests\Feature\Http\Controllers\Admin;

use App\Amenities;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FasilitasControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_data()
    {
        $view = $this->get(route('admin.fasilitas.index'));
        $view->assertStatus(302);

        $fasilitas = Amenities::get();
        foreach($fasilitas as $value){
            $value->fasilitas;
        }
    }

    public function test_fasilitas()
    {
        //create
        $fasilitas = Amenities::create([
            'fasilitas' => 'ac',
        ]);
        $this->assertDatabaseHas('amenities', [
            'fasilitas' => 'ac'
        ]);
        
        //edit
        Amenities::findOrFail($fasilitas->id)->update([
            'fasilitas' => 'kursi',
        ]);

        $this->assertDatabaseHas('amenities', [
            'fasilitas' => 'kursi',
        ]);

        //hapus
        Amenities::destroy(1);
        $this->assertDatabaseMissing('amenities', [
            'fasilitas' => 'kursi',
        ]);

        $view = $this->get(route('admin.fasilitas.index'));
        $view->assertStatus(302);
    }
}
