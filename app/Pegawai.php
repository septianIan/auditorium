<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $guarded = [];
    protected $table = 'pegawais';

    public function peminjamanAuditorium()
    {
        return $this->hasOne(PeminjamanAuditoriumPegawai::class);
    }
}
