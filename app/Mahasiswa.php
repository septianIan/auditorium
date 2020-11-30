<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $guarded = [];

    public function peminjamanAuditorium()
    {
        return $this->belongsTo(PeminjamanAuditorium::class);
    }
}
