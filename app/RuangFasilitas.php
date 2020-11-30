<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RuangFasilitas extends Model
{
    protected $guarded = [];

    public function rooms()
    {
        return $this->belongsTo(Room::class);
    }

    public function getFasilitasAttribute($value)
    {
        return \strtoupper($value);
    }
}
