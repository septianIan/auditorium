<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Amenities extends Model
{
    protected $guarded = [];
    protected $table = 'amenities'
;
    public function getFasilitasAttribute($value)
    {
        return \strtoupper($value);
    }
}
