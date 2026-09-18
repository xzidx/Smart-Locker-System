<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'name',
        'address',
        'building',
        'floor',
    ];

    public function lockers()
    {
        return $this->hasMany(Locker::class);
    }
}
