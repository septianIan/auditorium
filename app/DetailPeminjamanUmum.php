<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPeminjamanUmum extends Model
{
    protected $guarded = [];

    public function peminjamanUmums()
    {
        return $this->belongsToMany(PeminjamanUmum::class);
    }
}
