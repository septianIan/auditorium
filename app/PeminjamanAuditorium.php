<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class PeminjamanAuditorium extends Model
{
    protected $guarded = [];
    protected $table = 'peminjaman_auditoria';

    public function fasilitas()
    {
        return $this->hasMany(DetailPeminjaman::class);
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
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
