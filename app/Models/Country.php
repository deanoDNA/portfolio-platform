<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = ['name', 'iso_code', 'nationality'];

    public function regions()
    {
        return $this->hasMany(Region::class);
    }
}

