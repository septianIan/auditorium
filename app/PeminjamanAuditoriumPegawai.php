<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class PeminjamanAuditoriumPegawai extends Model
{
    protected $table = 'peminjaman_auditorium_pegawais'; 
    protected $guarded = [];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }

    public function room()
    {  
        return $this->belongsTo(Room::class);
    }

    public function fasilitas()
    {
        return $this->hasMany(DetailPeminjamanPegawai::class, 'peminjaman_pegawai_id');
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
