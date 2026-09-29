<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'user_id',
        'locker_id',
        'location_id',
        'start_time',
        'duration',
        'name',
        'email',
        'phone',
        'status',
    ];

    /**
     * Reservation belongs to a user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Reservation belongs to a locker
     */
    public function locker()
    {
        return $this->belongsTo(Locker::class);
    }

    /**
     * Reservation belongs to a location
     */
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
