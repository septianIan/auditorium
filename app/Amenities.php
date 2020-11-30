<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Amenities extends Model
{
    protected $guarded = [];

    public function getFasilitasAttribute($value)
    {
        return \strtoupper($value);
    }
}
