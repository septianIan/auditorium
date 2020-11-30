<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $guarded = [];

    public function fasilitas()
    {
        return $this->hasMany(RuangFasilitas::class);
    }

    public function setRuangAttribute($value)
    {
        $this->attributes['ruang'] = \strtoupper($value);
    }

    public function peminjam()
    {
        return $this->hasOne(PeminjamanAuditorium::class);
    }

    public function peminjamPagawai()
    {
        return $this->hasOne(PeminjamanAuditoriumPegawai::class);
    }
}
