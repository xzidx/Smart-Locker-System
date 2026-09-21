<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LockerUsage extends Model
{
    protected $table = 'locker_usage';

    protected $fillable = [
        'user_id',
        'locker_id',
        'start_time',
        'end_time',
        'status',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function locker()
    {
        return $this->belongsTo(Locker::class);
    }
}
