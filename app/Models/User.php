<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'bio',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

        public function portfolio()
    {
        return $this->hasOne(Portfolio::class);
    }

    public function skills()
{
    return $this->hasMany(\App\Models\Skill::class);
}


}
