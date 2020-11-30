<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPeminjamanPegawai extends Model
{
    protected $table = 'detail_peminjaman_pegawais';
    protected $primaryKey = 'peminjaman_pegawai_id';
    protected $guarded = [];

    public function peminjamPegawai()
    {
        return $this->belongsToMany(PeminjamanAuditoriumPegawai::class);
    }
    
}
