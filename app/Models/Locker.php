<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Location;
use App\Models\LockerUsage;
use App\Models\LockerMaintenance;

class Locker extends Model
{
    protected $fillable = [
        'name',
        'status',
        'location_id',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
    public function usages()
    {
        return $this->hasMany(LockerUsage::class);
    }
    public function maintenances()
    {
        return $this->hasMany(LockerMaintenance::class);
    }
}
