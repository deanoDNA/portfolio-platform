<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    protected $table = 'portfolios';

    // Important: allow mass assignment for all fields used in steps
    protected $fillable = [
        'user_id',
        'full_name',
        'gender',
        'country_id',
        'region_id',
        'district_id',
        'summary',
        'skills',
        'education',
        'experience',
        'profile_photo',
    ];

public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function completionPercentage(): int
    {
        $fields = [
            'full_name',
            'gender',
            'country_id',
            'region_id',
            'district_id',
            'summary',
            'skills',
            'education',
            'experience',
            'profile_photo',
        ];

        $filled = 0;

        foreach ($fields as $field) {
            if (!empty($this->$field)) {
                $filled++;
            }
        }

        return intval(($filled / count($fields)) * 100);
    }

    public function languages()
{
    return $this->hasMany(Language::class);
}

public function interests()
{
    return $this->hasMany(Interest::class);
}

public function certifications()
{
    return $this->hasMany(Certification::class);
}

}


