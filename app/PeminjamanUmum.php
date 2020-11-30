<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class PeminjamanUmum extends Model
{
    protected $guarded = [];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function fasilitas()
    {
        return $this->hasMany(DetailPeminjamanUmum::class, 'peminjaman_id');
    }   

    public function getDariSampai()
    {
        return $this->dariJam.' - '.$this->sampaiJam;
    }

    public function getFormatTgl()
    {
        return Carbon::parse($this->tglPinjam)->format('d, M Y');
    }

    public function getImage()
    {
        return asset('storage/' . $this->image);
    }
}
