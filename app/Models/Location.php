<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Locker;
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
