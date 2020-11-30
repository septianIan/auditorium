<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPeminjaman extends Model
{
    protected $table = 'detail_peminjaman';
    protected $guarded = [];

    public function Peminjamans()
    {
        return $this->belongsTo(PeminjamanAuditorium::class);
    }
}
