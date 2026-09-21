<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LockerMaintenance extends Model
{

    protected $table = 'locker_maintenances';

    protected $fillable = [
        'locker_id',
        'issue',
        'start_date',
        'end_date', 
        'status',
        'description',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function locker()
    {
        return $this->belongsTo(Locker::class);
    }
}
