<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $fillable = ['name', 'country_id', 'geoname_id'];

    public function districts()
    {
        return $this->hasMany(District::class);
    }
}
